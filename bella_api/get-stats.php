<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$stats = [];

$stats['products'] = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$stats['users'] = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$stats['orders'] = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
$stats['sales'] = $conn->query("SELECT SUM(total_price) as total FROM orders")->fetch_assoc()['total'] ?? 0;

echo json_encode($stats);
$conn->close();
?>
