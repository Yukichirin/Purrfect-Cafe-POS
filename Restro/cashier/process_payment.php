<?php
session_start();
include('config/config.php');
include('config/checklogin.php');
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $session_id = session_id(); // Unique identifier for the order
    $total_amount = floatval($_POST['total']);
    $cash_received = floatval($_POST['cash']);
    $change = $cash_received - $total_amount;

    if ($change < 0) {
        $_SESSION['error'] = "Insufficient cash received.";
        header("Location: orders.php"); // Redirect back to the order page
        exit();
    }

    // Insert order details into the database
    $query = "INSERT INTO payments (session_id, total_amount, cash_received, changes) 
              VALUES (?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sddd", $session_id, $total_amount, $cash_received, $change);

    if ($stmt->execute()) {
        // Clear the cart after successful order
        unset($_SESSION['cart']);
        $_SESSION['success'] = "Payment recorded successfully!";
        header("Location: receipts.php");
    } else {
        $_SESSION['error'] = "Failed to process payment.";
        header("Location: orders.php");
    }

    $stmt->close();
}
?>
