<?php

  // get database connection
  include_once '../config/database.php';
 
  // instantiate rsvp object
  include_once '../objects/rsvp.php';
 
  $db = Database::getInstance();
  $conn = $db->getConnection();

  $rsvp = new Rsvp($conn);
 
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
  $rsvp->guests = $_POST['guests'];
  $rsvp->member_id = $_POST['member']['member_id'];
  $rsvp->member_name = $_POST['member']['member_name'];
 
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
