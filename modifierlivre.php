<?php
require 'DbConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = intval($_POST['id']);
    $titre = trim($_POST['titre']);
    $auteur_id = intval($_POST['auteur_id']); // ID sélectionné dans le formulaire
    $genre_id = intval($_POST['genre_id']);   // ID sélectionné dans le formulaire
    $isbn = trim($_POST['isbn']);

    // Validation des données
    if (empty($titre) || empty($isbn) || $auteur_id <= 0 || $genre_id <= 0) {
        die("Erreur : données invalides.");
    }

    try {
        // Mise à jour dans la base de données
        $req = "UPDATE Livre 
                SET titre = :titre, ISBN = :isbn, 
                    auteur_id = :auteur_id, 
                    genre_id = :genre_id
                WHERE id = :id";

        $stmt = $pdo->prepare($req);
        $stmt->execute([
            'titre' => $titre,
            'isbn' => $isbn,
            'auteur_id' => $auteur_id,
            'genre_id' => $genre_id,
            'id' => $id
        ]);

        // Vérifier si la mise à jour a réussi
        if ($stmt->rowCount() > 0) {
            // Redirection après modification
            header("Location: gestionlivre.php?success=1");
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




