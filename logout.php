<?php

session_start(); // Démarrez la session si ce n'est pas déjà fait


// Détruire la session
session_unset();
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil
header('Location: login.php');
        exit;
        
    ?>