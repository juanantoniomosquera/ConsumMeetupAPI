<?php

  // get database connection
  include_once '../config/database.php';
 
  // instantiate group object
  include_once '../objects/rsvp.php';
 
  $database = new Database();
  $db = $database->getConnection();
 
  $group = new Rsvp($db);
 
  $group->group_id = $_POST['group']['group_id'];
  $group->group_name = $_POST['group']['group_name'];
  $group->group_city = $_POST['group']['group_city'];
  $group->group_country = $_POST['group']['group_country'];
  $group->group_lon = $_POST['group']['group_lon'];
  $group->group_lat = $_POST['group']['group_lat'];
  $group->rsvp_id = $_POST['rsvp_id'];
  $group->event_id = $_POST['event']['event_id'];
  $group->event_name = $_POST['event']['event_name'];
  $group->event_time = $_POST['event']['event_time'];
  $group->event_url = $_POST['event']['event_url'];
 
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
