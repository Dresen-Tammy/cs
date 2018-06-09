<?php
header('Content-type: application/json');

include_once ('dbconnect.php');

$trail = filter_input(INPUT_GET, 'trail', FILTER_SANITIZE_NUMBER_INT);
$trail_name;
$start_location;
$distance;
$elevation;
$sql = "SELECT trail_name, start_location, distance, elevation FROM trail WHERE trail_id = :trail";
$rideListQuery = $db->prepare($sql);
$rideListQuery->bindValue(':trail', $trail, PDO::PARAM_INT);
$rideListQuery->execute();
$rideList = $rideListQuery->fetch(PDO::FETCH_NAMED);
$rideListQuery->closeCursor();

echo json_encode($rideList);



