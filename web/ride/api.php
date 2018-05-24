<?php

include_once ('dbconnect.php');
$ride = $_GET['ride'];
$sql = "Select r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name 
FROM ride r INNER JOIN trail t ON r.trail_id = t.trail_id WHERE r.ride_id=$ride";
$stmt = $db->query($sql);
$stmt->execute();
$rideData = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($rideData);

