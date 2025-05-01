<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['id'];

$sql = "DELETE FROM products WHERE id = $product_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Produit supprimé"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de la suppression"]);
}

$conn->close();
?>
