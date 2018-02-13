<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');
 
  // include database and object files
  include_once '../config/database.php';
  include_once '../objects/group.php';
 
  // get database connection
  $database = new Database();
  $db = $database->getConnection();
 
  $group = new Group($db);

  //$group->group_lon = !empty($_GET['group lon']) ? $_GET['group_lon'] : die('Sin valor para longitud');
  //$group->group_lat = !empty($_GET['group_lat']) ? $_GET['group_lat'] : die('Sin valor para latitud');

  $group->group_lon = $_GET['group lon'];
  $group->group_lat = $_GET['group lat'];

  $group->near();
 
  $group_arr = array(
    "group_id" =>  $group->group_id,
    "group_name" => $group->group_name,
    "group_city" => $group->group_city,
    "group_country" => $group->group_country,
    "group_lon" => $group->group_lon,
    "group_lat" => $group->group_lat
 
  );
 
  print_r(json_encode($group_arr));
?>
