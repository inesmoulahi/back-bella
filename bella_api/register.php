<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "bella_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$password = md5($conn->real_escape_string($data['password'])); // crypté
$user_type = 'user';

// Vérifier si l'email existe déjà
$check = $conn->query("SELECT * FROM users WHERE email = '$email'");
if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Email déjà enregistré."]);
} else {
    $sql = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Inscription réussie"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'inscription"]);
    }
}

$conn->close();
?>
