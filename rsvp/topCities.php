<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
 
  include_once '../config/database.php';
  include_once '../objects/rsvp.php';
 
  $db = Database::getInstance();
  $conn = $db->getConnection();

  $rsvp = new Rsvp($conn);

  $rsvp->event_time = $_GET['event_time'];

  $stmt = $rsvp->topCities();
  $num = $stmt->rowCount();
    
  if($num>0) {
    $eventos_arr=array();
    $eventos_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);  

      $evento_item=array(
        "group_city" => $group_city,
        "event_name" => $event_name,
        "event_time" => $event_time,
        "totalAsistentes" => $totalAsistentes
      );
 
      array_push($eventos_arr["records"], $evento_item);
    }
 
    echo json_encode($eventos_arr);
  }
 
  else{
    echo json_encode(
      array("message" => "No se encontraron ciudades.")
    );
  }
?>
