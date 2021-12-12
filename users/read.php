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
    include_once '../models/Users.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie les Users
    $user = new Users($db);

    // On récupère les données
    $stmt = $user->read();
   

    // On vérifie si on a au moins 1 user
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tabUsers = [];
        $tabUsers['Users'] = [];

        // On parcourt les Users
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $users = [
                "id" => $id,
                "name" => $name,
                "email" => $email,
            ];

            $tabUsers['Users'][] = $users;
			
             //array_push($tableauUsers['Users'],$us);
        }

        
        // On envoie le code réponse 200 OK
        http_response_code(200);
		
        
        // On encode en json et on envoi 
        echo json_encode($tabUsers);
    }else{

        echo json_encode(["message" => "La base de donnée est vide"]);
    }
    
}else{

    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);

}