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

  $timeObject = new DateTime($_GET['event_time']);
  $rsvp->event_time = $timeObject->format('U');

  $stmt = $rsvp->topCities();
  $num = $stmt->rowCount();
    
  // check if more than 0 record found
  if($num>0){
 
    // groups array
    $groups_arr=array();
    $groups_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      
        extract($row);  
        $timeEvent = new DateTime($event_time);
        $group_item=array(
            "member_id" => $member_id,
            "member_name" => $member_name,
            "group_city" => $group_city,
            "event_time" => $timeEvent->format('Y-m-d'),
            "totalAsistentes" => $totalAsistentes
        );
 
        array_push($groups_arr["records"], $group_item);
    }
 
    echo json_encode($groups_arr);
  }
 
  else{
    echo json_encode(
        array("message" => "No se encontraron ciudades.")
    );
  }

?>
