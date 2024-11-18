<?php
//session_start();

require('config.php');
require('DbConnection.php');

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    // Validation des données
    if (empty($phone) || empty($email) || empty($password) || empty($nom)) {
        die("Tous les champs sont obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

   

    // Vérification si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM Utilisateur WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        die("Un compte avec cet email existe déjà.");
    }

    // Hachage du mot de passe
    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion dans la base de données
    $stmtt = $pdo->prepare("INSERT INTO Utilisateur (nom, email, phone, password) VALUES (:nom, :email, :phone, :password)");
    $stmtt->bindParam(':nom', $nom);
    $stmtt->bindParam(':email', $email);
    $stmtt->bindParam(':phone', $phone);
    $stmtt->bindParam(':password', $password);

    try {
        $stmtt->execute();
        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}
?>