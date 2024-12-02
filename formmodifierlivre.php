<?php 
require 'header.php'; 
require 'DbConnection.php'; 


// Récupération de tous les auteurs
$auteursQuery = "SELECT id, nom FROM Auteur";
$auteursStmt = $pdo->query($auteursQuery);
$auteurs = $auteursStmt->fetchAll(PDO::FETCH_ASSOC);

// Récupération de tous les genres
$genresQuery = "SELECT id, nom FROM Genre";
$genresStmt = $pdo->query($genresQuery);
$genres = $genresStmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les données du livre à modifier
$id = intval($_GET['id']);
$livreQuery = "SELECT Livre.titre, Livre.ISBN, Livre.auteur_id, Livre.genre_id FROM Livre WHERE id = :id";
$livreStmt = $pdo->prepare($livreQuery);
$livreStmt->execute(['id' => $id]);
$livre = $livreStmt->fetch(PDO::FETCH_ASSOC);
?>
<main>
<div class="container">
    <h1 class="my-3">Modifier Ce Livre :</h1>

<form action="modifierlivre.php" method="POST">
    <!-- Champ caché pour envoyer l'ID -->
    <input type="hidden" name="id" value="<?= ($id); ?>">

    <!-- Champ Titre -->
    <div class="mb-3">
        <label for="bookTitle" class="form-label">Titre</label>
        <input type="text" class="form-control" value="<?= ($livre['titre']); ?>" 
               name="titre" id="bookTitle"  required>
    </div>

    <!-- Liste déroulante pour Auteur -->
    <div class="mb-3">
        <label for="bookAuthor" class="form-label">Auteur</label>
        <select class="form-control" name="auteur_id" id="bookAuthor" required>
            <?php foreach ($auteurs as $auteur): ?>
                <option value="<?= $auteur['id']; ?>" 
                    <?= $auteur['id'] == $livre['auteur_id'] ? 'selected' : ''; ?>>
                    <?= ($auteur['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Liste déroulante pour Genre -->
    <div class="mb-3">
        <label for="bookGenre" class="form-label">Genre</label>
        <select class="form-control" name="genre_id" id="bookGenre" required>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= $genre['id']; ?>" 
                    <?= $genre['id'] == $livre['genre_id'] ? 'selected' : ''; ?>>
                    <?= ($genre['nom']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Champ ISBN -->
    <div class="mb-3">
        <label for="bookISBN" class="form-label">ISBN</label>
        <input type="text" class="form-control" value="<?= ($livre['ISBN']); ?>" 
               name="isbn" id="bookISBN"  required>
    </div>

    <!-- Boutons -->
    <div class="modal-footer">
            <div >
                <a href="gestionlivre.php" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Modifier</button>
           </div>
    </div>
</form>
</div>
</main>


<?php 


require 'footer.php'; 
?>
