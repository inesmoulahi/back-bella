<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bella_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Erreur de connexion"]));
}

// Lire les données JSON reçues depuis Angular
$data = json_decode(file_get_contents("php://input"), true);

// Simuler un utilisateur connecté (à remplacer plus tard)
$user_id = 14;

$pid = $conn->real_escape_string($data['id']);
$name = $conn->real_escape_string($data['name']);
$price = $data['price'];
$image = $conn->real_escape_string($data['image']);
$quantity = 1;

// Vérifier si le produit est déjà dans le panier
$check = $conn->query("SELECT * FROM cart WHERE user_id = $user_id AND pid = $pid");
if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "Produit déjà dans le panier"]);
} else {
    $sql = "INSERT INTO cart (user_id, pid, name, price, quantity, image)
            VALUES ($user_id, $pid, '$name', $price, $quantity, '$image')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Produit ajouté au panier"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout"]);
    }
}

$conn->close();
?>
