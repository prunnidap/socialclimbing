<!-- Toutes les fonctions liees aux classements -->

<?php


// Renvoie dans un tableau le classement dans une certaine discipline, trie
function classement($table)
{
    global $conn;
    switch($table)
    {
        case "voie":
            $query = "SELECT * FROM classement ORDER BY pointsVoie DESC";
            break;
        case "bloc":
            $query = "SELECT * FROM classement ORDER BY pointsBloc DESC";
            break;
        case "vsup":
            $query = "SELECT * FROM classement ORDER BY pointsVSup DESC";
            break;
        case "general":
            $query = "SELECT * FROM classement ORDER BY points DESC";
            break;
    }
    $result = $conn->query($query);
    $maxPoints = 0;
    // Cree le tableau
    $array = array();
    // Le remplit
    if( mysqli_num_rows($result) != 0 ){
        while( $row = $result->fetch_assoc() ){
            $array[] = $row;
        }
    }
    return $array;
}

// Table de conversion entre la cotation d'escalade et le nombre de points correspondant
function points($cotation)
{
    $points = 0;
    switch($cotation)
    {
        case '4':
            $points = 1;
            break;
        case '5a':
            $points = 3;
            break;
        case '5b':
            $points = 25;
            break;
        case '5c':
            $points = 100;
            break;
        case '6a':
            $points = 310;
            break;
        case '6a+':
            $points = 770;
            break;
        case '6b':
            $points = 1680;
            break;
        case '6b+':
            $points = 3270;
            break;
        case '6c':
            $points = 5900;
            break;
        case '6c+':
            $points = 10000;
            break;
        case '7a':
            $points = 16100;
            break;
        case '7a+':
            $points = 24880;
            break;
        case '7b':
            $points = 37120;
            break;
        case '7b+':
            $points = 53780;
            break;
        case '7c':
            $points = 75930;
            break;
        case '7c+':
            $points = 104850;
            break;
        case '8a':
            $points = 141980;
            break;
        case '8a+':
            $points = 188950;
            break;
        case '8b':
            $points = 247600;
            break;
        case '8b+':
            $points = 320000;
            break;
        case '8c':
            $points = 408410;
            break;
        case '8c+':
            $points = 515360;
            break;
        case '9a':
            $points = 643630;
            break;
        case '9a+':
            $points = 796260;
            break;
        case '9b':
            $points = 976560;
            break;
        case '9b+':
            $points = 1188130;
            break;
        case '9c':
            $points = 1434890;
            break;
        case 'Vert':
            $points = 1;
            break;
        case 'Vert/Bleu':
            $points = 10;
            break;
        case 'Bleu':
            $points = 20;
            break;
        case 'Bleu/Violet':
            $points = 30;
            break;
        case 'Violet':
            $points = 50;
            break;
        case 'Violet/Rouge':
            $points = 100;
            break;
        case 'Rouge':
            $points = 300;
            break;
        case 'Rouge/Orange':
            $points = 3000;
            break;
        case 'Orange':
            $points = 6000;
            break;
        case 'Orange/Jaune':
            $points = 10000;
            break;
        case 'Jaune': // 7a+/b
            $points = 30000;
            break;
        case 'Jaune/Arc-en-ciel':
            $points = 50000;
            break;
        case 'Arc-en-ciel': // 7c
            $points = 75000;
            break;
    }
    return $points;
}

function triParCotation($array, $table)
{
    if($table == "voie")
    {
        $tableauCmp = array();
        //$tableauCmp[] =
    }
    $indice = 0;
    $boolean = true;
    $nbIteration = count($array) - 1;
    while($boolean){
        $indice = 1;
        $boolean = false;
        while($indice <= $nbIteration) {
            if( points($array[$indice]) < points($array[$indice-1])){
                $temp = $array[$indice];
                $array[$indice] = $array[$indice-1];
                $array[$indice-1] = $array[$indice];
                $boolean = true;;
            }
            $indice++;
        }
    }
}
// Calcule la cotation maximum d'un grimpeur, utile quand on supprime une voie qui etait la cotation maximale precedente
function niveauMax($table, $grimpeur)
{
    $query = "SELECT * FROM $table WHERE grimpeur = '".$grimpeur."'";
    global $conn;
    $result = $conn->query($query);
    $max = 0;
    $cotationMax = '0';
    if( mysqli_num_rows($result) != 0 )
    {
        while( $row = $result->fetch_assoc() )
        {
            // Simple algorithme de recherche du maximum, en utilisant la fonction points pour convertir cotation en points
            $temp = points($row["cotation"]);
            if($temp > $max) {
                $max = $temp;
                $cotationMax = $row["cotation"];
            }
        }
    }
    return $cotationMax;
}

// Mise à jour du classement du grimpeur après ajout d'une voie
function majAjout($grimpeur, $cotation, $idGrimpeur, $table)
{
    $pointsTotaux = 0;
    $nbVoies = 0;
    $nbBlocs = 0;
    $nbVSup = 0;
    $niveauVoie = '0';
    $niveauBloc = '0';
    $niveauVSup = '0';
    $pointsVoie = '0';
    $pointsBloc = '0';
    $pointsVSup = '0';
    $query = "SELECT * FROM classement WHERE grimpeur = '".$grimpeur."'";
    global $conn;
    $result = $conn->query($query);
    if( mysqli_num_rows($result) != 0 ){
        while( $row = $result->fetch_assoc() ){
            // Valeurs deja existantes
            $nbVoies = $row["nbVoies"];
            $nbBlocs = $row["nbBlocs"];
            $nbVSup = $row["nbVSup"];

            $niveauVoie = $row["niveauVoie"];
            $niveauBloc = $row["niveauBloc"];
            $niveauVSup = $row["niveauVSup"];

            $pointsVoie = $row["pointsVoie"];
            $pointsBloc = $row["pointsBloc"];
            $pointsVSup = $row["pointsVSup"];
            // Le nombre de points a ajouter
            $ajoutPoints = points($cotation);
            // Le nouveau nombre de points
            $pointsTotaux = $row["points"] + $ajoutPoints;
            switch($table)
            {
                case "voie":
                    // Determine la nouvelle cotation maximale, pas besoin de la fonction niveauMax() ici
                    if($ajoutPoints > points($row["niveauVoie"]))
                        $niveauVoie = $cotation;
                    // Nouveau nombre de voies
                    $nbVoies = $nbVoies + 1;
                    // Points dans la discipline voie specifiquement
                    $pointsVoie = $ajoutPoints + $row["pointsVoie"];
                    break;
                // Meme chose pour les autres disciplines
                case "bloc":
                    if($ajoutPoints > points($row["niveauBloc"]))
                        $niveauBloc = $cotation;
                    $nbBlocs = $nbBlocs + 1;
                    $pointsBloc = $ajoutPoints + $row["pointsBloc"];
                    break;
                case "vsup":
                    if($ajoutPoints > points($row["niveauVSup"]))
                        $niveauVSup = $cotation;
                    $nbVSup = $nbVSup + 1;
                    $pointsVSup = $ajoutPoints + $row["pointsVSup"];
                    break;
            }
        }
    }
    // Supprime les valeurs actuelles du grimpeur
    $query = "DELETE FROM classement WHERE grimpeur = '$grimpeur'";
    $conn->query($query);
    // Pour pouvoir inserer les nouvelles valeurs
    $query = "INSERT INTO `classement` VALUES ('$idGrimpeur', '$grimpeur', '$niveauVoie', '$niveauBloc', '$niveauVSup', '$nbVoies', '$nbBlocs', '$nbVSup', '$pointsTotaux', '$pointsVoie', '$pointsBloc', '$pointsVSup')";
    $conn->query($query);
}

// Mise à jour du profil du grimpeur après suppression d'une voie, meme chose que majAjout mais en soustrayant
function majSuppression($grimpeur, $cotation, $idGrimpeur, $table)
{
    $pointsTotaux = 0;
    $nbVoies = 0;
    $nbBlocs = 0;
    $nbVSup = 0;
    $niveauVoie = '0';
    $niveauBloc = '0';
    $niveauVSup = '0';
    $pointsVoie = '0';
    $pointsBloc = '0';
    $pointsVSup = '0';
    $query = "SELECT * FROM classement WHERE grimpeur = '".$grimpeur."'";
    global $conn;
    $result = $conn->query($query);
    if( mysqli_num_rows($result) != 0 ){
        while( $row = $result->fetch_assoc() ){
            // Valeurs deja existantes
            $nbVoies = $row["nbVoies"];
            $nbBlocs = $row["nbBlocs"];
            $nbVSup = $row["nbVSup"];

            $niveauVoie = $row["niveauVoie"];
            $niveauBloc = $row["niveauBloc"];
            $niveauVSup = $row["niveauVSup"];

            $pointsVoie = $row["pointsVoie"];
            $pointsBloc = $row["pointsBloc"];
            $pointsVSup = $row["pointsVSup"];
            // Le nombre de points a enlever
            $enleverPoints = points($cotation);
            // Le nouveau nombre de points
            $pointsTotaux = $row["points"] - $enleverPoints;
            switch($table)
            {
                case "voie":
                    // Nouveau nombre de voies effectuees
                    $nbVoies = $nbVoies - 1;
                    // Nouveau niveau max
                    $niveauVoie = niveauMax($table, $grimpeur);
                    // Nouveau nombre de points dans cette discipline
                    $pointsVoie = $pointsVoie - $enleverPoints;
                    break;
                // Meme chose pour les autres disciplines
                case "bloc":
                    $nbBlocs = $nbBlocs - 1;
                    $niveauBloc = niveauMax($table, $grimpeur);
                    $pointsBloc = $pointsBloc - $enleverPoints;
                    break;
                case "vsup":
                    $nbVSup = $nbVSup - 1;
                    $niveauVSup = niveauMax($table, $grimpeur);
                    $pointsVSup = $pointsVSup - $enleverPoints;
                    break;
            }
        }
    }
    // On supprime
    $query = "DELETE FROM classement WHERE grimpeur = '$grimpeur'";
    $conn->query($query);
    // Pour inserer les nouvelles valeurs
    $query = "INSERT INTO `classement` VALUES ('$idGrimpeur', '$grimpeur', '$niveauVoie', '$niveauBloc', '$niveauVSup', '$nbVoies', '$nbBlocs', '$nbVSup', '$pointsTotaux', '$pointsVoie', '$pointsBloc', '$pointsVSup')";
    $conn->query($query);
}
?>
