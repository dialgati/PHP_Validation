<?php
session_start();
require 'config.php';

if (!isset($_SESSION['member_id'])) {
   header("Location: Dashboard.php");
   exit;
}

$search_results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Recherche par titre ou auteur
   if (isset($_POST['search'])) {
       $search_term = "%" . $_POST['search_term'] . "%";
       $stmt = $pdo->prepare("SELECT * FROM books WHERE titre LIKE ? OR auteur LIKE ?");
       $stmt->execute([$search_term, $search_term]);
       $search_results = $stmt->fetchAll();
   }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <title>Recherche de livres</title>
</head>
<body>

<h2>Recherche de livres :</h2>

<form method='POST'>
   <input type='text' name='search_term' placeholder='Titre ou Auteur' required />
   <button type='submit' name='search'>Rechercher</button><br/><br/>
</form>

<h3>Résultats de la recherche :</h3>

<table border='1'>
   <tr><th>ID</th><th>Titre</th><th>Auteur</th><th>Catégorie</th></tr>

   <?php foreach ($search_results as $book): ?>
      <tr>
         <td><?php echo htmlspecialchars($book['id']); ?></td>
         <td><?php echo htmlspecialchars($book['titre']); ?></td>
         <td><?php echo htmlspecialchars($book['auteur']); ?></td>
         <td><?php echo htmlspecialchars($book['categorie']); ?></td>
      </tr>
   <?php endforeach; ?>
   
</table>

<a href='dashboard.php'>Retour au tableau de bord</a>

</body></html>
