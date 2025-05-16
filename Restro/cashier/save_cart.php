<?php
session_start();

// Generate a unique order ID if it doesn't exist
if (!isset($_SESSION['order_id'])) {
    $_SESSION['order_id'] = uniqid('order_', true);  // Generate a unique order ID
}

// Store the cart data
$data = json_decode(file_get_contents("php://input"), true);
if ($data) {
    $_SESSION['cart'] = $data;
    echo json_encode(["success" => true, "order_id" => $_SESSION['order_id']]);
} else {
    echo json_encode(["success" => false]);
}
?>

