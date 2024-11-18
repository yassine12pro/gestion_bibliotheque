<?php
session_start();

?>

<?php require 'header.php'; ?>
<main>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if (isset($_SESSION['LOGGED_USER'])): ?>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Mon Compte</h3>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Informations utilisateur</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Email :</strong> <?php echo htmlspecialchars($_SESSION['LOGGED_USER']['email']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>ID utilisateur :</strong> <?php echo htmlspecialchars($_SESSION['LOGGED_USER']['user_id']); ?>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">
                    Vous n'êtes pas connecté. <a href="login.php" class="alert-link">Connectez-vous ici</a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</main>
<?php require 'footer.php'; ?>







