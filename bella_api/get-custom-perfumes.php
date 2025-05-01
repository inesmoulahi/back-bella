<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connexion échouée"]));
}

$sql = "SELECT * FROM custom_perfumes ORDER BY created_at DESC";
$result = $conn->query($sql);

$customPerfumes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customPerfumes[] = $row;
    }
}

echo json_encode($customPerfumes);
$conn->close();
?>
