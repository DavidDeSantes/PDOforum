<?php

namespace Controller;

use Model\Connect;

class CategorieController
{

    public function listCategorie()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
             SELECT id_categorie, nom_categorie
             FROM categorie 
             ORDER BY nom_categorie
        ");
        $requete_countAll = $pdo->query("
             SELECT
                (SELECT COUNT(id_categorie) FROM categorie) as nbCategorie,
                (SELECT COUNT(id_membre) FROM membre) AS nbMembre,
                (SELECT COUNT(id_topic) FROM topic) AS nbTopic,
                (SELECT COUNT(id_message) FROM message) AS nbMessage
        ");
        require "view/listCategorie.php";
    }
}
