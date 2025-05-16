<?php
include('config/config.php');

$filter = $_GET['filter'] ?? 'this_month';

switch ($filter) {
  case 'today':
    $condition = "DATE(o.created_at) = CURDATE()";
    break;
  case 'yesterday':
    $condition = "DATE(o.created_at) = CURDATE() - INTERVAL 1 DAY";
    break;
  case 'this_week':
    $condition = "YEARWEEK(o.created_at, 1) = YEARWEEK(CURDATE(), 1)";
    break;
  case 'this_month':
  default:
    $condition = "MONTH(o.created_at) = MONTH(CURDATE()) AND YEAR(o.created_at) = YEAR(CURDATE())";
    break;
}

$query = "
  SELECT p.prod_name, SUM(oi.quantity * p.prod_price) AS total_sales
  FROM order_items oi
  JOIN rpos_products p ON oi.product_id = p.prod_id
  JOIN orders o ON oi.order_id = o.order_id
  WHERE $condition
  GROUP BY p.prod_name
  ORDER BY total_sales DESC
  LIMIT 7
";

$stmt = $mysqli->prepare($query);
$stmt->execute();
$res = $stmt->get_result();

$data = ['labels' => [], 'sales' => []];
while ($row = $res->fetch_assoc()) {
  $data['labels'][] = $row['prod_name'];
  $data['sales'][] = round($row['total_sales'], 2);
}

header('Content-Type: application/json');
echo json_encode($data);
