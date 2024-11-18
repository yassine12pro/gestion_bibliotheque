<?php

require('config.php');
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $pdo = new PDO($dsn, $user, $password);

    //if ($pdo) {
       // echo "Connected to the $db database successfully!";
    //}

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Attention : une exception s'est produite<br>";
    echo $e->getMessage();
}
