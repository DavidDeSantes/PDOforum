<?php

namespace Controller;

use Model\Connect;

class TopicController
{
    public function listTopic($id)
    {
        $pdo = Connect::seConnecter();
        $requete= $pdo->prepare("
            SELECT id_topic, titre, DATE_FORMAT(t.date_create, '%d/%m/%Y %H:%i:%s') AS dateCreation, verrouille, pseudo, nom_categorie, t.categorie_id, t.membre_id
            FROM topic t
            INNER JOIN membre m ON t.membre_id = m.id_membre
            INNER JOIN categorie c ON t.categorie_id = c.id_categorie
            WHERE categorie_id = :id
            ORDER BY dateCreation DESC
        ");
        $requete->execute([
            "id" => $id
        ]);
        $pdo = Connect::seConnecter();
        $requete_topic = $pdo->query("
             SELECT id_membre, pseudo
             FROM membre 
             ORDER BY pseudo
        ");
        require "view/listTopic.php";
    }

    public function addTopic()
    { 
        $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $membre_id = filter_input(INPUT_POST, 'membre_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_create = filter_input(INPUT_POST, 'date_create', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categorie_id = filter_input(INPUT_POST, 'categorie_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $verrouille = filter_input(INPUT_POST, 'verrouille', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($titre && $membre_id && $date_create && $categorie_id && $verrouille){
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                 INSERT INTO topic (titre, membre_id, date_create, categorie_id, verrouille)
                 VALUES (:titre, :membre_id, :date_create, :categorie_id, :verrouille)
            ");
            $requete->execute([
                'titre' => $titre,
                'membre_id' => $membre_id,
                'date_create' => $date_create,
                'categorie_id' => $categorie_id,
                'verrouille' => $verrouille
            ]);
            //
            header('location:'.$_SERVER['HTTP_REFERER']);
            die();
        } else {
            echo 'Service indisponible';
        }
    }

}