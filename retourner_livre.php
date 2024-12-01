<?php
require 'DbConnection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['livre_id'])) {
    $livreId = $_POST['livre_id'];
    $userId = $_SESSION['LOGGED_USER']['user_id'];

    try {
        // Supprimer l'emprunt
        $stmt = $pdo->prepare("DELETE FROM Emprunt WHERE livre_id = :livre_id AND utilisateur_id = :user_id");
        $stmt->execute(['livre_id' => $livreId, 'user_id' => $userId]);

        // Mettre à jour la disponibilité du livre
        $stmt = $pdo->prepare("UPDATE Livre SET disponible = 1 WHERE id = :id");
        $stmt->execute(['id' => $livreId]);

         // Mettre à jour le retour du livre
            $dateRetour = date('Y-m-d'); // Générer la date actuelle en PHP
            $stmt = $pdo->prepare("UPDATE historique_emprunts SET date_retour = :date_retour WHERE livre_id = :id");
            $stmt->execute([
                'date_retour' => $dateRetour,
                'id' => $livreId
            ]);

        // Rediriger vers la page d'emprunts
        header("location:moncompte.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Requête invalide.";
}
?>
