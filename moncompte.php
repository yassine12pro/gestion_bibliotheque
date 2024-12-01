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
                                <strong>Email :</strong> <?php echo ($_SESSION['LOGGED_USER']['email']); ?>
                            </li>
                            <li class="list-group-item">
                                <strong>ID utilisateur :</strong> <?php echo ($_SESSION['LOGGED_USER']['user_id']); ?>
                            </li>

                               <?php

                                $userId = $_SESSION['LOGGED_USER']['user_id'];

                                try {
                                    // Récupérer les emprunts de l'utilisateur
                                    $stmt = $pdo->prepare("
                                        SELECT e.date_emprunt, l.titre , e.livre_id
                                        FROM Emprunt e 
                                        JOIN Livre l ON e.livre_id = l.id 
                                        WHERE e.utilisateur_id = :user_id
                                    ");
                                    $stmt->execute(['user_id' => $userId]);
                                    $emprunts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if ($emprunts) {
                                        echo "<h2 class='mt-4'>Mes Emprunts</h2>";
                                        echo "<ul>";
                                        foreach ($emprunts as $emprunt) {
                                            echo "<li class='my-3 d-flex justify-content-between'>";
                                            echo "<strong>{$emprunt['titre']}</strong>  Emprunté le : {$emprunt['date_emprunt']}";
                                            echo " <form method='POST' action='retourner_livre.php' style='display:inline;'>
                                                      <input type='hidden' name='livre_id' value='{$emprunt['livre_id']}'>
                                                      <button type='submit' class='btn btn-warning btn-sm'>Retourner</button>
                                                   </form>";
                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "Aucun emprunt enregistré.";
                                    }
                                    
                                } catch (PDOException $e) {
                                    echo "Erreur : " . $e->getMessage();
                                }
                                                            
                            
                            
                            
                            
                            
                            ?>

                          
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="logout.php" class="btn btn-danger">LogOut</a>
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







