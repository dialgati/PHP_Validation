<?php
session_start();
require 'config.php';

// Redirection si l'utilisateur n'est pas connecté
// if (!isset($_SESSION['membre_id'])) {
//     header("Location:Connexion.php");
//     exit;
// }
$_SESSION['test'] = 42;
$membre_id = $_SESSION['membre_id'];
// $colors = array("red", "green", "blue", "yellow");

// foreach ($colors as $x) {
//   echo "$x <br>";
// }
// echo count($_SESSION);
foreach ($_SESSION as $x) {
  echo "$x <br>";
}
// Requête pour obtenir le nombre total de membres
$stmt = $pdo->prepare("SELECT COUNT(*) as total_membres FROM membres");
$stmt->execute();
$total_membres = $stmt->fetchColumn();

// Requête pour obtenir le nombre total de livres
$stmt = $pdo->prepare("SELECT COUNT(*) as total_books FROM books");
$stmt->execute();
$total_books = $stmt->fetchColumn();

// Requête pour obtenir le nombre total d'emprunts
$stmt = $pdo->prepare("SELECT COUNT(*) as total_emprunts FROM emprunts");
$stmt->execute();
$total_emprunts = $stmt->fetchColumn();

// Requête pour obtenir les informations du membre connecté
$stmt = $pdo->prepare("SELECT * FROM membres WHERE id = ?");
$stmt->execute([$membre_id]);
$membre = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <!-- Barre de navigation -->
        <nav class="sidebar">
            <h2>Mon Dashboard</h2>  
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="list_books.php">Membres</a></li>
                <li><a href="#">Statistiques</a></li>
                <li><a href="#">Paramètres</a></li>
                <li><a href="Deconnexion.php">Déconnexion</a></li>
            </ul>
        </nav>

        <!-- Contenu principal -->
        <div class="main-content">
            <header>
                <h1>Bienvenue sur le Dashboard</h1>
            </header>

            <section class="stats-grid">
                <div class="card">
                    <h3>Nombre d'utilisateurs</h3>
                    <p><?php echo htmlspecialchars($total_membres); ?></p>
                </div>
                <div class="card">
                    <h3>Nombre de livres</h3>
                    <p><?php echo htmlspecialchars($total_books); ?></p>
                </div>
                <div class="card">
                    <h3>Livres empruntés</h3>
                    <p><?php echo htmlspecialchars($total_emprunts); ?></p>
                </div>
            </section>
        </div>

        <!-- Affichage des infos du membre -->
        <h2>Mes infos</h2>
        <?php
        if ($membre) {
            echo "<p>Prénom : " . htmlspecialchars($membre['prenom']) . "</p>";
            echo "<p>Nom : " . htmlspecialchars($membre['nom']) . "</p>";
            echo "<p>Email : " . htmlspecialchars($membre['email']) . "</p>";
        } else {
            echo "<p>Aucun membre trouvé.</p>";
        }
        ?>
    </div>
</body>
</html>
