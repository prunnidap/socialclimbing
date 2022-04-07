<!-- Formulaire d'ajout de bloc vsup, pre rempli si c'est une modification -->
<form method="post" action="ajoutVoie.php?table=vsup">
    <label for="cotation">Cotation :</label>
    <!-- Choix parmi toutes les cotations possibles -->
    <SELECT name="cotation" size="1">
            <OPTION>Vert</OPTION>
            <OPTION <?php if ($cotation=="Vert/Bleu") echo 'selected="selected"';?>>Vert/Bleu</OPTION>
            <OPTION <?php if ($cotation=="Bleu") echo 'selected="selected"';?>>Bleu</OPTION>
            <OPTION <?php if ($cotation=="Bleu/Violet") echo 'selected="selected"';?>>Bleu/Violet</OPTION>
            <OPTION <?php if ($cotation=="Violet") echo 'selected="selected"';?>>Violet</OPTION>
            <OPTION <?php if ($cotation=="Violet/Rouge") echo 'selected="selected"';?>>Violet/Rouge</OPTION>
            <OPTION <?php if ($cotation=="Rouge") echo 'selected="selected"';?>>Rouge</OPTION>
            <OPTION <?php if ($cotation=="Rouge/Orange") echo 'selected="selected"';?>>Rouge/Orange</OPTION>
            <OPTION <?php if ($cotation=="Orange") echo 'selected="selected"';?>>Orange</OPTION>
            <OPTION <?php if ($cotation=="Orange/Jaune") echo 'selected="selected"';?>>Orange/Jaune</OPTION>
            <OPTION <?php if ($cotation=="Jaune") echo 'selected="selected"';?>>Jaune</OPTION>
            <OPTION <?php if ($cotation=="Jaune/Arc-en-ciel") echo 'selected="selected"';?>>Jaune/Arc-en-ciel</OPTION>
            <OPTION <?php if ($cotation=="Arc-en-ciel") echo 'selected="selected"';?>>Arc-en-ciel</OPTION>
        </SELECT>

        <label for="description">Description :</label>
        <textarea type="text" name="description" id="description" rows = "5" cols = "50" maxlength="500" ><?php echo $description;?></textarea>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="idGrimpeur" value="<?php echo $idGrimpeur;?>">
        <input type="hidden" name="Modifier" value="<?php if(isset($_POST['Modifier'])) echo'1'; else echo'0';?>">
        <input type="submit" value="Envoyer" />
    </p>
</form>