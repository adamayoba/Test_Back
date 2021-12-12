<?php 
/**
 * class of Tasks
 * 
 */
class Tasks{
    private $connexion;
    private $table = "task";

    public $id;
    public $user_id;
    public $title;
    public $description;
    public $creation_date;
    public $status;

    /*
    *constructor with $db to connected database
    * @param $db
    */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Read users
     * @return void
     * 
     */
    public function read(){
        //query
        $sql = "SELECT t.id, t.user_id,
        t.title, t.description, t.creation_date, t.status
        FROM " . $this->table . " t LEFT JOIN user u ON
        t.user_id = u.id ORDER BY t.creation_date DESC";
        //prepare query
        $query = $this->connexion->prepare($sql);
        //execute query
        $query ->execute();
        return $query;
}

/**
     * Read user
     * @return void
     * 
     */
public function read_one(){
    //query
       $sql = "SELECT t.id, t.user_id, t.title, t.description, 
       t.creation_date, t.status FROM " . $this->table . 
       " t LEFT JOIN user u ON t.user_id = u.id WHERE t.id = ? LIMIT 0,1";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objetuser_id
        $this->user_id = $row['user_id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->creation_date = $row['creation_date'];
        $this->status = $row['status'];
}

/**
     * Create user
     *
     * @return void
     */
    public function create(){

        // 
        $sql = "INSERT INTO " . $this->table . " SET user_id=:user_id, 
        title=:title, description=:description, status=:status";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->status=htmlspecialchars(strip_tags($this->status));

        // Ajout des données protégées
        $query->bindParam(":user_id", $this->user_id);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":status", $this->status);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

        /**
     * deleted user
     *
     * @return void
     */
    public function delete(){
        // 
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // 
        $query = $this->connexion->prepare( $sql );

        // 
        $this->id=htmlspecialchars(strip_tags($this->id));

        // 
        $query->bindParam(1, $this->id);

        // 
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * updated user
     *
     * @return void
     */
    public function update(){
        // 
        $sql = "UPDATE " . $this->table . " SET user_id = :user_id,
         title = :title, description = :description,
         status=:status WHERE id = :id";
        
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->description=htmlspecialchars(strip_tags($this->description));
        //$this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
        $this->status=htmlspecialchars(strip_tags($this->status));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        // On attache les variables
        $query->bindParam(':user_id', $this->user_id);
        $query->bindParam(':title', $this->title);
        $query->bindParam(':description', $this->description);
        //$query->bindParam(':creation_date', $this->creation_date);
        $query->bindParam(':status', $this->status);
        $query->bindParam(':id', $this->id);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Read user
     * @return void
     * 
     */
public function read_user(){
    //query
       $sql = "SELECT t.id, t.user_id,  t.title, t.description, 
       t.creation_date, t.status FROM " . $this->table . 
       " t LEFT JOIN user u ON t.user_id = u.id WHERE  t.user_id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->user_id);

        // On exécute la requête
        $query->execute();

       return $query;
}
}

?>