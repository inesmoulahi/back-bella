<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $conn->real_escape_string($data['name']);
$details = $conn->real_escape_string($data['details']);
$price = intval($data['price']);
$image = $conn->real_escape_string($data['image']); // nom du fichier image (ex: 'rose.jpg')

$sql = "INSERT INTO products (name, details, price, image) VALUES ('$name', '$details', $price, '$image')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Produit ajouté"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout"]);
}

$conn->close();
?>
