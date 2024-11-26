<?php


require 'DbConnection.php';
$id=$_GET['id'];

$req="delete from Livre where id=$id";
try{
$res=$pdo->exec($req);
if($res==0){
    echo "problem de suppression";
}else{
    header("location:gestionlivre.php");
}
}
catch(PDOException $e){
    echo $e->getMessage();
}







?>