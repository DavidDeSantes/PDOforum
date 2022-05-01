<?php

namespace Controller;

use Model\Connect;

class MembreController
{
    
    public function listMembreTopic($id)
    {
        $pdo = Connect::seConnecter();
        
        $pdo = Connect::seConnecter();
        $requete= $pdo->prepare("
            SELECT id_membre, pseudo, id_topic, titre
            FROM membre m 
            INNER JOIN topic t ON m.id_membre = t.membre_id
            WHERE id_membre = :id
        ");
        $requete->execute([
            "id" => $id
        ]);
        require "view/listMembreTopic.php";
    }

}    