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
        <tr>
          <td>Bla</td>
          <td>Bla Bla</td>
          <td>Blllaa</td>
          <td>123</td>
          <td>
            <button type="button" class="btn btn-warning btn-sm">Modifier</button>
            <button type="button" class="btn btn-danger btn-sm">Supprimer</button>
          </td>
        </tr>
        <tr>
          <td>Exemple</td>
          <td>Auteur 2</td>
          <td>Fiction</td>
          <td>456</td>
          <td>
            <button type="button" class="btn btn-warning btn-sm">Modifier</button>
            <button type="button" class="btn btn-danger btn-sm">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="container mt-5 col-4" >
        <div class="d-flex flex-column gap-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">Ajouter un Livre </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recherchepartitre">Rechercher Par Titre</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rechercheparauteur">Rechercher Par Auteur</button>
        </div>
  </div>


  <!-- Modal1 -->
  <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Ajouter un Livre</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Titre</label>
              <input type="text" class="form-control" id="bookTitle" placeholder="Entrez le titre du livre" required>
            </div>
            <div class="mb-3">
              <label for="bookAuthor" class="form-label">Auteur</label>
              <input type="text" class="form-control" id="bookAuthor" placeholder="Entrez le nom de l'auteur" required>
            </div>
            <div class="mb-3">
              <label for="bookGenre" class="form-label">Genre</label>
              <input type="text" class="form-control" id="bookGenre" placeholder="Entrez le genre" required>
            </div>
            <div class="mb-3">
              <label for="bookISBN" class="form-label">ISBN</label>
              <input type="text" class="form-control" id="bookISBN" placeholder="Entrez le numéro ISBN" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary">Ajouter</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal2 -->
  <div class="modal fade" id="recherchepartitre" tabindex="-1" aria-labelledby="recherchepartitremodal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Rechercher Par Titre</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Titre</label>
              <input type="text" class="form-control" id="bookTitle" placeholder="Entrez le titre du livre" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary">rechercher</button>
        </div>
      </div>
    </div>
  </div>


   <!-- Modal3 -->
   <div class="modal fade" id="rechercheparauteur" tabindex="-1" aria-labelledby="rechercheparauteurmodal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addBookModalLabel">Rechercher Par Auteur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="bookTitle" class="form-label">Auteur</label>
              <input type="text" class="form-control" id="bookTitle" placeholder="Entrez l’auteur du livre" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-primary">rechercher</button>
        </div>
      </div>
    </div>
  </div>

</main>



<?php require 'footer.php'; ?>

