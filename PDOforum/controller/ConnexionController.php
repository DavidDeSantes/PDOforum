<?php

namespace Controller;

use Model\Connect;

class ConnexionController
{
    public function register()
    {
        require "view/register.php";
    }

    public function viewlogin()
    {
        require 'view/viewLogin.php';
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
                header('location: index.php?action=viewLogin');
                die();
            } else {
                header('location: index.php?action=register');
                echo "Les mots de passes ne sont pas identiques";

            }
        } else {
            echo 'Service indisponible';
        }
    }

    public function login()
    {
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hash_pass = password_verify($password, PASSWORD_DEFAULT);

        if ($pseudo && $password) {
            if ($_POST['password']) {
                password_verify($password, $hash_pass);
                $pdo = Connect::seConnecter();
                $requete = $pdo->query('
                SELECT pseudo, password
                FROM membre WHERE pseudo = :pseudo');
                $_SESSION['user'] = $pseudo;

                header('location:index.php?action=listCategorie');
                die();
            } else {
                echo 'Une erreur est survenue';
            }
        }
    }

}
