<?php
session_start();
require 'config.php';

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['membre_id'])) {
    header("Location:Connexion.php");
    exit;
}
// $_SESSION['test'] = 42;
$membre_id = $_SESSION['membre_id'];
// $colors = array("red", "green", "blue", "yellow");

// foreach ($colors as $x) {
//   echo "$x <br>";
// }
// echo count($_SESSION);
// foreach ($_SESSION as $x) {
//   echo "$x <br>";
// }
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
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
          <button class="hamburger" id="hamburger">&#9776;</button>
        <!-- Barre de navigation -->
        <nav class="sidebar">
            <h2>Mon Dashboard</h2>  
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="list_books.php">Membres</a></li>
                <li><a href="#">Statistiques</a></li>
                <li><a href="#">Paramètres</a></li>
            </ul>
        </nav>

        <!-- Contenu principal -->
        <div class="main-content">
            <header>
                <h1>Bienvenue sur le Dashboard</h1>
            </header>

            <section class="stats-grid flex justify-center">
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
   
<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer mt-3 me-2" src="/images/téléchargement.jpeg" alt="User dropdown">

<!-- Dropdown menu -->
<div id="userDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 ">
    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
      <div>Bonnie Green</div>
      <div class="font-medium truncate">name@flowbite.com</div>
    </div>
    <div class="py-1">
      <a href="Deconnexion.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
    </div>
</div>


        <?php
        
        if ($membre) {
            echo "<p>Prénom : " . htmlspecialchars($membre['prenom']) . "</p>";
            echo "<p>Nom : " . htmlspecialchars($membre['nom']) . "</p>";
            echo "<p>Email : " . htmlspecialchars($membre['email']) . "</p>";
        } else {
            // echo "<p>Aucun membre trouvé.</p>";
        }
        ?>
    </div>
    <script src="/js/script.js"></script>
</body>
</html>
