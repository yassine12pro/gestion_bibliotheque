<?php

require 'header.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
} else {
    echo "ID invalide.";
    exit;
}
?>
 <main>
    <div class='container mt-5'>
    <h1 class='my-4'>Ajouter un Commentaire</h1>
    <form action="traitement_comment.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <textarea name="comment" rows="5" cols="100" placeholder="Écrivez votre commentaire ici..." required></textarea><br>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
    </div>
</main>


<?php
 
require 'footer.php';
?>