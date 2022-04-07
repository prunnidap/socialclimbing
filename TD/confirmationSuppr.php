<!-- Page de confirmation d'effacement, pour eviter les etourderies -->
<?php
include("Functions.php");
ConnectDatabase();
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
    include("header_topnav.php");

    // Recupere les infos sur le post, venant du bouton suppression
    $nom = $_POST["nom"];
    $table = $_POST["table"];
    $id = $_POST["id"];
    $cotation = $_POST["cotation"];
    $idGrimpeur = $_POST["idGrimpeur"];

    // Difference d'ecriture en fonction du type de voie d'escalade
    if($table == "voie")
        echo'<h3>Etes-vous sûr de vouloir supprimer la voie "'.$nom.'" ?</h3>';
    else
        echo'<h3>Etes-vous sûr de vouloir supprimer le bloc "'.$nom.'" ?</h3>';
    ?>
    <!-- Formulaire pour confirmer l'effacement, il contient dans les input caches les informations necessaires sur le post -->
    <form method="post" action="ajoutVoie.php">
        <p>
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="nom" value="<?php echo $nom;?>">
            <input type="hidden" name="table" value="<?php echo $table;?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="idGrimpeur" value="<?php echo $idGrimpeur;?>">
            <input type="hidden" name="cotation" value="<?php echo $cotation;?>">
            <input type="submit" name="Supprimer" value="Supprimer" />
        </p>
    </form>
    <form method="post" action="profil.php">
        <p>
            <input type="submit" name="Annuler" value="Annuler" />
        </p>
    </form>
    <?php
    DisconnectDatabase();
    ?>
</div>
</body>
</html> 