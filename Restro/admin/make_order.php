<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
include('config/code-generator.php');

check_login();
if (isset($_POST['make'])) {
  if (empty($_POST["order_code"]) || empty($_POST["customer_id"]) || empty($_POST['prod_price']) || empty($_POST['prod_qty'])) {
      $err = "Blank Values Not Accepted";
  } else {
      $order_code = $_POST['order_code'];
      $customer_id = $_POST['customer_id'];
      $customer_name = $_POST['customer_name'];

      for ($i = 0; $i < count($_POST['prod_id']); $i++) {
          $order_id = uniqid();
          $prod_id = $_POST['prod_id'][$i];
          $prod_name = $_POST['prod_name'][$i];
          $prod_price = $_POST['prod_price'][$i];
          $prod_qty = $_POST['prod_qty'][$i];
          $total_price = $prod_price * $prod_qty;

          // Insert each product into the database
          $postQuery = "INSERT INTO rpos_orders (prod_qty, order_id, order_code, customer_id, customer_name, prod_id, prod_name, prod_price, total_price) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $postStmt = $mysqli->prepare($postQuery);
          $postStmt->bind_param('isssssssd', $prod_qty, $order_id, $order_code, $customer_id, $customer_name, $prod_id, $prod_name, $prod_price, $total_price);
          $postStmt->execute();
      }

      $_SESSION['last_order'] = $_POST; // Store order details in session
      header("Location: payments.php");
      exit();
  }
}

require_once('partials/_head.php');
?>

<body>
    <?php require_once('partials/_sidebar.php'); ?>
    <div class="main-content">
        <?php require_once('partials/_topnav.php'); ?>
        <div style="background-image: url(assets/img/theme/bg.jpg); background-size: cover;" class="header pb-8 pt-5 pt-md-8">
            <span class="mask bg-gradient-dark opacity-5"></span>
            <div class="container-fluid">
                <div class="header-body"></div>
            </div>
        </div>
        <div class="container-fluid mt--8">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3>Please Fill All Fields</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label>Customer Name</label>
                                        <select class="form-control" name="customer_name" id="custName" onChange="getCustomer(this.value)">
                                            <option value="">Select Customer</option>
                                            <?php
                                            $ret = "SELECT * FROM rpos_customers";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            while ($cust = $res->fetch_object()) {
                                            ?>
                                                <option value="<?php echo $cust->customer_id; ?>" data-name="<?php echo $cust->customer_name; ?>">
                                                    <?php echo $cust->customer_name; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Customer ID</label>
                                        <input type="text" name="customer_id" id="customerID" readonly class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Order Code</label>
                                        <input type="text" name="order_code" value="<?php echo $alpha . '-' . $beta; ?>" class="form-control" readonly>
                                    </div>
                                </div>
                                <hr>
                                <?php
                                if (isset($_GET['prod_id'])) {
                                    $prod_id = $_GET['prod_id'];
                                    $ret = "SELECT * FROM rpos_products WHERE prod_id = ?";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('s', $prod_id);
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    if ($prod = $res->fetch_object()) {
                                ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Product Name</label>
                                                <input type="text" readonly name="prod_name" value="<?php echo $prod->prod_name; ?>" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Product Price ($)</label>
                                                <input type="text" readonly name="prod_price" value="<?php echo $prod->prod_price; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label>Product Quantity</label>
                                                <input type="number" name="prod_qty" class="form-control" required>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                                <br>
                                <input type="submit" name="make" value="Make Order" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <?php if (isset($_SESSION['last_order'])) { ?>
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3>Order Summary</h3>
                    </div>
                    <div class="card-body">
                        <p><strong>Product Name:</strong> <?php echo $_SESSION['last_order']['prod_name']; ?></p>
                        <p><strong>Product Price:</strong> $<?php echo $_SESSION['last_order']['prod_price']; ?></p>
                        <p><strong>Quantity:</strong> <?php echo $_SESSION['last_order']['prod_qty']; ?></p>
                        <p><strong>Total Price:</strong> $<?php echo $_SESSION['last_order']['total_price']; ?></p>
                    </div>
                </div>
            <?php unset($_SESSION['last_order']); } ?>
            <?php require_once('partials/_footer.php'); ?>
        </div>
    </div>

    <script>
        document.getElementById("custName").addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            document.getElementById("customerID").value = selectedOption.value;
        });

        document.addEventListener("DOMContentLoaded", function() {
    let cart = JSON.parse(localStorage.getItem("cart"));
    if (cart) {
        let cartContainer = document.createElement("div");
        cartContainer.innerHTML = "<h3>Cart Items</h3>";
        
        Object.keys(cart).forEach(id => {
            let item = cart[id];
            cartContainer.innerHTML += `
                <p><strong>${item.name}</strong> - $${item.price} x ${item.qty} = $${(item.price * item.qty).toFixed(2)}</p>
                <input type="hidden" name="prod_id[]" value="${id}">
                <input type="hidden" name="prod_name[]" value="${item.name}">
                <input type="hidden" name="prod_price[]" value="${item.price}">
                <input type="hidden" name="prod_qty[]" value="${item.qty}">
            `;
        });

        // Add the cart container inside the form
        document.querySelector("form").appendChild(cartContainer);
    }
});
document.querySelector("form").addEventListener("submit", function() {
    localStorage.removeItem("cart");
});
        
    </script>
    
</body>
</html>