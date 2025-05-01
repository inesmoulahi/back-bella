<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");
$data = json_decode(file_get_contents("php://input"), true);
$user_id = intval($data['user_id']);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Erreur de connexion"]);
    exit();
}

$conn->query("DELETE FROM cart WHERE user_id = $user_id");
echo json_encode(["success" => true, "message" => "Panier vidé"]);
$conn->close();
?>
