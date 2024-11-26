

<?php
require 'DbConnection.php';

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$descc = $_POST['desc'];


try {
    // Préparer et exécuter la requête
    $stmt = $pdo->prepare("INSERT INTO Genre (nom, description) 
                           VALUES (:nom, :descc)");
    $stmt->execute([
        ':nom' => $nom,
        ':descc' => $descc,
    ]);

    if ($stmt->rowCount() > 0) {
        header("location:gestiongenres.php");
    } else {
        echo "Problème d'ajout.";
    }
} catch (PDOException $e) {
    echo "Erreur ::: " . $e->getMessage();
}

