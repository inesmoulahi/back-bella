<?php
header('Content-Type: application/json');
include 'config.php';

$user_id = $_GET['user_id'];


$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY placed_on DESC";
$result = mysqli_query($conn, $sql);

$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

echo json_encode($orders);
?>

