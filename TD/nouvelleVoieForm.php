<!-- Formulaire d'ajout de voie, pre rempli si c'est une modification -->
<form method="post" action="ajoutVoie.php?table=voie">
    <p>
        <label for="nom">Nom de la voie :</label>
        <textarea type="text" name="nom" id = "nom" rows = "1" cols = "50" maxlength=100><?php echo $nom;?></textarea>

        <!-- Choix parmi toutes les cotations possibles -->
        <label for="cotation">Cotation :</label>
        <SELECT name="cotation" size="1">
            <OPTION <?php if ($cotation=="4") echo 'selected="selected"';?>>4</OPTION>
            <OPTION <?php if ($cotation=="5a") echo 'selected="selected"';?>>5a</OPTION>
            <OPTION <?php if ($cotation=="5b") echo 'selected="selected"';?>>5b</OPTION>
            <OPTION <?php if ($cotation=="5c") echo 'selected="selected"';?>>5c</OPTION>
            <OPTION <?php if ($cotation=="6a") echo 'selected="selected"';?>>6a</OPTION>
            <OPTION <?php if ($cotation=="6a+") echo 'selected="selected"';?>>6a+</OPTION>
            <OPTION <?php if ($cotation=="6b") echo 'selected="selected"';?>>6b</OPTION>
            <OPTION <?php if ($cotation=="6b+") echo 'selected="selected"';?>>6b+</OPTION>
            <OPTION <?php if ($cotation=="6c") echo 'selected="selected"';?>>6c</OPTION>
            <OPTION <?php if ($cotation=="6c+") echo 'selected="selected"';?>>6c+</OPTION>
            <OPTION <?php if ($cotation=="7a") echo 'selected="selected"';?>>7a</OPTION>
            <OPTION <?php if ($cotation=="7a+") echo 'selected="selected"';?>>7a+</OPTION>
            <OPTION <?php if ($cotation=="7b") echo 'selected="selected"';?>>7b</OPTION>
            <OPTION <?php if ($cotation=="7b+") echo 'selected="selected"';?>>7b+</OPTION>
            <OPTION <?php if ($cotation=="7c") echo 'selected="selected"';?>>7c</OPTION>
            <OPTION <?php if ($cotation=="7c+") echo 'selected="selected"';?>>7c+</OPTION>
            <OPTION <?php if ($cotation=="8a") echo 'selected="selected"';?>>8a</OPTION>
            <OPTION <?php if ($cotation=="8a+") echo 'selected="selected"';?>>8a+</OPTION>
            <OPTION <?php if ($cotation=="8b") echo 'selected="selected"';?>>8b</OPTION>
            <OPTION <?php if ($cotation=="8b+") echo 'selected="selected"';?>>8b+</OPTION>
            <OPTION <?php if ($cotation=="8c") echo 'selected="selected"';?>>8c</OPTION>
            <OPTION <?php if ($cotation=="8c+") echo 'selected="selected"';?>>8c+</OPTION>
            <OPTION <?php if ($cotation=="9a") echo 'selected="selected"';?>>9a</OPTION>
            <OPTION <?php if ($cotation=="9a+") echo 'selected="selected"';?>>9a+</OPTION>
            <OPTION <?php if ($cotation=="9b") echo 'selected="selected"';?>>9b</OPTION>
            <OPTION <?php if ($cotation=="9b+") echo 'selected="selected"';?>>9b+</OPTION>
            <OPTION <?php if ($cotation=="9c") echo 'selected="selected"';?>>9c</OPTION>
        </SELECT>

        <label for="description">Description :</label>
        <textarea type="text" name="description" id="description" rows = "5" cols = "50" maxlength="500" ><?php echo $description;?></textarea>
        <input type="hidden" name="Modifier" value="<?php if(isset($_POST['Modifier'])) echo'1'; else echo'0';?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="idGrimpeur" value="<?php echo $idGrimpeur;?>">
        <input type="submit" value="Envoyer" />
    </p>
</form>