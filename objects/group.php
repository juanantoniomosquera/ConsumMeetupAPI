<?php
class Group {
  private $conn;
  private $tableName = "groups";

  public $group_id;
  public $group_name;
  public $group_city;
  public $group_country;
  public $group_lon;
  public $group_lat;
  
  public function __construct($db){
    $this->conn = $db;
  }

  // read products
  function read(){
 
    // select all query
    $query = "SELECT
                group_id,group_name,group_city,group_country, group_lon, group_lat
            FROM
                " . $this->tableName;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
  }
}   
?>
