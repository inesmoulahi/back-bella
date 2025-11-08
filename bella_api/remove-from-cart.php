<?php
header('Content-Type: application/json');
include 'config.php';

$id = $_GET['id']; 

$sql = "DELETE FROM cart WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    echo json_encode(["success" => true, "message" => "Produit supprimé du panier"]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur suppression"]);
}
?>

