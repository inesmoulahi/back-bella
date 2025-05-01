<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$user_id = intval($data['user_id'] ?? 0);
$product_id = intval($data['product_id'] ?? 0);
$comment = $conn->real_escape_string($data['comment']);
$rating = intval($data['rating'] ?? 0);

if ($user_id === 0 || $product_id === 0 || empty($comment) || $rating < 1 || $rating > 5) {
    echo json_encode(["success" => false, "message" => "Champs invalides"]);
    exit();
}

$sql = "INSERT INTO reviews (user_id, product_id, comment, rating) VALUES ($user_id, $product_id, '$comment', $rating)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur insertion"]);
}

$conn->close();
?>
