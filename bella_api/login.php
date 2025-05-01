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

$email = $conn->real_escape_string($data['email']);
$password = md5($conn->real_escape_string($data['password'])); // doit correspondre à la méthode dans register

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "message" => "Connexion réussie",
        "user" => [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "user_type" => $user['user_type']
        ]
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect"]);
}

$conn->close();
?>
