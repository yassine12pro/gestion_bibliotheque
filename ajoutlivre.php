<?php
require 'DbConnection.php';

// Récupérer les valeurs du formulaire
$titre = $_POST['titre'];
$auteur = $_POST['auteur'];
$genre = $_POST['genre'];
$isbn = $_POST['isbn'];

try {
    // Vérifier si l'auteur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM Auteur WHERE nom = :auteur");
    $stmt->execute(['auteur' => $auteur]);
    $auteurData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($auteurData) {
        $auteur_id = $auteurData['id'];
    } else {
        // Insérer un nouvel auteur
        $stmt = $pdo->prepare("INSERT INTO Auteur (nom) VALUES (:auteur)");
        $stmt->execute(['auteur' => $auteur]);
        $auteur_id = $pdo->lastInsertId();
    }

    // Vérifier si le genre existe déjà
    $stmt = $pdo->prepare("SELECT id FROM Genre WHERE nom = :genre");
    $stmt->execute(['genre' => $genre]);
    $genreData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($genreData) {
        $genre_id = $genreData['id'];
    } else {
        // Insérer un nouveau genre
        $stmt = $pdo->prepare("INSERT INTO Genre (nom) VALUES (:genre)");
        $stmt->execute(['genre' => $genre]);
        $genre_id = $pdo->lastInsertId();
    }

    // Insérer le livre
    $auteur_id= (int)$auteur_id;
    $genre_id = (int)$genre_id;
    $req = "INSERT INTO Livre (titre, auteur_id, genre_id, ISBN, disponible)   VALUES ('$titre', $auteur_id, $genre_id, '$isbn', 1)";


    try{
        $res = $pdo->exec($req);
        if($res == 0){
            echo "problem d ajout";
        }else {
            header("location:gestionlivre.php");

        } 
    }catch(PDOException $e){
        echo "Erreur ::: " . $e->getMessage();

    }







} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
