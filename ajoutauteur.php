

<?php
require 'DbConnection.php';

// Récupérer les valeurs du formulaire
$nom = $_POST['nom'];
$bio = $_POST['bio'];
$dn = $_POST['dn']; // Récupère la date au format 'YYYY-MM-DD'

// Valider la date
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dn)) {
    echo "Date de naissance invalide.";
    exit;
} 

try {
    $stmt = $pdo->prepare("INSERT INTO Auteur (nom, biographie, date_de_naissance) 
                           VALUES (:nom, :bio, :dn)");
    $stmt->execute([
        ':nom' => $nom,
        ':bio' => $bio,
        ':dn' => $dn,
    ]);

    if ($stmt->rowCount() > 0) {
        header("location:gestionauteurs.php");
    } else {
        echo "Problème d'ajout.";
    }
} catch (PDOException $e) {
    echo "Erreur ::: " . $e->getMessage();
}

