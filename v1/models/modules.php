<?php 

class Modules {

    /* Variables de conexion y nombre de la tabla */
    private $conn;
    private $table_name = "modules";
    /* Creando propiedades del objeto Modulos */
    public $id;
    public $internal_code;
    public $name;
    public $description;

    /* Constructor como conexion de base de datos */

    public function __construct($database){
        $this->conn = $database;
    }

    // Leer todos los modulos
    function ListData(){
    $query = "SELECT id, internal_code,name,description FROM ". $this->table_name." ";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
    }

    // Leer modulo mediante id
    function ListDataToId($id){
        $query = "SELECT id, internal_code,name,description FROM ". $this->table_name." WHERE id = :id ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    // Crear nuevo modulo
    function Created(){
        $query = "INSERT INTO ".$this->table_name." (internal_code, name, description) VALUES (:internal_code, :name, :description) ";
        $stmt = $this->conn->prepare($query);
        $this->internal_code=htmlspecialchars(strip_tags($this->internal_code));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(":internal_code", $this->internal_code);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        if($stmt->execute()){
            return true;
        }else{
            return false;   
        }
        
    }

    function Updated(){
        $query = "UPDATE ".$this->table_name." SET internal_code=:internal_code, name=:name, description=:description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->internal_code=htmlspecialchars(strip_tags($this->internal_code));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":internal_code", $this->internal_code);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;   
        }
    }


    function Deleted(){
        $query = "DELETE FROM ".$this->table_name."  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }else{
            return false;   
        }
    }
}



?>