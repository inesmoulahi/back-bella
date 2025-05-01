<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée"]));
}

$data = json_decode(file_get_contents("php://input"), true);
$id = intval($data['id']);
$reply = $conn->real_escape_string($data['reply']);

$sql = "UPDATE message SET reply = '$reply' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Réponse envoyée"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de la réponse"]);
}

$conn->close();
?>
