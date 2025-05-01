<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bella_db";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Connexion échouée à la base de données"]));
}
?>
