<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

// Ensure cart data is stored in session before accessing it
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$totalPrice = 0;
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['qty'];
}

// Process the payment when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cash = $_POST['cash'];
    $staffID = $_POST['staff_id'];
    $change = $cash - $totalPrice;

    if ($change >= 0) {
        $orderID = uniqid('ORD_');

        // Check if staff exists
        $stmt = $mysqli->prepare("SELECT staff_id FROM rpos_staff WHERE staff_number = ?");
        $stmt->bind_param("s", $staffID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $staffData = $result->fetch_assoc();
            $staff_db_id = $staffData['id']; // or use staff_number if that's what's stored in orders

            // Insert into orders with staff ID
            $stmt = $mysqli->prepare("INSERT INTO orders (order_id, total_price, cash_received, change_amount, staff_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sddds", $orderID, $totalPrice, $cash, $change, $staffID);
            $stmt->execute();

            // Insert each cart item into order_items table
            foreach ($cart as $id => $item) {
                $stmt = $mysqli->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssdi", $orderID, $id, $item['qty'], $item['price']);
                $stmt->execute();
            }

            // Clear cart session
            $_SESSION['cart'] = [];

            // Redirect
            header("Location: receipts.php?order_id=" . $orderID);
            exit();
        } else {
            echo "<script>alert('Invalid staff number. Please scan or enter a valid one.');</script>";
        }
    } else {
        echo "<script>alert('Insufficient cash received!');</script>";
    }
}

require_once('partials/_head.php');
?>

<body>
<style>
    body {
        background-color: #b09081;
    }
</style>
    <?php require_once('partials/_sidebar.php'); ?>
    <div class="main-content">
        <?php require_once('partials/_topnav.php'); ?>
        <div style="background-image: url(assets/img/theme/bjes.png); background-size: cover;" class="header pb-8 pt-5 pt-md-9">
            <span class="mask bg-gradient-dark opacity-5" ></span>
            <div class="container-fluid" >
                <div class="header-body"></div>
            </div>
        </div>
        <div class="container-fluid mt--8">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0" style="background-color: #f5f5dc;">
                            <h3>Order Details</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" style="background-color: #f5f5dc;" >
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($cart)) {
                                        foreach ($cart as $id => $item) {
                                            $subtotal = $item['price'] * $item['qty'];
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                                        <td><?php echo intval($item['qty']); ?></td>
                                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                                        <td>
                                            <form action="remove_order.php" method="POST">
                                                <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No items in the cart</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-right" style="background-color: #f5f5dc;">
                            <h4>Total: $<span id="total-price"><?php echo number_format($totalPrice, 2); ?></span></h4>
                            <form action="payments.php" method="POST" onsubmit="return validatePayment();">
    <div class="form-group">
        <label for="staff_id">Cashier (Staff Number):</label>
        <input type="text" id="staff_id" name="staff_id" class="form-control" style="width: 180px; display: inline-block;" placeholder="Scan or enter ID" required>
    </div>
    <div class="form-group">
        <label for="cash">Cash Received:</label>
        <input type="number" step="0.01" id="cash" name="cash" class="form-control" style="width: 120px; display: inline-block;" required oninput="calculateChange()">
    </div>
    <div class="form-group">
        <label for="change">Change:</label>
        <input type="text" id="change" class="form-control" style="width: 120px; display: inline-block;" readonly>
    </div>
    <button type="submit" class="btn btn-success">Confirm Payment</button>
</form>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once('partials/_footer.php'); ?>
        </div>
    </div>
    <?php require_once('partials/_scripts.php'); ?>

    <script>
        function calculateChange() {
            let total = parseFloat(document.getElementById('total-price').textContent);
            let cash = parseFloat(document.getElementById('cash').value) || 0;
            let change = cash - total;
            document.getElementById('change').value = change >= 0 ? change.toFixed(2) : 'Insufficient Cash';
        }

        function validatePayment() {
            let change = parseFloat(document.getElementById('change').value);
            if (change < 0) {
                alert('Insufficient cash received. Please enter a valid amount.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
