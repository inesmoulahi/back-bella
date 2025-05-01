<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur connexion"]));
}

$product_id = intval($_GET['product_id'] ?? 0);

$sql = "SELECT * FROM reviews WHERE product_id = $product_id ORDER BY created_at DESC";
$result = $conn->query($sql);

$reviews = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

echo json_encode($reviews);
$conn->close();
?>
