<?php
session_start();
require 'config.php';

$book_id = $_GET['id'] ?? null;

if ($book_id === null || !is_numeric($book_id)) {
    die("ID de livre invalide.");
}

try {
    // Requête SQL pour supprimer le livre
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$book_id]);

    if ($stmt->rowCount() > 0) {
        // Livre supprimé avec succès
        $_SESSION['message'] = "Livre supprimé avec succès.";
    } else {
        // Aucun livre trouvé avec cet ID
        $_SESSION['message'] = "Aucun livre trouvé avec cet ID.";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Erreur lors de la suppression : " . $e->getMessage();
}

// Rediriger vers la page de liste des livres après la suppression
header("Location: list_books.php");
exit;
?>