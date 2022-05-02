<?php

namespace Controller;

use Model\Connect;



class ConnexionController
{
    private $connection;
    private $membre;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getMembre($pseudo)
    {
        // PDO gère l'injection SQL en 3 étapes :
        try {
            // Faire de la requête SQL
            $sql = "SELECT pseudo, password FROM membre WHERE pseudo = LOWER(:uname) ; ";

            //Requête préparée dans le serveu, envoi au serveur mais pas encore l'execution (1er : Préparation)
            $statement = $this->connection->prepare($sql);

            //injection des paramètres (2eme : Compilation)
            $statement->bindParam("uname", $pseudo);

            //Execution de la requête (3eme : Execution)

            $statement->execute();

            // On récupère l'objet utilisateur de la base de données 
            $this->membre = $statement->fetch();

            return $this->membre;
        } catch (\PDOException $error) {
            return $error->getMessage();
        }
    }

    public function verify_password($pseudo)
    {
        return password_verify($pseudo, $this->membre['password']);
    }

    public function login()
    {
        require "view/login.php";
        require_once("MyError.php");
        require_once("TraitementController.php");

        $controller = new ConnexionController($connection);

        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);


        $membre = $controller->getMembre($pseudo);

        if (is_array($membre)) {

            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);

            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Grâce à un algorythme cette fonction va réussir à analyser l'emprunte numérique du password hash de notre mdp
            // est donc réussir à nous identifier si l'analyse est juste. 
            if ($controller->verify_password($password)) {
                // hash_equals est une fonction qui peux comparer 2 chaines de caractères hashé 
                if (hash_equals($_SESSION['token'], $token)) {

                    $_SESSION['membre'] = $membre;
                    header("Location:login.php");
                } else {
                    $_SESSION['error']->setError(107, "identification incorrect token ! Veuillez réessayer...");
                    header("Location:index.php?error");
                }
            }
        } else {

            $_SESSION['error']->setError(101, "identification incorrect ! Veuillez réessayer...");
            header("Location:index.php?error");
        }
    }
}
