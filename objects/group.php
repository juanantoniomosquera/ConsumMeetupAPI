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

  // obtains all groups
  function givemeAllGroups(){
 
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


  function near() {
    $query = "SELECT
                group_id,group_name,group_city,group_country, group_lon, group_lat
            FROM
                " . $this->tableName . "
            WHERE
                group_lon = ?
            AND
                group_lat = ?";
 
    $stmt = $this->conn->prepare( $query );
 
    $stmt->bindParam(1, $this->group_lon);
    $stmt->bindParam(2, $this->group_lat);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->group_id = $row['group_id'];
    $this->group_name = $row['group_name'];
    $this->group_city = $row['group_city'];
    $this->group_country = $row['group_country'];
    $this->group_lon = $row['group_lon'];
    $this->group_lat = $row['group_lat'];
    }  
  }   
?>
