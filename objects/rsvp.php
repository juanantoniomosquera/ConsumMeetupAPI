<?php
class Rsvp {
  private $conn;
  private $tableName = "rsvps";

  public $rsvp_id;
  public $group_id;
  public $group_name;
  public $group_city;
  public $group_country;
  public $group_lon;
  public $group_lat;
  public $event_id;
  public $event_name;
  public $event_time;
  public $event_url;
  
  public function __construct($db){
    $this->conn = $db;
  }

  // obtains all rsvps
  function givemeRsvps(){
 
    // select all query
    $query = "SELECT * FROM " . $this->tableName;
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
  }


  function near() {
    //uso del Teorema del coseno para localizar grupos cercanos en distancia (200 km)
    $query = "SELECT group_id,group_name,group_city,group_country,group_lon,group_lat, (6371 * ACOS( 
                                SIN(RADIANS(group_lat)) * SIN(RADIANS(:group_lat)) 
                                + COS(RADIANS(group_lon - :group_lon)) * COS(RADIANS(group_lat)) 
                                * COS(RADIANS(:group_lat))
                                )
                   ) AS distance
             FROM " . $this->tableName . "
             HAVING distance < 200";


    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":group_lon", $this->group_lon);
    $stmt->bindParam(":group_lat", $this->group_lat);
 
    // execute query
    $stmt->execute();

    return $stmt;
  }  

  function insertRsvp(){
 
    $query = "INSERT INTO
                " . $this->tableName . "
            SET
                group_id=:group_id, group_name=:group_name,group_city=:group_city,group_country=:group_country,group_lon=:group_lon,group_lat=:group_lat
                rsvp_id=:rsvp_id,event_id=:event_id,event_name=:event_name,event_time=:event_time,event_url=:event_url";
 
    $stmt = $this->conn->prepare($query);
 
    // limpiar
    $this->group_id=htmlspecialchars(strip_tags($this->group_id));
    $this->group_name=htmlspecialchars(strip_tags($this->group_name));
    $this->group_city=htmlspecialchars(strip_tags($this->group_city));
    $this->group_country=htmlspecialchars(strip_tags($this->group_country));
    $this->group_lon=htmlspecialchars(strip_tags($this->group_lon));
    $this->group_lat=htmlspecialchars(strip_tags($this->group_lat));
    $this->rsvp_id=htmlspecialchars(strip_tags($this->rsvp_id));
    $this->event_id=htmlspecialchars(strip_tags($this->event_id));
    $this->event_name=htmlspecialchars(strip_tags($this->event_name));
    $this->event_time=htmlspecialchars(strip_tags($this->event_time));
    $this->event_url=htmlspecialchars(strip_tags($this->event_url));
 
    // bind values
    $stmt->bindParam(":group_id", $this->group_id);
    $stmt->bindParam(":group_name", $this->group_name);
    $stmt->bindParam(":group_city", $this->group_city);
    $stmt->bindParam(":group_country", $this->group_country);
    $stmt->bindParam(":group_lon", $this->group_lon);
    $stmt->bindParam(":group_lat", $this->group_lat);
    $stmt->bindParam(":rsvp_id", $this->rsvp_id);
    $stmt->bindParam(":event_id", $this->event_id);
    $stmt->bindParam(":event_name", $this->event_name);
    $stmt->bindParam(":event_time", $this->event_time);
    $stmt->bindParam(":event_url", $this->event_url);

    die($stmt);
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
  }

}
?>
