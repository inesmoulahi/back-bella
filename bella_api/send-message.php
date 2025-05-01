<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée"]));
}

$data = json_decode(file_get_contents("php://input"), true);

// Vérifier que les champs existent et ne sont pas vides
if (
    empty($data['name']) ||
    empty($data['email']) ||
    empty($data['number']) ||
    empty($data['message'])
) {
    echo json_encode(["success" => false, "message" => "Champs vides détectés"]);
    exit();
}

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$number = $conn->real_escape_string($data['number']);
$message = $conn->real_escape_string($data['message']);
$user_id = isset($data['user_id']) ? intval($data['user_id']) : 0;
// ✅ Validation du format email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Email invalide"]);
    exit();
}

$sql = "INSERT INTO message (user_id, name, email, number, message) VALUES ($user_id, '$name', '$email', '$number', '$message')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'insertion"]);
}

$conn->close();
?>
