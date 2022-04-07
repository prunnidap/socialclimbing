<!-- Classement des grimpeurs dans la discipline 'voie'
Exactement pareil que classementBloc.php, la seule difference est que ce n'est pas la meme table de la base de donnees a consulter
-->
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
    $classement = classement("voie");
    echo'<h1>Classement Voie</h1>';
    $i = 0;
    foreach($classement as $index => $row) {
        $i++;
        echo'<p>'.$i.' : </p>';
        $id = $row['id'];
        $points = $row['pointsVoie'];
        $grimpeur = $row['grimpeur'];

        ?><p><a href="profil.php?id=<?php echo $id?>"><?php echo $grimpeur?></a> : <?php echo $points?> points</p>
        <?php
    }
    ?>

</div>
</body>
</html> 