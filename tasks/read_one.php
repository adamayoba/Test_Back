<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/Database.php';
    include_once '../models/Tasks.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie les Tasks
    $task = new Tasks($db);

    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->id)){
        $task->id = $donnees->id;

        // On récupère le task
        $task->read_one();

        // On vérifie si le task existe
        if($task->title != null){

            $tabTask = [
                "id" => $task->id,
                "user_id" => $task->user_id,
                "title" => $task->title,
                "description" => $task->description,
                "creation_date" => $task->creation_date,
                "status" => $task->status,
               
            ];
            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($tabTask);
        }else{
            // 404 Not found
            http_response_code(404);
         
            echo json_encode(array("message" => "Le task n'existe pas."));
        }
        
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}