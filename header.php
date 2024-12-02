<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Bibliothèque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #343a40;
            color: white;
        }
        .logo {
        width: 130px; /* Set a width */
        height: 120px; /* Set a height */
        border-radius: 50%;
        border: 1px gray solid ;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="assets/istockphoto-1270155083-612x612.jpg" alt="Logo" class="img-fluid logo" style="height: 80px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Accueil</a>
                </li>

                <?php  
                    require 'DbConnection.php';
                    $id=$_SESSION['LOGGED_USER']['user_id'];

                 $stmt = $pdo->prepare("SELECT role FROM Utilisateur where id=:id");
                 $stmt->execute(['id' => $id]);
                 $result = $stmt->fetch(PDO::FETCH_ASSOC);

                 if ($result && $result['role'] === 'admin') {

                ?>



                <li class="nav-item">
                    <a class="nav-link" href="gestionlivre.php">Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestionauteurs.php">Auteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gestiongenres.php">Genres</a>
                </li>

                    
                <?php   } ?>



                <!-- Affichage en fonction de l'état de connexion -->
                <?php if (isset($_SESSION['LOGGED_USER'])): ?>
                    <!-- Si l'utilisateur est connecté -->
                    
                    <li class="nav-item">
                        <a class="nav-link" href="moncompte.php">Mon Compte</a>
                    </li>
                    <li class="nav-item">
                       <a class="btn btn-danger nav-link text-white" href="logout.php">LogOut</a>
                   </li>
                <?php else: ?>
                    <!-- Si l'utilisateur n'est pas connecté -->
                    <li class="nav-item mx-2">
                        <a class="btn btn-primary nav-link text-white" href="login.php">LogIn</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="btn btn-primary nav-link text-white" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
