<?php
class Database{
 
    // specify your own database credentials
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
        echo "Connection error: " . $exception->getMessage();
      }
      
    }

    private function __clone(){}

    public static function getInstance() {
      if (!(self::$_instance instanceof self)) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }

    public function query($query) {
      return $this->conn->prepare($query);
      //return $stmt->execute();
    }
}
?>
