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

$user_id = 14; 
$name = $conn->real_escape_string($data['name']);
$number = $conn->real_escape_string($data['number']);
$email = $conn->real_escape_string($data['email']);
$method = $conn->real_escape_string($data['method']);
$address = $conn->real_escape_string($data['address']);
$total_products = $conn->real_escape_string($data['total_products']);
$total_price = $data['total_price'];
$placed_on = date("d-M-Y");

$sql = "INSERT INTO orders (user_id, name, number, email, method, address, total_products, total_price, placed_on)
        VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$placed_on')";

if ($conn->query($sql) === TRUE) {

    // ✅ Vider le panier après la commande
    $delete = "DELETE FROM cart WHERE user_id = $user_id";
    $conn->query($delete);

    echo json_encode(["success" => true, "message" => "Commande enregistrée et panier vidé"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement de la commande"]);
}

$conn->close();
?>

