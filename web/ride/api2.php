<?php
header('Content-type: application/json');

include_once ('dbconnect.php');


$trail = filter_input(INPUT_GET, 'trail', FILTER_SANITIZE_NUMBER_INT);
$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


$sql = "UPDATE ride SET ride_name=:name, ride_date=:date, trail_id=:trail WHERE ride_id=:id";
$rideListQuery = $db->prepare($sql);
$rideListQuery->bindValue(':trail', $trail, PDO::PARAM_INT);
$rideListQuery->bindValue(':name', $name, PDO::PARAM_STR);
$rideListQuery->bindValue(':date', $date, PDO::PARAM_STR);
$rideListQuery->bindValue(':id', $id, PDO::PARAM_INT);
$rideListQuery->execute();
$rowsChanged = $rideListQuery->rowCount();
$rideListQuery->closeCursor();
if ($rowsChanged == 1) {

    $sql2 = "SELECT r.ride_id, r.ride_name, r.ride_date, t.distance, t.elevation, t.trail_name, t.trail_id FROM ride r 
INNER JOIN trail t ON r.trail_id = t.trail_id WHERE r.ride_id=:id";
    $stmt = $db->prepare($sql2);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rideList = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();


    echo json_encode($rideList);
}

