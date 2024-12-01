<?php
require 'DbConnection.php';
session_start();

$id = $_GET['id'];
$userId = $_SESSION['LOGGED_USER']['user_id'];

try {
    // Vérifier si le livre existe
    $stmt = $pdo->prepare("SELECT titre FROM Livre WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($book) {
        $titre = $book['titre'];

        // Mettre à jour la disponibilité du livre
        $stmt = $pdo->prepare("UPDATE Livre SET disponible = 0 WHERE id = :id");
        $stmt->execute(['id' => $id]);

        // Ajouter l'emprunt dans la base de données
        $stmt = $pdo->prepare("INSERT INTO Emprunt ( livre_id,utilisateur_id, date_emprunt) VALUES ( :livre_id,:user_id, :date_emprunt)");
        $stmt->execute([
            'user_id' => $userId,
            'livre_id' => $id,
            'date_emprunt' => date('Y-m-d')
        ]);


        $stmt = $pdo->prepare("INSERT INTO historique_emprunts (utilisateur_id, livre_id, date_emprunt) VALUES (:user_id, :livre_id, :date_emprunt)");
        $stmt->execute([
            'user_id' => $userId, 
            'livre_id' => $id,
            'date_emprunt' => date('Y-m-d'),
        ]);


        // Rediriger vers la page d'accueil
        header("location:index.php");
        exit();
    } else {
        echo "Livre non trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
