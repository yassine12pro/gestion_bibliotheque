<?php
require 'DbConnection.php';

// Récupérer les valeurs du formulaire
$titre = $_POST['titre'];
$auteur_id = (int)$_POST['auteur_id'];
$genre_id = (int)$_POST['genre_id'];
$isbn = $_POST['isbn'];
$imagePath = null;

// Vérifier si une image a été téléchargée
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/'; // Dossier où stocker les images
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Créer le dossier s'il n'existe pas
    }

    $fileTmpPath = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $destinationPath = $uploadDir . $fileName;

    // Déplacer le fichier vers le dossier cible
    if (move_uploaded_file($fileTmpPath, $destinationPath)) {
        $imagePath = $destinationPath;
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}

try {
    // Insérer le livre
    $stmt = $pdo->prepare("INSERT INTO Livre (titre, auteur_id, genre_id, ISBN, disponible, image) VALUES (:titre, :auteur_id, :genre_id, :isbn, 1, :image)");
    $stmt->execute([
        'titre' => $titre,
        'auteur_id' => $auteur_id,
        'genre_id' => $genre_id,
        'isbn' => $isbn,
        'image' => $imagePath
    ]);

    header("Location: gestionlivre.php");
    exit();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
