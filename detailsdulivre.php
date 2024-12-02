<?php require 'header.php'; 
session_start();
?>

<main>

<?php 
require 'DbConnection.php';

$id = $_GET['id'];

if ($pdo) {
    $req = "SELECT Livre.id id, Livre.titre, Livre.auteur_id, Livre.disponible dispo, Livre.genre_id AS genre
                   ,Auteur.nom AS auteur_nom  , Genre.nom nomg , Genre.description description
            FROM Livre
            JOIN Auteur ON Livre.auteur_id = Auteur.id
            join Genre on Livre.genre_id=Genre.id
            WHERE Livre.id = :id";

    $stmt = $pdo->prepare($req);
    $stmt->execute(['id' => $id]);

    if ($stmt->rowCount() == 0) {
        echo "<p class='text-danger'>Aucun résultat trouvé.</p>";
    } else {
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC); ?>
        
        <div class="container mt-5">
            <h1 class="text-primary mb-4">Détails du Livre</h1>
            <div class="card shadow-lg col-md-12 mx-auto">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="card-title text-primary-emphasis">Titre</h5>
                        <p class="card-text"><?php echo ($ligne['titre']); ?></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="card-title text-primary-emphasis">Auteur</h5>
                        <p class="card-text"><?php echo ($ligne['auteur_nom']); ?></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="card-title text-primary-emphasis">Genre</h5>
                        <p class="card-text"><?php echo ($ligne['nomg']); ?></p>
                    </div>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title text-primary-emphasis">Description</h5>
                            <p class="card-text"><?php 
                            
                            if(isset($ligne['description'])){
                                echo ($ligne['description']);
                            }else{
                                echo "-- -- -- -- -- -- -- -- ";
                            }
                            
                           
                            
                            ?></p>
                        </div>

                        <?php
                            if(isset($_SESSION['LOGGED_USER'])){  
                                if($ligne['dispo'] == 1){    ?>
                                  <div>
                                  <a href="emp.php?id=<?php echo $ligne['id']; ?>" class="btn btn-success ms-auto mx-5 p-3">Emprunter</a> 
                                  <a href="ajoutcomment.php?id=<?php echo $ligne['id']; ?>" class="btn btn-danger ms-auto mx-5 p-3">Ajouter Un Commentaire</a> 
                                  </div>

                                    <?php      } else {  ?>

                   <div>
                   <button type="submit" class="btn btn-primary ms-auto mx-5 p-3" disabled>Emprunter</button>
                    <a href="ajoutcomment.php?id=<?php echo $ligne['id']; ?>" class="btn btn-danger ms-auto mx-5 p-3">Ajouter Un Commentaire</a> 

                   </div>
                 <?php 
                                    } 
                       
                     }
                            
                        
                        ?>



                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
?>


<?php  

$id = intval($_GET['id']); 

$sql = "SELECT * FROM commentaires WHERE livre_id = :id ORDER BY date_creation DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

if ($stmt->rowCount() > 0) {
    echo "<h1 class='mt-4 container text-primary'>les critiques des utilisateurs :</h1>";

    while ($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='mt-5 p-3 border border-secondary rounded container'>";
        echo "<p><strong>Commentaire :</strong> " . ($comment['commentaire']) . "</p>";
        echo "<small class='text-muted'>Posté le : " . ($comment['date_creation']) . "</small>";
        echo "</div>";
    }
} 

?>



</main>

<?php require 'footer.php'; ?>
