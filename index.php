<?php 
require 'header.php'; 
?>

<main>

    <!-- Formulaire de recherche -->
    <div class="container mt-5">
        <form action="index.php" method="GET" class="d-flex justify-content-center">
            <div class="input-group w-50">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Entrez le titre ou l'auteur du livre" 
                    name="query"
                    value="<?php echo isset($_GET['query']) ? ($_GET['query']) : ''; ?>"
                    required
                >
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>
    </div>

    <!-- Affichage des résultats -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Nos Livres</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php 
        require 'DbConnection.php';

        if ($pdo) {
            // Si une recherche a été effectuée, on applique la recherche
            if (isset($_GET['query']) && !empty($_GET['query'])) {
                $query = "%" . $_GET['query'] . "%"; // Recherche avec des wildcards
                $req = "SELECT Livre.id, Livre.titre, Livre.auteur_id, Livre.disponible dispo, Auteur.nom AS auteur_nom 
                        FROM Livre 
                        JOIN Auteur ON Livre.auteur_id = Auteur.id 
                        WHERE Livre.titre LIKE :query OR Auteur.nom LIKE :query";
                
                $stmt = $pdo->prepare($req);
                $stmt->execute(['query' => $query]);
            } else {
                // Si pas de recherche, on affiche tous les livres
                $req = "SELECT Livre.id, Livre.titre, Livre.auteur_id, Livre.disponible dispo, Auteur.nom AS auteur_nom 
                        FROM Livre 
                        JOIN Auteur ON Livre.auteur_id = Auteur.id";
                
                $stmt = $pdo->query($req);
            }

            // Si des livres sont trouvés, on les affiche
            if ($stmt->rowCount() > 0) {
                while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <!-- Carte de livre -->
                    <div class="col">
                        <div class="card">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image du livre">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($ligne['titre']); ?></h5>
                                <p class="card-text">Auteur: <?php echo htmlspecialchars($ligne['auteur_nom']); ?></p>
                              <div class="d-flex align-items-center justify-content-between">
                                <a href="detailsdulivre.php?id=<?php echo $ligne['id']; ?>" class="btn btn-primary me-3">
                                    Voir plus
                                </a>
                                <?php if ($ligne['dispo'] == 1): ?>
                                    <span class="text-success">
                                    ✔️
                                    </span>
                                <?php else: ?>
                                    <span class="text-danger">
                                    ❌
                                    </span>
                                <?php endif; ?>
                            </div>


                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center text-danger'>Aucun livre trouvé pour votre recherche.</p>";
            }
        }
        ?>
        </div>
    </div>

</main>

<?php require 'footer.php'; ?>
