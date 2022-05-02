<?php ob_start(); ?>
<body class="body2">
<div id="container2">
    <!-- Le formulaire de  connexion -->
    <form class="form2" action="index.php?action=getMembre" method="POST">
        <h1>Connexion</h1>

        <label><b>Nom d'utilisateur</b></label>
        <input class="input2" type="text" placeholder="Entrer votre pseudo" name="pseudo" required>
        <label><b>Mot de passe</b></label>
        <input class="input2" type="password" placeholder="Entrer votre mot de passe" name="password" required>
        <input class="input2" type="submit" id='submit' value='LOGIN'>
    </form>
    <p><a href="index.php?action=register">S'inscrire</a></p>
    </body>
<?php
$titre = "";
$titreSecondaire = "";
$contenu = ob_get_clean();
require "view/template.php";
