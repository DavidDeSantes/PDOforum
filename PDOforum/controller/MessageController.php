<?php

namespace Controller;

use Model\Connect;

class MessageController
{
    public function listMessage($id)
    {
        $pdo = Connect::seConnecter();
        $requete_topic = $pdo->prepare("
        SELECT * 
        FROM topic
        WHERE id_topic = :id
        ");
        $requete_topic->execute([
            "id" => $id
        ]);
        $requete = $pdo->prepare("
           SELECT id_message, message,DATE_FORMAT(m.date_create, '%d/%m/%Y %H:%i:%s') AS dateCreation, pseudo, titre, m.topic_id, verrouille, m.membre_id
           FROM message m
           INNER JOIN membre me ON m.membre_id = me.id_membre
           INNER JOIN topic t ON m.topic_id = t.id_topic
           WHERE topic_id = :id
           ORDER BY dateCreation 
        ");
        $requete->execute([
            "id" => $id
        ]);
        $requete_message = $pdo->query("
             SELECT id_membre, pseudo
             FROM membre 
             ORDER BY pseudo
        ");

        require "view/listMessage.php";
    }

    public function addMessage()
    {

        $message = filter_input(INPUT_POST, 'message');
        $membre_id = filter_input(INPUT_POST, 'membre_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date_create = filter_input(INPUT_POST, 'date_create', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($message && $membre_id && $date_create && $topic_id) {
            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare("
                 INSERT INTO message (message, membre_id, date_create, topic_id)
                 VALUES (:message, :membre_id, :date_create, :topic_id)
            ");
            $requete->execute([
                'message' => $message,
                'membre_id' => $membre_id,
                'date_create' => $date_create,
                'topic_id' => $topic_id
            ]);
            header('location:'.$_SERVER['HTTP_REFERER']);
            die();
        } else {
            echo 'Service indisponible';
        }
    }
}
