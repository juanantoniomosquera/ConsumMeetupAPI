<?php 

	//print json_encode($_POST['event']['event_name']);

    	//Datos de conexión a la base de datos
    	$host       = "localhost";
    	$usuario    = "meetup";
    	$clave      = "abc123.";
    	$basedatos  = "meetup";
    	$tablaGrupos = "groups";
    	$tablaEventos = "events";
  
   	$event_id = json_encode($_POST['event']['event_id']);  
    	$event_name = json_encode($_POST['event']['event_name']);
    	$event_url = json_encode($_POST['event']['event_url']);
    	$time = json_encode($_POST['event']['time']);
   	$group_id = json_encode($_POST['group']['group_id']);  
    	$group_name = json_encode($_POST['group']['group_name']);
    	$group_city = json_encode($_POST['group']['group_city']);
    	$group_country = json_encode($_POST['group']['group_country']);
    	$group_lat = json_encode($_POST['group']['group_lat']);
    	$group_lon = json_encode($_POST['group']['group_lon']);

    	$mysqli = new mysqli($host, $usuario, $clave, $basedatos);
 
    	if ($mysqli->connect_errno) {
        	die( "Error al conectar a MySQL: " . $mysqli->error );
    	}	
 /*
   	if(!$result = $mysqli->query("INSERT INTO $tablaEventos (event_id, event_name, event_url, time) VALUES ('".$event_id."','".$event_name."','".$event_url."','".$time."')") === TRUE) {
		printf("Error en ejecucion de query: %s\n", $mysqli->error);	
	}

   	if(!$result = $mysqli->query("INSERT INTO $tablaGrupos (group_id, group_name, group_city, group_country, group_lon, group_lat) VALUES ('".$group_id."','".$group_name."','".$group_city."','".$group_country."','".$group_lon."','".$group_lat."')") === TRUE) {
		printf("Error en ejecucion de query: %s\n", $mysqli->error);	
	}
*/
	$mysqli->close();
?>
