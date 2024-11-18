<?php
session_start();

require('config.php');
require('DbConnection.php');

$usersStatement = $pdo->prepare('SELECT * FROM Utilisateur');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

$postData = $_POST;

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($postData['email']);
    $password = $postData['password'];

    // Validation des données
    if (empty($email) || empty($password)) {
        die("Tous les champs sont obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide.");
    }

    foreach ($users as $user) {
        if (
            $user['email'] === $postData['email'] &&
            $user['password'] === $postData['password']
        ) {
            $_SESSION['LOGGED_USER'] = [
                'email' => $user['email'],
                'user_id' => $user['id'],
            ];
            header('Location: index.php');
             exit;
        }
    }

    if (!isset($_SESSION['LOGGED_USER'])) {
        $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $postData['email'],
            strip_tags($postData['password'])
        );
    }
    
}
?>
