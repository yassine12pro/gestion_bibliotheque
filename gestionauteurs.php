<?php require 'header.php'; ?>

<main>

<h1 class="mt-5 mx-5">Gestion de Auteurs :</h1>
<table class="container table table-bordered table-striped text-center mt-5 mb-5">
      <thead class="table-primary">
        <tr>
          <th class="col-2">Nom</th>
          <th class="col-2">Biographie</th>
          <th class="col-4">Action</th>
        </tr>
      </thead>
      <tbody>
      
      <?php 
            
            require 'DbConnection.php';

            if($pdo){
              $req = "SELECT *
       FROM Auteur";
       
       
       $res=$pdo->query($req);
                if ($res->rowCount()== 0){
                    echo "resultat vide";
                }else {
                    while($ligne=$res->fetch(PDO::FETCH_ASSOC)){    
                        ?>

              <tr>
                <td><?php echo ($ligne['nom']); ?></td>
                <td><?php if($ligne['biographie'] == null)  {
                  
                  echo "---";
                
                }else {
                  echo ($ligne['biographie']); 
                }
                
                
                ?></td>
            
                <td>
                  <a href="formmodifierauteur.php?id=<?php echo $ligne['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                  <a href="suppauteur.php?id=<?php echo $ligne['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
              </tr>


            <?php
                    }
                }
                
            }
            
            
            ?>


      </tbody>
    </table>

    <div class="container mt-5 col-4" >
        <div class="d-flex flex-column gap-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addauthorModal">Ajouter un Auteur </button>
       
        </div>
  </div>


  <!-- Modal1 -->
  <div class="modal fade" id="addauthorModal" tabindex="-1" aria-labelledby="addauthorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Ajouter un Auteur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="ajoutauteur.php" method="POST"> 
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Nom</label>
              <input type="text" class="form-control" id="bookTitle" name="nom" placeholder="Entrez le nom de l'auteur" required>
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Biographie</label>
              <input type="text" class="form-control" id="bookAuthor" name="bio" placeholder="Entrez la biographie de l'auteur" required>
            </div>
            <div class="mb-3">
              <label for="bookGenre" class="form-label">Date de Naissance</label>
              <input type="date" class="form-control" id="bookGenre" name="dn" placeholder="Entrez la date de naissance de l'auteur " required>
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


 
  

</main>



<?php require 'footer.php'; ?>