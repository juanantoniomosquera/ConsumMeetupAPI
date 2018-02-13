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

  //parametros obtenidos por GET para realizar la consulta
  $rsvp->group_lon = $_GET['group_lon'];
  $rsvp->group_lat = $_GET['group_lat'];

  $stmt = $rsvp->near();
  $num = $stmt->rowCount();
    
  if($num>0) {
    $groups_arr=array();
    $groups_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);
 
      $group_item=array(
        "group_id" => $group_id,
        "group_name" => $group_name,
        "group_city" => $group_city,
        "group_country" => $group_country,
        "group_lon" => $group_lon,
        "group_lat" => $group_lat,
        "group_distance" => $distance
      );
 
      array_push($groups_arr["records"], $group_item);
    }
 
    echo json_encode($groups_arr);
  }
  else {
    echo json_encode(
        array("message" => "No se encontraron grupos.")
    );
  }

?>
