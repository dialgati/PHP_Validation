<?php
$host = 'localhost';
$db = 'bibliotheque';
$user = 'root'; // Remplacez par votre utilisateur MySQL
$pass = 'dia_yaya'; // Remplacez par votre mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>