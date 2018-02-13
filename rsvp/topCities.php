<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
 
  // include database and object files
  include_once '../config/database.php';
  include_once '../objects/rsvp.php';
 
  // get database connection
  $database = new Database();
  $db = $database->getConnection();
 
  $rsvp = new Rsvp($db);

  $rsvp->event_time = $_GET['event_time'];

  $stmt = $rsvp->topCities();
  $num = $stmt->rowCount();
    
  // check if more than 0 record found
  if($num>0){
 
    // array eventos por ciudad
    $eventos_arr=array();
    $eventos_arr["records"]=array();
 
    // retrieve our table contents
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
