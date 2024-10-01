<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO membres (prenom, nom, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$prenom, $nom, $email, $hashed_password]);
        echo "Utilisateur inscrit";
        header("Location:Connexion.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="inscription">
        <form method='POST' class="signup-form">
            <h2>Inscription</h2>

            <div class="input-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" required>
            </div>

            <div class="input-group">
                <label for="nom">Nom</label>
                <input type="text"  name="nom" required>
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">S'inscrire</button>
        </form>
        <div class="lien">
            <a href="Connexion.php">Déjà membre ? Se connecter</a>
        </div>
    </div>
</body>
</html>