<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if (!isset($_GET['order_id'])) {
    echo "<script>alert('Invalid order ID'); window.location.href='payments.php';</script>";
    exit();
}

$orderID = $_GET['order_id'];

// Fetch order details
$stmt = $mysqli->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$cashierName = 'Unknown';
if (!empty($order['staff_id'])) {
    $stmt = $mysqli->prepare("SELECT staff_name FROM rpos_staff WHERE staff_number = ?");
    $stmt->bind_param("s", $order['staff_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($staff = $result->fetch_assoc()) {
        $cashierName = $staff['staff_name'];
    }
}

// Fetch order items
$stmt = $mysqli->prepare("SELECT oi.*, p.prod_name, p.barcode FROM order_items oi JOIN rpos_products p ON oi.product_id = p.prod_id WHERE oi.order_id = ?");
$stmt->bind_param("s", $orderID);
$stmt->execute();
$orderItems = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
    body {
        width: 3.15in; /* Medium receipt width */
        font-family: 'Courier New', Courier, monospace;
        margin: auto;
        background: #f8f8e8;
    }
    .receipt {
        background: #fff;
        padding: 10px;
        box-shadow: 0 0 5px #ccc;
    }
    .center {
        text-align: center;
    }
    .bold {
        font-weight: bold;
    }
    hr {
        border: 1px dashed #000;
        margin: 8px 0;
    }
    table {
        width: 100%;
        font-size: 14px;
    }
    svg#barcode {
        display: block;
        margin: 0 auto;
        width: 100%;
        height: 50px;
    }
    .print-btn {
        display: block;
        margin: 15px auto 0;
        padding: 6px 12px;
        font-size: 14px;
        cursor: pointer;
    }
    @media print {
        .print-btn {
            display: none;
        }
    }
</style>

</head>
<body>
    <div class="receipt">
        <div class="center">
            <p class="bold">PURRFECT CAFE</p>
            <svg id="barcode" class="barcode"></svg>
            <p>SABANG, DANAO CITY<br>(63)9926057337<br>
               www.purrfectcafe.com</p>
        </div>
        <hr>
        <p>Receipt No.: <span class="bold"><?php echo htmlspecialchars($orderID); ?></span><br>
           Date: <?php echo date("Y-m-d H:i:s"); ?></p>
        <table>
            <thead>
                <tr class="bold">
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $orderItems->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['prod_name']); ?></td>
                    <td><?php echo intval($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <hr>
        <p>Subtotal: $<?php echo number_format($order['total_price'], 2); ?><br>
           <span class="bold">Grand Total: $<?php echo number_format($order['total_price'], 2); ?></span></p>
        <hr>
        <p class="bold">Payment Detail:</p>
<p>
    Mode: Cash<br>
    Card Number: -<br>
    Amount: $<?php echo number_format($order['cash_received'], 2); ?><br>
    Change: $<?php echo number_format($order['change_amount'], 2); ?><br>
    Cashier: <?php echo htmlspecialchars($cashierName); ?>
</p>


        <hr>
        <div class="center">
            <p>Thank you for your visit</p>
        </div>
    </div>

    <!-- Print Button -->
    <button onclick="window.print()" class="print-btn">Print Receipt</button>

    <!-- JsBarcode -->
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<script>
    JsBarcode("#barcode", "<?php echo htmlspecialchars($orderID); ?>", {
        format: "CODE128",
        lineColor: "#000",
        width: 2.2,         // Slightly wider bars for more space
        height: 50,
        displayValue: true,
        fontSize: 16,
        margin: 0
    });
</script>

</body>
</html>
