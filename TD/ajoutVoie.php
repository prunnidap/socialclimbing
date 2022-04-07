<!-- Page d'ajout, de modification et de suppression d'un post d'une voie d'escalade -->

<?php
include("Functions.php");
include("fonctionsClassement.php");
ConnectDatabase();

$fill = check_fill();
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
    // Recupere des donnees de differents formulaires
    if(isset($_GET['table']))
        $table = $_GET['table'];
    else if(isset($_POST['table']))
        $table = $_POST['table'];
    if(isset($_POST['id']))
        $id = $_POST['id'];
    if(isset($_POST['idGrimpeur']))
        $idGrimpeur = $_POST['idGrimpeur'];
    $pseudo = $_COOKIE['pseudo'];
    $query = "";
    // Si une voie est supprimée
    if($fill[3] == 2)
    {
        $query = "DELETE FROM $table WHERE id = '$id'";
        global $conn;
        $result = $conn->query($query);
        // On actualise le classement
        majSuppression($pseudo, $fill[1], $idGrimpeur, $table);
        // Redirection avec javascript
        echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
    }
    // Si une voie est ajoutée
    else if($fill[3] == 1)
    {
        // On recupere l'heure
        date_default_timezone_set('Europe/Paris');
        $date = date('Y-m-d');
        global $conn;
        // Si on veut modifier, on supprime d'abord le post et on le recree, modifie
        if($_POST['Modifier']) {
            $query = "DELETE FROM $table WHERE id = '$id'";
            $result = $conn->query($query);
            // On actualise aussi le classement
            majSuppression($pseudo, $fill[1], $idGrimpeur, $table);
        }
        // La query sql n'est pas la meme selon le type de voie d'escalade
        switch ($table) {
        case "bloc":case "voie":
            $query = "INSERT INTO $table VALUES (NULL, '$pseudo', '$idGrimpeur', '$fill[0]', '$fill[1]', '$fill[2]', '$date')";
            break;
        case "vsup":
            $query = "INSERT INTO $table VALUES (NULL, '$pseudo', '$idGrimpeur', '$fill[1]', '$fill[2]', '$date')";
            break;
        }
        $result = $conn->query($query);
        //Actualise le classement
        majAjout($pseudo, $fill[1], $idGrimpeur, $table);
        // Redirection
        echo "<script type='text/javascript'>document.location.replace('profil.php');</script>";
    }
    // Si on n'a pas encore rempli le formulaire d'ajout/modification
    else
    {
        $modifier = 0;
        $nom = "";
        $id = "";
        $cotation = "";
        $date = "";
        $description = "";
        if(isset($_POST['Modifier'])) {
            echo'<h3>Modification : </h3>';
            $modifier = 1;
            $nom = $_POST['nom'];
            $cotation = $_POST['cotation'];
            $date = $_POST['date'];
            $description = $_POST['description'];
            $id = $_POST['id'];
        }
        else
            echo'<h3>Ajout : </h3>';
        // Ajoute le bon formulaire
        switch ($table) {
        case "voie":
            include("nouvelleVoieForm.php");
            break;
        case "bloc":
            include("nouveauBlocForm.php");
            break;
        case "vsup":
            include("nouveauVSupForm.php");
            break;
        }
    }

    DisconnectDatabase();
    ?>
</div>
</body>
</html> 