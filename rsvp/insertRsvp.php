<?php

  // get database connection
  include_once '../config/database.php';
 
  // instantiate rsvp object
  include_once '../objects/rsvp.php';
 
  $database = new Database();
  $db = $database->getConnection();
 
  $rsvp = new Rsvp($db);
 
  $rsvp->rsvp_id = $_POST['rsvp']['rsvp_id'];
  $rsvp->rsvp_name = $_POST['rsvp']['rsvp_name'];
  $rsvp->rsvp_city = $_POST['rsvp']['rsvp_city'];
  $rsvp->rsvp_country = $_POST['rsvp']['rsvp_country'];
  $rsvp->rsvp_lon = $_POST['rsvp']['rsvp_lon'];
  $rsvp->rsvp_lat = $_POST['rsvp']['rsvp_lat'];
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
