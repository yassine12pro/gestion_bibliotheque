

    
    <?php require 'header.php'; ?>

    <main>

        <div class="container mt-5">
            <form action="recherche.php" method="GET" class="d-flex justify-content-center">
                <div class="input-group w-50">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Entrez le titre ou l'auteur du livre" 
                        name="query"
                        required
                    >
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
        
        
        <div class="container mt-5">
        <h2 class="text-center mb-4">Nos Livres</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Carte 1 -->
            <div class="col">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Image du livre">
                    <div class="card-body">
                        <h5 class="card-title">Titre du Livre</h5>
                        <p class="card-text">Auteur: Nom de l'Auteur</p>
                        <a href="detailsdulivre.php" class="btn btn-primary">Voir plus</a>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

      




    </main>

    

    <?php require 'footer.php'; ?>
    
