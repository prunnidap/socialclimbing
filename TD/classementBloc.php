<!-- Classement des grimpeurs dans la discipline 'bloc' -->

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
    include("fonctionsClassement.php");
    // Recupere le classement dans un tableau
    $classement = classement("bloc");
    echo'<h1>Classement Bloc</h1>';
    $i = 0;
    // affiche le contenu du tableau
    foreach($classement as $index => $row) {
        $i++;
        echo'<p>'.$i.' : </p>';
        $id = $row['id'];
        $points = $row['pointsBloc'];
        $grimpeur = $row['grimpeur'];
        // Lien pour consulter le profil du grimpeur
        ?><p><a href="profil.php?id=<?php echo $id?>"><?php echo $grimpeur?></a> : <?php echo $points?> points</p>
        <?php
    }
    ?>

</div>
</body>
</html> 