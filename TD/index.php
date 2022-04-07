<!-- Page d'acceuil du site, permet de se connecter, creer un compte ou regarde les 10 dernieres voies d'escalade reussies -->
<?php
include("Functions.php");
// Connexion a la base de données
ConnectDatabase();
// Verification du login
$loginStatus = check_login();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <?php
    // Si on est connecte
    if($loginStatus[0] AND !isset($_GET['deconnexion'])) {
        echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
    }
    include("head.php");
    ?>
</head>

<body>
<div id="MainContainer">
    <?php
    // Barre de navigation
    include("header_topnav.php");
    // Si on veut se deconnecter
    if(isset($_GET['deconnexion'])) {
        if ($_GET['deconnexion'] == true) {
            // Supprime les cookies
            unset($_COOKIE['pseudo']);
            unset($_COOKIE['password']);
            setcookie('pseudo', NULL, -1, '/', '', false, true);
            setcookie('password', NULL, -1, '/', '', false, true);
            echo '<p>Vous vous êtes déconnecté.</p>';
        }
    }
    // Si un nouveau compte a ete cree
    if(isset($_GET['creation']) AND $_GET['creation'] == true)
    {
        echo '<h3 class="successMessage">Nouveau compte créé avec succès!</h3>';
    }
    // Formulaire de connexion
    echo '<h3>Connexion :<h3>';
    include("loginForm.php");
    echo '<a href="nouveauCompte.php">Créer un compte </a>';
    // Affiche 10 voies d'escalade reussies recemment
    afficherRandom();
    // Se deconnecte de la base de donnees
    DisconnectDatabase();
    ?>
</div>
</body>
</html> 