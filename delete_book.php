<?php
$book_id = $_GET['id'];

// Requête SQL pour supprimer le livre
$stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
$stmt->execute([$book_id]);
echo "Livre supprimé";
// Rediriger vers la page de liste des livres après la suppression
header("Location: list_books.php");
exit;
?>