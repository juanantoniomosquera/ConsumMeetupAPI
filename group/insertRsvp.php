<?php

  // get database connection
  include_once '../config/database.php';
 
  // instantiate group object
  include_once '../objects/group.php';
 
  $database = new Database();
  $db = $database->getConnection();
 
  $group = new Group($db);
 
  $group->group_id = $_POST['group']['group_id'];
  $group->group_name = $_POST['group']['group_name'];
  $group->group_city = $_POST['group']['group_city'];
  $group->group_country = $_POST['group']['group_country'];
  $group->group_lon = $_POST['group']['group_lon'];
  $group->group_lat = $_POST['group']['group_lat'];
 
  if($group->insertRsvp()){
    echo '{';
        echo '"message": "guardado"';
    echo '}';
  } else {
    echo '{';
        echo '"message": "fallo al guardar"';
    echo '}';
  }
?>
