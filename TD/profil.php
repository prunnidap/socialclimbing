<!-- Page de consultation de profil/blog -->

<?php
    include("Functions.php");
    include("fonctionsClassement.php");
    ConnectDatabase();
    $loginStatus = check_login();
    if(isset($_GET['id']))
        $isMyBlog = isMyBlog($_GET['id']);
    else
        $isMyBlog = $loginStatus[0];
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
    echo '<p></p><a href="index.php?deconnexion=true">Se déconnecter </a>';
    // Recupere des donnes
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = $loginStatus[2];
    // Si c'est le blog de l'utilisateur, on connait deja son nom
    if($isMyBlog)
        $grimpeur = $loginStatus[3];
    // Sinon, on cherche son nom grace a son id
    else
    {
        global $conn;
        $query = "SELECT * FROM login WHERE id = '".$id."'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $grimpeur = $row["logname"];

    }
    // On cherche les infos sur le grimpeur dans la table classement
    $query = "SELECT * FROM classement WHERE id = '".$id."'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    echo'<h1>'. $grimpeur .'</h1>';
    echo'<h3>Points totaux : '. $row["points"] .'</h3>';
    echo'<h3>Points Voie : '. $row["pointsVoie"] .'</h3>';
    $voiesParCotation = nbVoiesParCotation("voie", $id);
    //$voiesParCotation = triParCotation($voiesParCotation, "voie");
    foreach($voiesParCotation as $cotation => $nombre)
    {
        echo'<p>'. chiffreEnLettres($nombre) .' '. $cotation .'</p>';
    }

    echo'<p>Nombre de voies enchaînées : '. $row["nbVoies"] .'</p>';
    echo'<p>Plus haute cotation réussie : '. $row["niveauVoie"] .'</p>';
    echo'<h3>Points Bloc : '. $row["pointsBloc"] .'</h3>';
    echo'<p>Nombre de blocs réussis : '. $row["nbBlocs"] .'</p>';
    echo'<p>Plus haute cotation réussie : '. $row["niveauBloc"] .'</p>';
    echo'<h3>Points VSup : '. $row["pointsVSup"] .'</h3>';
    echo'<p>Nombre de blocs VSup réussis : '. $row["nbVSup"] .'</p>';
    echo'<p>Plus haute cotation réussie : '. $row["niveauVSup"] .'</p>';


    echo '<h2>Voies récemment enchaînées: </h2>';
    // Si c'est son blog, l'utilisateur peut ajouter des posts
    if($isMyBlog)
    {
        ?>
        <form method="post" action="ajoutVoie.php">
                <p>
                    <input type="hidden" name="idGrimpeur" value="<?php echo $id;?>">
                    <input type="hidden" name="table" value="voie">
                    <input type="submit" name="1" value="Ajouter une voie">
                </p>
        </form>
        <?php
    }
    // Affiche les posts de la discipline voie
    afficher("voie", $id, $isMyBlog);

    echo '<h2>Blocs récemment réussis: </h2>';
    if($isMyBlog)
    {?>
        <form method="post" action="ajoutVoie.php">
            <p>
                <input type="hidden" name="idGrimpeur" value="<?php echo $id;?>">
                <input type="hidden" name="table" value="bloc">
                <input type="submit" name="1" value="Ajouter un bloc" />
            </p>
        </form>
        <?php
    }
    afficher("bloc", $id, $isMyBlog);

    echo '<h2>Blocs VSup récemment réussis : </h2>';
    if($isMyBlog)
    {?>
        <form method="post" action="ajoutVoie.php">
            <p>
                <input type="hidden" name="idGrimpeur" value="<?php echo $id;?>">
                <input type="hidden" name="table" value="vsup">
                <input type="submit" name="1" value="Ajouter un bloc vsup" />
            </p>
        </form>
        <?php
    }
    afficher("vsup", $id, $isMyBlog);


    DisconnectDatabase();
    ?>
</div>
</body>
</html> 