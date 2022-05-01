<?php ob_start(); 
$membre = $requete->fetch();
?>
<?php echo $membre['pseudo']." à créé ".$requete->rowCount()." topic(s)" ?>
<table>
    <thead>
        <tr>
            <th>Sujet</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete as $membre){ ?>
           <tr>
               <td><?=$membre["titre"]?></td>
           </tr>
      <?php }
      $requete = null;
      ?>
    </tbody>
</table>

<?php
// c'est la qu'on va afficher nos requêtes, ainsi que la connection avec la template 
$titre = "Forum désespoir";
$titreSecondaire = "Topic créé par"." ".$membre['pseudo'];
$contenu = ob_get_clean();
require "view/template.php";