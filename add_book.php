<?php
     $serveur = "localhost";
     $login = "root";
     $pass =  "dia_yaya";


try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$serveur;dbname=bibliotheque", $login, $pass);
    // Définir le mode d'erreur de PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $title = $_POST['titre'];
        $author = $_POST['auteur'];
        $category = $_POST['categorie'];
        $publication_year = $_POST['annee_publication'];
        $isbn = $_POST['isbn'];
        $available_copies = $_POST['copies_disponibles'];

        // Préparer et exécuter la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO books (titre, auteur, categorie, annee_publication, isbn, copies_disponibles) 
                                VALUES (:titre, :auteur, :categorie, :annee_publication, :isbn, :copies_disponibles)");
        $stmt->bindParam(':titre', $title);
        $stmt->bindParam(':auteur', $author);
        $stmt->bindParam(':categorie', $category);
        $stmt->bindParam(':annee_publication', $publication_year);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':copies_disponibles', $available_copies, PDO::PARAM_INT);

        $stmt->execute();
        echo "Livre ajouté avec succès!";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Livre</title>
</head>
<body>
    <h1>Ajouter un Livre</h1>
    <form method="post">
        Titre: <input type="text" name="titre" required><br>
        Auteur: <input type="text" name="auteur" required><br>
        Catégorie: <input type="text" name="categorie" required><br>
        Année de Publication: <input type="number" name="annee_publication" required><br>
        ISBN: <input type="number" name="isbn" required><br>
        Copies Disponibles: <input type="number" name="copies_disponibles" required><br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>