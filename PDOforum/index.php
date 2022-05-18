<?php


use Controller\CategorieController;
use Controller\MessageController;
use Controller\TopicController;
use Controller\MembreController;
use Controller\ConnexionController;

spl_autoload_register(function ($class_name){
    include $class_name.'.php'; 
});

 
$ctrlCategorie = new CategorieController();
$ctrlTopic = new TopicController(); 
$ctrlMessage = new MessageController();
$ctrlMembre = new MembreController(); 
$ctrlConnexion = new ConnexionController();


// Par ailleurs pour accéder à notre application nous appliquons en local l'url suivante :
//   localhost/Exercices/PDOcinema/index.php?action=listCategorie
if(isset($_GET["action"])){
    switch($_GET["action"]) {

        case "listCategorie": $ctrlCategorie->listCategorie(); break; 
        case "listTopic": $ctrlTopic->listTopic($_GET["id"]); break;
        case "listMessage": $ctrlMessage->listMessage($_GET["id"]); break;
        case "addMessage": $ctrlMessage->addMessage(); break; 
        case "addTopic": $ctrlTopic->addTopic(); break;
        case "listMembreTopic": $ctrlMembre->listMembreTopic($_GET['id']); break;
        case "register": $ctrlConnexion->register(); break;      
        case "add_user": $ctrlConnexion->add_user(); break; 
        case "viewLogin": $ctrlConnexion->viewLogin(); break;
        case "login": $ctrlConnexion->login(); break;    
    } 
}