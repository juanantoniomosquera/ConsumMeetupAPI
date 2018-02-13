<?php
/**
 * Clase para gestion de RSVPs de Meetup API
 *
 * @author Juan Antonio Mosquera <juanantoniomosquera@juanantoniomosquera.com>
 * @copyright 2018
 * @license GPL
 */ 
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
  public $guests;
  public $member_id;
  public $member_name;
  
  public function __construct($db) {
    $this->conn = $db;
  }

  /**
   * Funcion que obtiene todos los RSVPs almacenados
   *
   * @return object resultado de consulta a BBDD
   *
   */ 
  public function givemeRsvps() {
 
    $query = "SELECT * FROM " . $this->tableName;
 
    $stmt = $this->conn->prepare($query);
 
    $stmt->execute();
 
    return $stmt;
  }

  /**
   * Funcion que devuelve grupos de Meetup a 200 km a la redondas segun coordenadas usando teorema del coseno
   *
   * @return object resultado consulta a BBDD 
   *
   */ 
  public function near() {
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
 
    $stmt->execute();

    return $stmt;
  }  

  /**
   * Funcion que inserta en BBDD RSVPs
   *
   * @return Boolean true si la insercion ha sido correcta
   *
   */ 
  public function insertRsvp() {
 
    $query = "INSERT INTO
                " . $this->tableName . "
            SET
                group_id=:group_id, group_name=:group_name,group_city=:group_city,group_country=:group_country,group_lon=:group_lon,group_lat=:group_lat,
                rsvp_id=:rsvp_id,event_id=:event_id,event_name=:event_name,event_time=:event_time,event_url=:event_url,guests=:guests,member_id=:member_id,member_name=:member_name";
 
    $stmt = $this->conn->prepare($query);

    $this->group_id=htmlspecialchars(strip_tags($this->group_id));
    $this->group_name=htmlspecialchars(strip_tags($this->group_name));
    $this->group_city=htmlspecialchars(strip_tags($this->group_city));
    $this->group_country=htmlspecialchars(strip_tags($this->group_country));
    $this->group_lon=htmlspecialchars(strip_tags($this->group_lon));
    $this->group_lat=htmlspecialchars(strip_tags($this->group_lat));
    $this->rsvp_id=htmlspecialchars(strip_tags($this->rsvp_id));
    $this->event_id=htmlspecialchars(strip_tags($this->event_id));
    $this->event_name=htmlspecialchars(strip_tags($this->event_name));
    $this->event_time=htmlspecialchars(strip_tags(date('Y-m-d', substr($this->event_time,0,10))));
    $this->event_url=htmlspecialchars(strip_tags($this->event_url));
    $this->guests=htmlspecialchars(strip_tags($this->guests));
    $this->member_id=htmlspecialchars(strip_tags($this->member_id));
    $this->member_name=htmlspecialchars(strip_tags($this->member_name));
 
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
    $stmt->bindParam(":guests", $this->guests);
    $stmt->bindParam(":member_id", $this->member_id);
    $stmt->bindParam(":member_name", $this->member_name);

    if($stmt->execute()){
      return true;
    }
    return false;
  }

  /**
   * Funcion que muestra las ciudades TOP con asistentes a eventos segun fecha de evento
   *
   * @return Object Datos de evento, ciudad y asistentes
   *
   */ 
  public function topCities() {
    $query = "SELECT event_name,event_time,group_city,count(event_id) totalAsistentes
             FROM " . $this->tableName . "
             WHERE event_time = :event_time
             GROUP BY group_city
             ORDER BY totalAsistentes DESC";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":event_time", $this->event_time);
 
    $stmt->execute();

    return $stmt;
  }  

}
?>
