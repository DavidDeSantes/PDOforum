<?php ob_start(); ?>
<body class="body2">
<div id="container2">
    <!-- Le formulaire d'inscription -->
    <form class="form2" action="index.php?action=add_user" method="POST">
        <h1>S'inscrire</h1>
        <label><b>Nom d'utilisateur</b></label>
        <input class="input2" type="text" placeholder="Veuillez créer votre pseudo" name="pseudo" required>
        <label><b>Mot de passe</b></label>
        <input class="input2" type="password" placeholder="Veuillez créer votre mot de passe" name="password" required>
        <label><b>Répéter votre mot de passe</b></label>
        <input class="input2" type="password" placeholder="Veuillez répéter votre mot de passe" name="password2" required>
        <input class="input2" type="submit" id="submit" value="s'inscrire">
    </form>
    <p><a href="index.php?action=login">Connexion</a></p>
    </body>
<?php
$titre = "";
$titreSecondaire = "";
$contenu = ob_get_clean();
require "view/template.php";

