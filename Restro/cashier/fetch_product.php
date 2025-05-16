<?php
include('config/config.php');

if (isset($_GET['barcode'])) {
    $barcode = $_GET['barcode'];
    $query = "SELECT * FROM rpos_products WHERE barcode=?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();
    echo json_encode($result->fetch_assoc());
}
?>
