<?php

namespace Controller;

use Model\Connect;

session_start();

class TraitementController
{
    public function register()
    {
        require "view/register.php";
    }

    //Fonction qui va permettre d'ajouter un utilisateur dans notre bdd(membre dans notre cas)
    public function add_user()
    {
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


        if ($pseudo && $password) {
            // Le if ci-dessous, va permettre de comparer le password qu'on souhaite avec la répétition, si les 2 ne sont pas similaire, l'inscription ne marche pas. 
            if ($_POST['password'] == $_POST['password2']) {
                $pdo = Connect::seConnecter();
                $requete = $pdo->prepare("
                 INSERT INTO membre (pseudo, password)
                 VALUES (:pseudo, :password)
            ");
                $pseudo = strtolower($pseudo);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $requete->execute([
                    'pseudo' => $pseudo,
                    'password' => $password
                ]);
                header('location: index.php?action=login');
                die();
            } else {
                header('location: index.php?action=register');
                // echo 'Service indisponible';
            }
        } else {
            echo 'Service indisponible';
        }
    }

}
