<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/group.php';
 
// instantiate database and group object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$group = new Group($db);
 
// query groups
$stmt = $group->givemeAllGroups();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $groups_arr=array();
    $groups_arr["records"]=array();
 
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $group_item=array(
            "group_id" => $group_id,
            "group_name" => $group_name,
            "group_city" => $group_country,
            "group_country" => $group_country,
            "group_lon" => $group_lon,
            "group_lat" => $group_lat
        );
 
        array_push($groups_arr["records"], $group_item);
    }
 
    echo json_encode($groups_arr);
}
 
else{
    echo json_encode(
        array("message" => "No groups found.")
    );
}
?>
