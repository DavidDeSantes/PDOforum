<?php ob_start(); ?>
<?php echo "Il y a ".$requete->rowCount()." topic(s)" ?>
<table class="tableTopic" >
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date de création</th>
            <th>Ouvert/Fermer</th>
            <th>Créé par</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete as $topic) { ?>
            <tr>
                <td><a href="index.php?action=listMessage&id=<?= $topic["id_topic"] ?>"><?= $topic["titre"] ?></a></td>
                <td><?= $topic["dateCreation"] ?></td>
                <td><?= $topic["verrouille"] == 1 ? "<i class='fa-solid fa-lock-open'></i>" : "<i class='fa-solid fa-lock'></i>" ?></td>
                <td><a href="index.php?action=listMembreTopic&id=<?= $topic["membre_id"] ?>"><?= $topic["pseudo"] ?></a></td>
                <td><?= $topic["nom_categorie"] ?></td>
            </tr>
        <?php }
        $requete = null;
        ?>
    </tbody>
</table>
<form action="index.php?action=addTopic" method="post">
    <input class="input" type="text" name="titre" placeholder="Titre du topic.."> <br>
    <select class="input" name="membre_id">
        <?php foreach ($requete_topic->fetchAll() as $membre) { ?>
            <option value="<?= $membre["id_membre"] ?>"><?= $membre["pseudo"] ?></option>
        <?php } ?>
    <input type="hidden" name="categorie_id" value="<?= $topic["categorie_id"] ?>">
    <input type="hidden" name="verrouille" value="<?= $topic['verrouille'] = 1?>">
    <input type="hidden" name="date_create" value="<?= date("Y/m/d H:i:s") ?>"> <br>
    <input class="input" type="submit" name="submit" value="Envoyer">
</form>
<?php
$titre = "";
$titreSecondaire = "Topic";
$contenu = ob_get_clean();
require "view/template.php";
