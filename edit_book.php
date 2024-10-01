<?php
session_start();
require 'config.php'; // Assurez-vous que ce fichier contient la connexion à la base de données

// Vérifiez si l'ID du livre est passé dans l'URL
if (!isset($_GET['id'])) {
    header("Location: list_books.php"); // Redirigez si aucun ID n'est fourni
    exit;
}

$book_id = $_GET['id'];

// Récupérer les détails du livre à modifier
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$book_id]);
$book = $stmt->fetch();

if (!$book) {
    echo "Livre introuvable.";
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];
    $annee_publication = $_POST['annee_publication'];
    $isbn = $_POST['isbn'];
    $copies_disponibles = $_POST['copies_disponibles'];

    // Mettre à jour les informations du livre dans la base de données
    $stmt = $pdo->prepare("UPDATE books SET titre = ?, auteur = ?, categorie = ?, annee_publication = ?, isbn = ?, copies_disponibles = ? WHERE id = ?");
    $stmt->execute([$titre, $auteur, $categorie, $annee_publication, $isbn, $copies_disponibles, $book_id]);

    // Rediriger vers la liste des livres après la mise à jour
    header("Location: list_books.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Livre</title>
</head>
<body>
    <h1>Modifier le Livre</h1>
    
    <form method="POST">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($book['titre']); ?>" required><br>

        <label for="auteur">Auteur:</label>
        <input type="text" name="auteur" id="auteur" value="<?php echo htmlspecialchars($book['auteur']); ?>" required><br>

        <label for="categorie">Catégorie:</label>
        <input type="text" name="categorie" id="categorie" value="<?php echo htmlspecialchars($book['categorie']); ?>" required><br>

        <label for="annee_publication">Année de Publication:</label>
        <input type="number" name="annee_publication" id="annee_publication" value="<?php echo htmlspecialchars($book['annee_publication']); ?>" required><br>

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required><br>

        <label for="copies_disponibles">Copies Disponibles:</label>
        <input type="number" name="copies_disponibles" id="copies_disponibles" value="<?php echo htmlspecialchars($book['copies_disponibles']); ?>" required><br>

        <button type="submit">Mettre à Jour</button>
    </form>

    <a href="list_books.php">Retour à la liste des livres</a>
</body>
</html>