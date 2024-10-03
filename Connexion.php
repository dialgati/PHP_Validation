<?php
session_start();
require 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM membres WHERE email = ?");
    $stmt->execute([$email]);
    $membre = $stmt->fetch();

    if ($membre && password_verify($password, $membre['password'])) {
       $_SESSION['membre_id'] = $membre['id']; 
       header("Location: Dashboard.php"); 
       exit;
    } else {
        echo "Email ou mot de passe incorrect.";
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
    <div class="connexion">
        <form method='POST' class="signup-form">
            <h2>Connexion</h2>
            <?php if (isset($error)): ?>
                <p style="color:red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autocomplete="email" required>
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
       <div class="lien">
        <p>Vous n'avez pas de compte </p>
         <a href="Inscription.php"> S'inscrire</a>
       </div>
    </div>
</body>
</html>
