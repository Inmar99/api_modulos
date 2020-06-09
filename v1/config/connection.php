<?php 

class Connection {
    /* Especificando credenciales de base de datos */
    private $host = "b9nngunwpnjy1lfhpmji-mysql.services.clever-cloud.com";
    private $db_name = "b9nngunwpnjy1lfhpmji";
    private $username = "uh6piym7rcbrle2u";
    private $password  = "IATIIBP9jmcVfUNwIby6";
    public $conn;

    // Obteniendo la conexion a la base de datos
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}



?>
