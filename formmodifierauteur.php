<?php 
require 'header.php'; 
require 'DbConnection.php'; 




// Récupérer les données du livre à modifier
$id = intval($_GET['id']);

$livreQuery = "SELECT nom , biographie ,date_de_naissance from Auteur WHERE id = :id";
$livreStmt = $pdo->prepare($livreQuery);
$livreStmt->execute(['id' => $id]);
$livre = $livreStmt->fetch(PDO::FETCH_ASSOC);
?>

<main>
<div class="container">
    <h1 class="my-3">Modifier Ce Auteur :</h1>

    <form action="modifierauteur.php" method="POST"> 
             <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

            <div class="mb-3">
              <label for="bookTitle" class="form-label">Nom</label>
              <input type="text" class="form-control" id="bookTitle" value="<?= htmlspecialchars($livre['nom']); ?>" name="nom" required>
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Biographie</label>
              <input type="text" class="form-control" id="bookAuthor" value="<?= htmlspecialchars($livre['biographie']); ?>" name="bio"  required>
            </div>
            <div class="mb-3">
              <label for="bookGenre" class="form-label">Date de Naissance</label>
              <input type="date" class="form-control" id="bookGenre" name="dn" value="<?= htmlspecialchars($livre['date_de_naissance']); ?>" required>
            </div>
            <div class="modal-footer">
            <div >
                <a href="gestionauteurs.php" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Modifier</button>
             </div>
        </div>
           
          </form>
</div>
</main>


<?php 


require 'footer.php'; 
?>
