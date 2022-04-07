<!-- Toutes les fonctions qui ne sont pas liees au classement -->

<?php
// Vérifie les données entrées dans un formulaire
function check_fill()
{
    $nom = "";
    $cotation = "";
    $description = "";
    $fillSuccessful = 0;
    // Si les donnes existent
    if(isset($_POST["cotation"]) && isset($_POST["description"])){
        if(isset($_POST["nom"]))
            $nom = $_POST["nom"];
        $cotation = $_POST["cotation"];
        $description = $_POST["description"];
        $fillSuccessful = 1;
    }
    else if(isset($_POST["cotation"]))
        $cotation = $_POST["cotation"];
    if(isset($_POST["action"]))
    {
        if($_POST["action"] == "supprimer")
            $fillSuccessful = 2;
        else if($_POST["action"] == "modifier")
            $fillSuccessful = 3;
    }
    // On retourne les valeurs dans un tableau
    return array($nom, $cotation, $description, $fillSuccessful);
}
//Function to clean up an user input for safety reasons
//--------------------------------------------------------------------------------
function SecurizeString_ForSQL($string) {
    $string = trim($string);
    $string = stripcslashes($string);
    $string = addslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

// Affiche 10 voies d'escalade reussies recemment
function afficherRandom()
{
    global $conn;
    // Discipline bloc
    echo'<h2>Blocs récemment réussis : </h2>';
    $query = "SELECT * FROM `bloc`";
    $result = $conn->query($query);
    $i = 0;
    if( mysqli_num_rows($result) != 0 ) {
        while ($row = $result->fetch_assoc()) {
            $i++;
            // On n'en affiche pas plus de 10
            if ($i > 10)
                break;
            echo '<h3>•' . $row["nom"] . '</h3>
               <p>Grimpeur : ' . $row["grimpeur"] . '</p>
               <p>Cotation : ' . $row["cotation"] . ' </p>';
            echo '
            <p>Date : ' . $row["date"] . '</p>
            <p>Description :</p>
            <textarea rows = "5" cols = "50">' . $row["description"] . '</textarea>';
        }
    }
    // S'il y avait moins de 10 blocs a afficher, on affiche des voies
    if($i<10) {
        echo '<h2>Voies récemment enchaînées : </h2>';
        $query = "SELECT * FROM `voie`";
        $result = $conn->query($query);
        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $i++;
                if ($i > 10)
                    break;
                echo '<h3>•' . $row["nom"] . '</h3>
               <p>Grimpeur : ' . $row["grimpeur"] . '</p>
               <p>Cotation : ' . $row["cotation"] . ' </p>';
                echo '
            <p>Date : ' . $row["date"] . '</p>
            <p>Description :</p>
            <textarea rows = "5" cols = "50">' . $row["description"] . '</textarea>';
            }
        }
    }
    // S'il y avait moins de 10 blocs et voies a afficher, on affiche des blocs vsup

    if($i<10) {
        echo '<h2>Blocs VSup récemment réussis : </h2>';
        $query = "SELECT * FROM `vsup`";
        $result = $conn->query($query);
        if (mysqli_num_rows($result) != 0) {
            while ($row = $result->fetch_assoc()) {
                $i++;
                if ($i > 10)
                    break;
                echo '<h3>•Couleur : ' . $row["cotation"] . ' </h3 >
                 <p>Grimpeur : ' . $row["grimpeur"] . '</p>';
                echo '
            <p>Date : ' . $row["date"] . '</p>
            <p>Description :</p>
            <textarea rows = "5" cols = "50">' . $row["description"] . '</textarea>';
            }
        }
    }
}
// stocke le nombre de voies réussies dans chaque cotation dans un tableau
function nbVoiesParCotation($table, $idGrimpeur)
{
    global $conn;
    $query = "SELECT cotation FROM " . $table . " WHERE idGrimpeur = '" . $idGrimpeur . "'";
    $result = $conn->query($query);
    if (mysqli_num_rows($result) != 0) {
        $i = 0;
        // Cree le tableau
        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
        $array2 = array();
        foreach($array as $index => $row) {
            $array2[] = $row['cotation'];
        }
        return array_count_values($array2);
    }
}

function chiffreEnLettres($a)
{
    $convert = explode('.',$a);
    if (isset($convert[1]) && $convert[1]!=''){
        return int2str($convert[0]).'Dinars'.' et '.int2str($convert[1]).'Centimes' ;
    }
    if ($a<0) return 'moins '.int2str(-$a);
    if ($a<17){
        switch ($a){
            case 0: return 'zero';
            case 1: return 'un';
            case 2: return 'deux';
            case 3: return 'trois';
            case 4: return 'quatre';
            case 5: return 'cinq';
            case 6: return 'six';
            case 7: return 'sept';
            case 8: return 'huit';
            case 9: return 'neuf';
            case 10: return 'dix';
            case 11: return 'onze';
            case 12: return 'douze';
            case 13: return 'treize';
            case 14: return 'quatorze';
            case 15: return 'quinze';
            case 16: return 'seize';
        }
    } else if ($a<20){
        return 'dix-'.int2str($a-10);
    } else if ($a<100){
        if ($a%10==0){
            switch ($a){
                case 20: return 'vingt';
                case 30: return 'trente';
                case 40: return 'quarante';
                case 50: return 'cinquante';
                case 60: return 'soixante';
                case 70: return 'soixante-dix';
                case 80: return 'quatre-vingt';
                case 90: return 'quatre-vingt-dix';
            }
        } elseif (substr($a, -1)==1){
            if( ((int)($a/10)*10)<70 ){
                return int2str((int)($a/10)*10).'-et-un';
            } elseif ($a==71) {
                return 'soixante-et-onze';
            } elseif ($a==81) {
                return 'quatre-vingt-un';
            } elseif ($a==91) {
                return 'quatre-vingt-onze';
            }
        } elseif ($a<70){
            return int2str($a-$a%10).'-'.int2str($a%10);
        } elseif ($a<80){
            return int2str(60).'-'.int2str($a%20);
        } else{
            return int2str(80).'-'.int2str($a%20);
        }
    } else if ($a==100){
        return 'cent';
    } else if ($a<200){
        return int2str(100).' '.int2str($a%100);
    } else if ($a<1000){
        return int2str((int)($a/100)).' '.int2str(100).' '.int2str($a%100);
    } else if ($a==1000){
        return 'mille';
    } else if ($a<2000){
        return int2str(1000).' '.int2str($a%1000).' ';
    } else if ($a<1000000){
        return int2str((int)($a/1000)).' '.int2str(1000).' '.int2str($a%1000);
    }
    else if ($a==1000000){
        return 'millions';
    }
    else if ($a<2000000){
        return int2str(1000000).' '.int2str($a%1000000).' ';
    }
    else if ($a<1000000000){
        return int2str((int)($a/1000000)).' '.int2str(1000000).' '.int2str($a%1000000);
    }
}
// Affiche toutes les voies de toutes disciplines reussies, sur le profil du grimpeur
function afficher($table, $idGrimpeur, $isMyBlog)
{
    global $conn;
    $query = "SELECT * FROM ".$table." WHERE idGrimpeur = '".$idGrimpeur."' ORDER BY date DESC";
    $result = $conn->query($query);
    if( mysqli_num_rows($result) != 0 ){
        $i = 0;
        while( $row = $result->fetch_assoc()){
            if($table != "vsup")
            {
                echo '<h3>•'.$row["nom"].'</h3>
                <p>Cotation : '.$row["cotation"].' </p >';
            }
            else
            {
                echo'<h3>•Couleur : '.$row["cotation"].' </h3 >';
            }
            echo'
            <p>Date : '.$row["date"].'</p>
            <p>Description :</p>
            <textarea rows = "5" cols = "50">'.$row["description"].'</textarea>';

            if(isset($row["nom"]))
                $nom = $row["nom"];
            else
                $nom = $row["cotation"];
            // Si c'est le proprietaire du blog qui le consulte, il peut le modifier
            if($isMyBlog == true)
            {
                // Formulaires de modification et de suppression des posts
                ?>
                <form method="post" action="confirmationSuppr.php">
                    <p>
                        <input type="hidden" name="nom" value="<?php echo $nom;?>">
                        <input type="hidden" name="table" value="<?php echo $table;?>">
                        <input type="hidden" name="cotation" value="<?php echo $row["cotation"];?>">
                        <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                        <input type="hidden" name="idGrimpeur" value="<?php echo $idGrimpeur;?>">
                        <input type="submit" name="Supprimer" value="Supprimer" />
                    </p>
                </form>
                <form method="post" action="ajoutVoie.php">
                    <p>
                        <input type="hidden" name="nom" value="<?php echo $nom;?>">
                        <input type="hidden" name="cotation" value="<?php echo $row["cotation"];?>">
                        <input type="hidden" name="date" value="<?php echo $row["date"];?>">
                        <input type="hidden" name="description" value="<?php echo $row["description"];?>">
                        <input type="hidden" name="table" value="<?php echo $table;?>">
                        <input type="hidden" name="id" value="<?php echo $row["id"];?>">
                        <input type="hidden" name="idGrimpeur" value="<?php echo $idGrimpeur;?>">
                        <input type="hidden" name="action" value="modifier">
                        <input type="submit" name="Modifier" value=Modifier>
                    </p>
                </form>
                <?php
            }
        }
    }
    // Si la base de donnees est vide
    else {
        switch ($table) {
            case "voie":
                echo '<p>Pas de voie enregistrée. Va dehors grimper un peu !</p>';
                break;
            case "bloc":
                echo '<p>Pas de bloc enregistré. Va tâter du caillou !</p>';
                break;
            case "vsup":
                ?>
                <p>Pas de bloc à VSup enregistré. De toute façon c'est mieux en exté...</p>
                <?php
                break;
        }
    }
}

// Gere le formulaire de creation de compte
function CheckNewAccountForm(){
    global $conn;

    $creationAttempted = false;
    $creationSuccessful = false;
    $error = NULL;

    //Données reçues via formulaire?
    if(isset($_POST["pseudo"]) && isset($_POST["pass"]) && isset($_POST["confirm"])){

        $creationAttempted = true;

        if ( $_POST["pass"] != $_POST["confirm"] ){
            $error = "Le mot de passe et sa confirmation sont différents";
        }
        else {
            $username = SecurizeString_ForSQL($_POST["pseudo"]);
            $password = md5($_POST["pass"]);
            // Cree le compte dans la base de donnees
            $query = "INSERT INTO `login` VALUES (NULL, '$username', '$password' )";
            $result = $conn->query($query);

            if( mysqli_affected_rows($conn) == 0 )
            {
                $error = "Erreur lors de l'insertion SQL. Essayez un nom/password sans caractères spéciaux";
            }
            else{
                $creationSuccessful = true;
            }
            // Recupere l'id insere juste avant, pour avoir le meme id dans la table classement
            $query = "SELECT * FROM login WHERE logname = '".$username."'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $userID=$row['id'];
            $query = "INSERT INTO `classement` VALUES ('$userID', '$username', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
            $result = $conn->query($query);

        }

    }
    return array($creationAttempted, $creationSuccessful, $error);
}
// Function to open connection to database
//--------------------------------------------------------------------------------
function ConnectDatabase(){
    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "PsmUBXmds4jscjtWGYgD";
    $dbname = "escalade";
    global $conn;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
// Verifie si l'utilisateur est connecte
function check_login()
{
    $userID = "";
    $pseudo = "";
    $pass = "";
    $loginSuccessful = false;
    $loginAttempted = false;
    global $conn;
    //Données reçues via formulaire?
    if (isset($_POST["pseudo"]) && isset($_POST["pass"])) {
        $pseudo = SecurizeString_ForSQL($_POST["pseudo"]);
        $password = md5($_POST["pass"]);
        $loginAttempted = true;
    } //Vérifier le cookie permet de rester connecté si on l'est déjà
    else if (isset($_COOKIE["pseudo"]) && isset($_COOKIE["password"])) {
        $pseudo = $_COOKIE["pseudo"];
        $password = $_COOKIE["password"];
        $loginAttempted = true;
    } else {
        $loginAttempted = false;
    }

//Si on a des données, on vérifie qu'elles collent au login attendu
    if ($loginAttempted) {
        $query = "SELECT * FROM login WHERE logname = '".$pseudo."' AND password ='".$password."'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        if( mysqli_num_rows($result) != 0 ){
            $userID = $row['id'];

            //On crée le cookie, pour pouvoir rester connecté pendant toute la durée du timestamp
            setcookie('pseudo', $pseudo, time() + 3600 * 24, '/', '', false, true);
            setcookie('password', $password, time() + 3600 * 24, '/', '', false, true);
            setcookie('id', $userID, time() + 3600 * 24, '/', '', false, true);
            $loginSuccessful = true;
        }
        else {
            $error = "Ce couple login/mot de passe n'existe pas. Créez un Compte";

        }
    }
    return array($loginSuccessful, $loginAttempted, $userID, $pseudo);
}
// Verifie si le blog consulte est le sien
function isMyBlog($userID)
{
    $password = "";
    $pseudo = "";
    global $conn;
    // On recupere les donnes de login de l'utilisateur
    if (isset($_COOKIE["pseudo"]) && isset($_COOKIE["password"])) {
        $password = $_COOKIE["password"];
        $pseudo = $_COOKIE["pseudo"];
    }
    // On recherche si le mot de passe correspond avec le mdp du profil consulte
    $query = "SELECT * FROM login WHERE id = '".$userID."' AND password ='".$password."' AND logname = '".$pseudo."'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if( mysqli_num_rows($result) != 0 ){
        return true;
    }
    else
        return false;
}
// Function to get current URL, without file name
//--------------------------------------------------------------------------------
function GetUrl() {
    $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
    $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
    $url .= dirname($_SERVER["REQUEST_URI"]);
    return $url;
}
// Function to close connection to database
//--------------------------------------------------------------------------------
function DisconnectDatabase(){
    global $conn;
    $conn->close();
}
?>