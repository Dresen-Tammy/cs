<?php
header('Content-type: application/json');

include_once ('dbconnect.php');

$ride = $_GET['trail'];
$trail_name;
$start_location;
$distance;
$elevation;
$rideListQuery = $db->query("SELECT trail_name, start_location, distance, elevation FROM trail WHERE (trail_id = '{$ride}');");
$rideListQuery->execute();
$rideList = $rideListQuery->fetch(PDO::FETCH_NAMED);

echo json_encode($rideList);



