<?php 

/**
 * class of Users
 * 
 */
class Users{
    private $connexion;
    private $table = "user";

    public $id;
    public $name;
    public $email;

    /*
    *constructor with $db to connected database
    * @param $db
    */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Read users
     * @return $query
     * 
     */
    public function read(){
        //query
        $sql = "SELECT id, u.name, email FROM ".$this->table." u";
        //prepare query
        $query = $this->connexion->prepare($sql);
        //execute query
        $query ->execute();

        return $query;
}

/**
     * Read_one user
     * @return $query
     * 
     */
public function read_one(){
    //query
    $sql = "SELECT id, u.name, email FROM ".$this->table." u WHERE id = ? LIMIT 0,1";
    $query = $this->connexion->prepare($sql);
    $query->bindParam(1, $this->id);
    $query->execute();

    $row = $query->fetch(PDO::FETCH_ASSOC);

    // On hydrate l'objet
    $this->name = $row['name'];
    $this->email = $row['email'];
}

/**
     * Create user
     *
     * @return void
     */
    public function create(){

        // la requête d'insertion
        $sql = "INSERT INTO " . $this->table . " SET name=:name, email=:email";

        // preparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));


        // 
        $query->bindParam(":name", $this->name);
        $query->bindParam(":email", $this->email);
        

        // 
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
        $sql = "UPDATE " . $this->table . " SET name = :name, email = :email WHERE id = :id";
        
        // 
        $query = $this->connexion->prepare($sql);
        
        // 
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
        //$this->id=htmlspecialchars(strip_tags($this->id));
        
        // 
        $query->bindParam(':name', $this->name);
        $query->bindParam(':email', $this->email);
        $query->bindParam(':id', $this->id);
       
        //$query->bindParam(':id', $this->id);
        
        // exécute query
        if($query->execute()){
            return true;
        }
        
        return false;
    }
}

?>