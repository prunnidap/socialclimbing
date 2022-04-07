<!-- Formulaire de creation de compte-->
<form method="post" action="nouveauCompte.php">
    <p>
        <label for="pseudo">Pseudo</label> :
        <input type="text" name="pseudo" id = "pseudo"/>

        <label for="pass">Votre mot de passe :</label>
        <input type="password" name="pass" id="pass" />

        <label for="confirm">Confirmez votre mot de passe :</label>
        <input type="password" name="confirm" id="confirm" />

        <input type="submit" value="Envoyer" />
    </p>
</form>