<?php

 $serveur = "localhost";
 $login = "root";
 $pass =  "dia_yaya";
// list_books.php
$conn = new PDO("mysql:host=$serveur;dbname=bibliotheque", $login, $pass);

$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Barre de navigation -->
        <nav class="sidebar">
            <h2>Mon Dashboard</h2>
            <ul>
                <li><a href="Dashboard.php">Accueil</a></li>
                <li><a href="list_books.php">Profil</a></li>
                <li><a href="#">Statistiques</a></li>
                <li><a href="#">Paramètres</a></li>
                <li><a href="#">Déconnexion</a></li>
            </ul>
        </nav>

        <!-- Contenu principal -->
        <div class="main-content">
            <h1>Liste des Livres</h1>
   <table border="1">
    <tr class="table-entete">
        <th>ID</th>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Catégorie</th>
        <th>Année</th>
        <th>ISBN</th>
        <th>Copies Disponibles</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['titre']; ?></td>
        <td><?php echo $row['auteur']; ?></td>
        <td><?php echo $row['categorie']; ?></td>
        <td><?php echo $row['annee_publication']; ?></td>
        <td><?php echo $row['isbn']; ?></td>
        <td><?php echo $row['copies_disponibles']; ?></td>
        <td>
            <a href="edit_book.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a>
            <a href="delete_book.php?id=<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
        </div>
    </div>
</body>
</html>
