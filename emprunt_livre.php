<?php
session_start();
require 'config.php';

// if (!isset($_SESSION['membre_id'])) {
//         header("Location: Connexion.php");
//         exit;
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['emprunt'])) {
    $book_id = $_POST['book_id'];
    $membre_id = $_SESSION['membre_id'];

    // Vérifiez si le livre est disponible
    $stmt = $pdo->prepare("SELECT copies_disponibles FROM books WHERE id = ?");
    $stmt->execute([$book_id]);
    $book = $stmt->fetch();


   if ($book && $book['copies_disponibles'] > 0) {
    // Insérer l'emprunt dans la table emprunts
    $stmt = $pdo->prepare("INSERT INTO emprunts (membre_id, book_id, emprunt_date, emprunt_rendu) VALUES (?, ?, NOW(), NULL)");
    $stmt->execute([$membre_id, $book_id]);

    // Mettre à jour le nombre de copies disponibles
    $stmt = $pdo->prepare("UPDATE books SET copies_disponibles = copies_disponibles - 1 WHERE id = ?");
    $stmt->execute([$book_id]);

    echo "Livre emprunté avec succès.";
} else {
    echo "Désolé, ce livre n'est pas disponible.";
}

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emprunter un Livre</title>
</head>
<body>
<h2>Emprunter un Livre</h2>

<form method="POST">
    <label for="membre_id">ID du membre :</label>
    <input type="number" name="membre_id" id="membre_id" required>
    <label for="book_id">ID du livre :</label>
    <input type="number" name="book_id" id="book_id" required>
    <button type="submit" name="emprunt">Emprunter</button>
</form>

<a href="Dashboard.php">Retour au tableau de bord</a>
</body>
</html>