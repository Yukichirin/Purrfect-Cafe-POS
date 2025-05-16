<?php
session_start();
include('config/config.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get the cart data from the request
$cartData = json_decode(file_get_contents('php://input'), true);

// Check if cart data is empty
if (empty($cartData)) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty']);
    exit;
}

// Assume you have a user_id from the session
$user_id = $_SESSION['user_id'];

// Start a transaction (optional but recommended)
$mysqli->begin_transaction();

try {
    // Insert the order into the rpos_orders table
    $orderQuery = "INSERT INTO rpos_orders (user_id, order_date, total_price) VALUES (?, NOW(), ?)";
    $stmt = $mysqli->prepare($orderQuery);
    
    // Calculate total price
    $totalPrice = 0;
    foreach ($cartData as $item) {
        $totalPrice += $item['price'] * $item['qty'];
    }

    $stmt->bind_param('id', $user_id, $totalPrice);
    $stmt->execute();
    
    // Get the last inserted order ID
    $order_id = $mysqli->insert_id;

    // Insert each cart item into the rpos_order_items table
    $itemQuery = "INSERT INTO rpos_order_items (order_id, product_id, qty, price) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($itemQuery);
    
    foreach ($cartData as $item) {
        $stmt->bind_param('iiid', $order_id, $item['id'], $item['qty'], $item['price']);
        $stmt->execute();
    }

    // Commit the transaction
    $mysqli->commit();

    // Respond with success
    echo json_encode(['success' => true, 'message' => 'Order placed successfully']);
} catch (Exception $e) {
    // Rollback the transaction in case of error
    $mysqli->rollback();
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
