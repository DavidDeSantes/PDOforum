<?php ob_start(); ?>
<?php echo "Il y a ".$requete->rowCount()." catégorie(s)";
$countAll = $requete_countAll->fetch();

session_start();

if(!isset($_SESSION['user'])){
    echo "<h2><a href='index.php?action=viewLogin'>Connectez-vous</a>  Ou <a href='index.php?action=register'>Inscrivez-vous ! </a></h2>";
}
else{
    echo "<h2> Bienvenue ".ucwords($_SESSION['user'])."</h2>";
    echo "<h2><a href='logout.php'>Deconnexion<a></h2>";
}

?>
<table>
    <thead>
        <tr>
            <th>Catégorie</th>
        </tr>
    </thead>
    <h3>Bienvenue sur le Forum du désespoir MOUAHAHAHA !</h3>
    <tbody>
        <?php 
        foreach($requete as $categorie){ ?>
           <tr>
               <td><a href="index.php?action=listTopic&id=<?= $categorie["id_categorie"] ?>"><?=$categorie["nom_categorie"]?></a></td>
           </tr>
      <?php }
      $requete = null;
      ?>
    </tbody>
</table>
<?= "Sur notre Forum il y a ".$countAll['nbCategorie']." catégorie,  ".$countAll['nbTopic']." topics,  ".$countAll['nbMessage']." messages,  "." pour ".$countAll['nbMembre']." membres ! "?>
<?php
// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "Forum désespoir";
$titreSecondaire = "Catégorie";
$contenu = ob_get_clean();
require "view/template.php";