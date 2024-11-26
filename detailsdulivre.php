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
                        <p class="card-text"><?php echo htmlspecialchars($ligne['titre']); ?></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="card-title text-primary-emphasis">Auteur</h5>
                        <p class="card-text"><?php echo htmlspecialchars($ligne['auteur_nom']); ?></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="card-title text-primary-emphasis">Genre</h5>
                        <p class="card-text"><?php echo htmlspecialchars($ligne['nomg']); ?></p>
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
                                    <a href="emp.php?id=<?php echo $ligne['id']; ?>" class="btn btn-primary ms-auto mx-5 p-3">Emprunter</a> 
 
                                    <?php      } else {  ?>

                    <button type="submit" class="btn btn-primary ms-auto mx-5 p-3" disabled>Emprunter</button>
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

<div class="container mt-5 ">
    <h3>Critiques d'utilisateurs :</h3>
    <ul>
        <li>Bla bla</li>
    </ul>
</div>

</main>

<?php require 'footer.php'; ?>
