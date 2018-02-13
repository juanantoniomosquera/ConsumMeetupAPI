<?php

  // get database connection
  include_once '../config/database.php';
 
  // instantiate rsvp object
  include_once '../objects/rsvp.php';
 
  $database = new Database();
  $db = $database->getConnection();
 
  $rsvp = new Rsvp($db);
 
  $rsvp->group_id = $_POST['group']['group_id'];
  $rsvp->group_name = $_POST['group']['group_name'];
  $rsvp->group_city = $_POST['group']['group_city'];
  $rsvp->group_country = $_POST['group']['group_country'];
  $rsvp->group_lon = $_POST['group']['group_lon'];
  $rsvp->group_lat = $_POST['group']['group_lat'];
  $rsvp->rsvp_id = $_POST['rsvp_id'];
  $rsvp->event_id = $_POST['event']['event_id'];
  $rsvp->event_name = $_POST['event']['event_name'];
  $rsvp->event_time = $_POST['event']['time'];
  $rsvp->event_url = $_POST['event']['event_url'];
 
  if($rsvp->insertRsvp()){
    echo '{';
        echo '"message": "guardado"';
    echo '}';
  } else {
    echo '{';
        echo '"message": "fallo al guardar"';
    echo '}';
  }
?>
