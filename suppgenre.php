<?php


require 'DbConnection.php';
$id=$_GET['id'];

$req="delete from Genre where id=$id";
try{
$res=$pdo->exec($req);
if($res==0){
    echo "problem de suppression";
}else{
    header("location:gestiongenres.php");
}
}
catch(PDOException $e){
    echo $e->getMessage();
}







?>