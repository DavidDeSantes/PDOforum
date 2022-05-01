<?php ob_start(); ?>
<!-- ce fetch  -->
<?php $topic = $requete_topic->fetch() ?>
<!-- Le rowCount compte combien y a d'enregistrement(lignes), message dans notre situation-->
<?php if ($requete->rowCount() == 0) {
    echo "Aucun message";

} else {
    // la cette fois ci il va compte le nombre de message
    echo "<p>Il y a " . $requete->rowCount() . " message(s)</p>" ?>
    <table class="tableMessage">
        <thead>
            <tr>
                <th>Envoyé le</th>
                <th>Par</th>
                <th>Message</th>
                <th>Sujet</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($requete as $message) { ?>
                <tr>
                    <td><?= $message["dateCreation"] ?></td>
                    <td><a href="index.php?action=listMembreTopic&id=<?= $message["membre_id"] ?>"><?= $message["pseudo"] ?></a></td>
                    <td><?= $message["message"] ?></a></td>
                    <td><?= $message["titre"] ?></td>
                </tr>
            <?php }
            $requete = null;
            ?>
        </tbody>
    </table>
<?php } ?>
<?php if ($topic['verrouille'] == 1) {  ?>
    <form action="index.php?action=addMessage" method="post">
        <textarea id="mytextarea" class="textarea" name="message" placeholder="Veuillez écrire votre message.." cols="40" rows="10"></textarea><br>
        <select class="input" name="membre_id">
            <?php foreach ($requete_message->fetchAll() as $membre) { ?>
                <option value="<?= $membre["id_membre"] ?>"><?= $membre["pseudo"] ?></option>
            <?php } ?>
        </select> <br>
        <input type="hidden" name="date_create" value="<?= date("Y/m/d H:i:s") ?>">
        <input type="hidden" name="topic_id" value="<?= $topic["id_topic"] ?>">
        <input class="input" type="submit" name="submit" value="Envoyer">
    <?php } else {
    echo "<img src='img/closed.png' class='closed' alt='Le topic est fermé !'>";
} ?>
    </form>
    <?php

    $titre = "";
    $titreSecondaire = "Messages du topic :" . " " . $topic['titre'];
    $contenu = ob_get_clean();
    require "view/template.php";
