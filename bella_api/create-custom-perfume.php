<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$user_id = intval($data['user_id'] ?? 0);
$name = $conn->real_escape_string($data['name']);
$ingredients = $conn->real_escape_string(implode(", ", $data['ingredients']));
$bottle_message = $conn->real_escape_string($data['bottle_message'] ?? '');

if (empty($name) || empty($ingredients)) {
    echo json_encode(["success" => false, "message" => "Nom ou ingrédients manquants"]);
    exit();
}

$sql = "INSERT INTO custom_perfumes (user_id, name, ingredients, bottle_message)
        VALUES ($user_id, '$name', '$ingredients', '$bottle_message')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "🎉 Parfum personnalisé enregistré avec succès !"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement"]);
}

$conn->close();
?>
