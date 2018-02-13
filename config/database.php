<?php
/**
 * Clase para conexion a BBDD con patron Singleton.
 *
 * @author Juan Antonio Mosquera <juanantoniomosquera@juanantoniomosquera.com>
 * @copyright 2018
 * @license GPL
 */ 
class Database{
 
    private $host = "localhost";
    private $db_name = "meetup";
    private $username = "meetup";
    private $password = "abc123.";
    private $conn;
    static $_instance;
    
    private function __construct() {
      try {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->conn->exec("set names utf8");
      }catch(PDOException $exception){
        //echo "Connection error: " . $exception->getMessage();
        echo json_encode(
          array("message" => "Fallo al almacenar dato.")
        );
        die('PDO CONNECTION ERROR: ' . $exception->getMessage() . '<br/>');
      }
      
    }

    public static function getInstance() {
      if (!(self::$_instance instanceof self)) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    public function getConnection() {
      return $this->conn;
    }
}
?>
