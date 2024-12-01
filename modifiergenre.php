<?php
require 'DbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = intval($_POST['id']);
    $nom = trim($_POST['nom']);
    $description = trim($_POST['desc']);

    // Validation des données
    if (empty($nom) || empty($description) ) {
        die("Erreur : données invalides.");
    }

    try {
        // Mise à jour des informations de l'auteur dans la base de données
        $req = "UPDATE Genre 
                SET nom = :nom, description = :description 
                WHERE id = :id";

        $stmt = $pdo->prepare($req);
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'id' => $id
        ]);

        // Vérifier si la mise à jour a réussi
        if ($stmt->rowCount() > 0) {
            // Redirection après modification avec un message de succès
            header("Location: gestiongenres.php?success=1");
            exit();
        } else {
            echo "Erreur : aucun enregistrement mis à jour.";
        }
    } catch (PDOException $e) {
        echo "Erreur de mise à jour : " . $e->getMessage();
    }
} else {
    die("Méthode de requête non autorisée.");
}
?>
