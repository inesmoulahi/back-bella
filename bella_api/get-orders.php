<?php
header('Content-Type: application/json');
include 'config.php';

// On récupère l'identifiant de l'utilisateur (passé en paramètre GET)
$user_id = $_GET['user_id'];

// Requête pour récupérer toutes ses commandes
$sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY placed_on DESC";
$result = mysqli_query($conn, $sql);

// On transforme les résultats en tableau
$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}

// On renvoie les données en format JSON
echo json_encode($orders);
?>
