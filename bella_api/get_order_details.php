<?php
include 'config.php';

header('Content-Type: application/json');

$order_id = $_GET['order_id'];

$sql = "SELECT p.name, p.price, c.quantity 
        FROM cart c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = (SELECT user_id FROM orders WHERE id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

$orderDetails = array();

while($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}

echo json_encode($orderDetails);
