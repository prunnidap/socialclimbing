<!-- Page de creation de compte -->

<?php
include("Functions.php");
ConnectDatabase();
$newAccountStatus = CheckNewAccountForm();
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <?php
    include("head.php");
    ?>
</head>

<body>
<div id="MainContainer">
    <?php
    // Si la creation a marche, on est redirige vers l'acceuil
    if($newAccountStatus[1]){
        echo "<script type='text/javascript'>document.location.replace('index.php?creation=true');</script>";
    }
    include("header_topnav.php");
    ?>
    <h1>Création d'un nouveau compte</h1>
    <?php
    // Si erreur, on n'est pas redirige
    if ($newAccountStatus[0]){
        echo '<h3 class="errorMessage">'.$newAccountStatus[2].'</h3>';
        include("createForm.php");
    }
    else
    {
        echo '<h3>Création de compte :<h3>';
        include("createForm.php");
    }
    // Pour retourner a l'acceuil
    ?>
    <p><a href="./index.php" class="backlink"><< Revenir à l'acceuil</a><br><br></p>
    <?php
    DisconnectDatabase();
?>
</div>
</body>
</html> 