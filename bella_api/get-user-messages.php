<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée"]));
}

$user_id = intval($_GET['user_id']);

$sql = "SELECT * FROM message WHERE user_id = $user_id ORDER BY id DESC";
$result = $conn->query($sql);

$messages = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode($messages);
$conn->close();
?>
