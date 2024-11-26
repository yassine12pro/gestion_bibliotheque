<?php require 'header.php'; ?>

<main>

    <h1 class="mt-5 mx-5">Gestion de Livres :</h1>

    <table class="container table table-bordered table-striped text-center mt-5 mb-5">
        <thead class="table-primary">
            <tr>
                <th class="col-2">Titre</th>
                <th class="col-2">Auteur</th>
                <th class="col-2">Genre</th>
                <th class="col-2">ISBN</th>
                <th class="col-4">Action</th>
            </tr>
        </thead>
        <tbody>

<?php
require 'DbConnection.php';

// Si une recherche par titre ou auteur a été effectuée, on applique la recherche
if ($pdo) {
    if (isset($_GET['query']) && !empty($_GET['query'])) {
        // Recherche par titre
        $query = "%" . $_GET['query'] . "%"; 
        $req = "SELECT Livre.id, Livre.titre, Livre.auteur_id, Livre.ISBN, Auteur.nom AS auteur_nom, Genre.nom AS nomg
                FROM Livre
                JOIN Auteur ON Livre.auteur_id = Auteur.id
                JOIN Genre ON Livre.genre_id = Genre.id
                WHERE Livre.titre LIKE :query";

        $stmt = $pdo->prepare($req);
        $stmt->execute(['query' => $query]);
    } elseif (isset($_GET['auteur_query']) && !empty($_GET['auteur_query'])) {
        // Recherche par auteur
        $auteur_query = "%" . $_GET['auteur_query'] . "%"; 
        $req = "SELECT Livre.id, Livre.titre, Livre.auteur_id, Livre.ISBN, Auteur.nom AS auteur_nom, Genre.nom AS nomg
                FROM Livre
                JOIN Auteur ON Livre.auteur_id = Auteur.id
                JOIN Genre ON Livre.genre_id = Genre.id
                WHERE Auteur.nom LIKE :auteur_query";

        $stmt = $pdo->prepare($req);
        $stmt->execute(['auteur_query' => $auteur_query]);
    } else {
        // Si pas de recherche, on affiche tous les livres
        $req = "SELECT Livre.id, Livre.titre, Livre.auteur_id, Livre.ISBN, Auteur.nom AS auteur_nom, Genre.nom AS nomg
                FROM Livre
                JOIN Auteur ON Livre.auteur_id = Auteur.id
                JOIN Genre ON Livre.genre_id = Genre.id";
        $stmt = $pdo->query($req);
    }

    // Si des livres sont trouvés, on les affiche
    if ($stmt->rowCount() > 0) {
        while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo ($ligne['titre']); ?></td>
                <td><?php echo ($ligne['auteur_nom']); ?></td>
                <td><?php echo ($ligne['nomg']); ?></td>
                <td><?php echo htmlspecialchars($ligne['ISBN']); ?></td>
                <td>
                <a href="modifierlivre.php?id=<?php echo $ligne['id']; ?>" class="btn btn-warning btn-sm" >Modifier</a>

                    <a href="supplivre.php?id=<?php echo $ligne['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<p class='text-center text-danger'>Aucun livre trouvé pour votre recherche.</p>";
    }
}
?>

        </tbody>
    </table>

    <div class="container mt-5 col-4">
        <div class="d-flex flex-column gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">Ajouter un Livre</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recherchepartitre">Rechercher Par Titre</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rechercheparauteur">Rechercher Par Auteur</button>
        </div>
    </div>

    <!-- Modal1 - Ajouter un Livre -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Ajouter un Livre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="ajoutlivre.php" method="POST">
                        <div class="mb-3">
                            <label for="bookTitle" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" id="bookTitle" placeholder="Entrez le titre du livre" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookAuthor" class="form-label">Auteur</label>
                            <input type="text" class="form-control" name="auteur" id="bookAuthor" placeholder="Entrez le nom de l'auteur" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookGenre" class="form-label">Genre</label>
                            <input type="text" class="form-control" name="genre" id="bookGenre" placeholder="Entrez le genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookISBN" class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="bookISBN" placeholder="Entrez le numéro ISBN" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal2 - Rechercher Par Titre -->
    <div class="modal fade" id="recherchepartitre" tabindex="-1" aria-labelledby="recherchepartitremodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Rechercher Par Titre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="gestionlivre.php" method="GET">
                        <div class="mb-3">
                            <label for="bookTitle" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="bookTitle" placeholder="Entrez le titre du livre" name="query" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal3 - Rechercher Par Auteur -->
    <div class="modal fade" id="rechercheparauteur" tabindex="-1" aria-labelledby="rechercheparauteurmodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Rechercher Par Auteur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="gestionlivre.php" method="GET">
                        <div class="mb-3">
                            <label for="bookAuthor" class="form-label">Auteur</label>
                            <input type="text" class="form-control" id="bookAuthor" placeholder="Entrez l’auteur du livre" name="auteur_query" value="<?php echo isset($_GET['auteur_query']) ? $_GET['auteur_query'] : ''; ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal4 - modifier un Livre -->
    <div class="modal fade" id="modbook" tabindex="-1" aria-labelledby="modbook" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel">Modifier un Livre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="modifierlivre.php" method="POST">
                        <div class="mb-3">
                            <label for="bookTitle" class="form-label">Titre</label>
                            <input type="text" class="form-control" name="titre" id="bookTitle" placeholder="Entrez le titre du livre" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookAuthor" class="form-label">Auteur</label>
                            <input type="text" class="form-control" name="auteur" id="bookAuthor" placeholder="Entrez le nom de l'auteur" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookGenre" class="form-label">Genre</label>
                            <input type="text" class="form-control" name="genre" id="bookGenre" placeholder="Entrez le genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookISBN" class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="bookISBN" placeholder="Entrez le numéro ISBN" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <a href="modifierlivre.php?id=<?php echo $ligne['id']; ?>"  class="btn btn-primary">Modifier</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require 'footer.php'; ?>
