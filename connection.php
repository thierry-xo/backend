<?php
$host = "localhost";
$dbname = "gestioncomments"; // Remplacez par le nom de votre base
$username = "root"; // Votre utilisateur MySQL
$password = ""; // Votre mot de passe MySQL

try {
    $con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
