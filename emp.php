<?php
require 'DbConnection.php';
session_start();

$id=$_GET['id'];

try {

    

   
        
        $res = $pdo->exec("update Livre set disponible = 0 where id= $id");


   
        if($res == 0){
            echo "problem de modification";
        }else {
            header("location:index.php");

        } 
    







} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
