<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "bella_db");

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$genre = strtolower($data['genre'] ?? '');
$type = strtolower($data['type'] ?? '');
$occasion = strtolower($data['occasion'] ?? '');
$budget = strtolower($data['budget'] ?? '');

$productId = null;


if ($genre === 'femme' && $type === 'floral' && $occasion === 'soirée' && $budget === 'luxe') {
    $productId = 17; // AQUA ALLEGORIA
} elseif ($genre === 'femme' && $type === 'lavande' && $occasion === 'quotidien') {
    $productId = 15; // SEOUL
} elseif ($genre === 'homme' && $type === 'boisé' && $occasion === 'soirée' && $budget === 'luxe') {
    $productId = 27; // LAURENT
} elseif ($genre === 'homme' && $type === 'boisé' && $occasion === 'quotidien') {
    $productId = 18; // HUGO
} elseif ($genre === 'femme' && $type === 'lavande' && $occasion === 'journée') {
    $productId = 21; // LAVIN
} elseif ($genre === 'homme' && $type === 'boisé' && $occasion === 'journée') {
    $productId = 29; // CHANEL BLUE
} elseif ($genre === 'femme' && $type === 'fruité' && $occasion === 'journée') {
    $productId = 13; // DI GIOIA
} elseif ($budget === 'moyen') {
    $productId = 23; // COCO
} else {
    $productId = 23; // par défaut COCO
}

$sql = "SELECT * FROM products WHERE id = $productId LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode([
        "name" => "Bella Classique",
        "details" => "Parfum doux universel, parfait pour tous",
        "price" => 99,
        "image" => "pink bouquet.jpg"
    ]);
}

$conn->close();
?>

