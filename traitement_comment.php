

<?php
require 'DbConnection.php';

// Récupérer les valeurs du formulaire
$id = $_POST['id'];
$comment = $_POST['comment'];


try {
    // Préparer et exécuter la requête
    $stmt = $pdo->prepare("INSERT INTO commentaires (livre_id, commentaire) 
                           VALUES (:livre_id, :comment)");
    $stmt->execute([
        ':livre_id' => $id,
        ':comment' => $comment,
    ]);

    if ($stmt->rowCount() > 0) {
        header("location:index.php");
    } else {
        echo "Problème d'ajout.";
    }
} catch (PDOException $e) {
    echo "Erreur ::: " . $e->getMessage();
}
