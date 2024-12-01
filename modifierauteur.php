<?php
require 'DbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = intval($_POST['id']);
    $nom = trim($_POST['nom']);
    $biographie = trim($_POST['bio']);
    $date_de_naissance = $_POST['dn']; // La date est déjà formatée correctement avec le type "date"

    // Validation des données
    if (empty($nom) || empty($biographie) || empty($date_de_naissance)) {
        die("Erreur : données invalides.");
    }

    try {
        // Mise à jour des informations de l'auteur dans la base de données
        $req = "UPDATE Auteur 
                SET nom = :nom, biographie = :biographie, date_de_naissance = :date_de_naissance
                WHERE id = :id";

        $stmt = $pdo->prepare($req);
        $stmt->execute([
            'nom' => $nom,
            'biographie' => $biographie,
            'date_de_naissance' => $date_de_naissance,
            'id' => $id
        ]);

        // Vérifier si la mise à jour a réussi
        if ($stmt->rowCount() > 0) {
            // Redirection après modification avec un message de succès
            header("Location: gestionauteurs.php?success=1");
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
