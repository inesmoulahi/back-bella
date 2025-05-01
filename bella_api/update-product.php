<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$id = intval($data['id']);
$name = $conn->real_escape_string($data['name']);
$details = $conn->real_escape_string($data['details']);
$price = intval($data['price']);
$image = $conn->real_escape_string($data['image']);

$sql = "UPDATE products SET name='$name', details='$details', price=$price, image='$image' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Produit mis à jour"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour"]);
}

$conn->close();
?>
