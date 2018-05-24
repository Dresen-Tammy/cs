<?php



function checkName($name, $password, $db)
{

    $sql = 'SELECT rider_name FROM rider WHERE rider_name=:name AND password=:password';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $match = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (!empty($match)) {
        return 1;
    } else {
        return 0;
    }
}

function getRides($name, $db)
{
    $sql = 'select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r 
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id where ri.rider_name=:name';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rideList;
}

function getRidesWeek($name, $db)
{
    $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r 
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id 
where ri.rider_name=:name AND r.ride_date > now() - interval '1 week'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rideList;
}


function getRidesMonth($name, $db)
{
$sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id
where ri.rider_name=:name AND r.ride_date > now() - interval '1 month'";
$stmt = $db->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->execute();
$rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
$stmt->closeCursor();
return $rideList;
}

function getRidesByDate($name, $startDate, $endDate, $db) {
    $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id
where ri.rider_name=:name AND r.ride_date > :startDate AND r.ride_date < :endDate";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
    $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
    $stmt->execute();
    $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rideList;
}

function getTrails($db) {
    $sql = "SELECT trail_id, trail_name FROM trail";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $trailList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $trailList;
}

function getRidesByTrail($name, $trail, $db) {
    $sql = 'select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r 
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id 
where ri.rider_name=:name AND t.trail_id=:trail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':trail', $trail, PDO::PARAM_INT);
    $stmt->execute();
    $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rideList;
}

function getIndividualRide($name, $ride, $db) {
    $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name from ride r 
inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id 
where ri.rider_name=:name AND r.ride_id=:ride";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':ride', $ride, PDO::PARAM_INT);
    $stmt->execute();
    $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $rideList;
}



function buildRideDisplay($rideList)
{
    // builds list of rides to display for viewRides.php
    $rideDisplay = "<ul>";
    $distance = 0;
    $duration = new DateTime('00:00');
    $time = clone $duration;
    $elevation = 0;
    foreach ($rideList as $ride) {
        $date = date('F d, Y', strtotime($ride['ride_date']));
        $rideDisplay .= "<li><a href='index.php?action=individual&time=$ride[ride_id]'>$date  -  $ride[ride_name]</a></li>";
        $distance += $ride['distance'];
        $rideName = $ride['ride_name'];
        $hours = substr($ride['duration'], 0, 2) . ' hours ' . substr($ride['duration'], 3, 2) . ' minutes';
        $duration->add(date_interval_create_from_date_string($hours));
        $elevation += $ride['elevation'];
        $trail_name = $ride['trail_name'];
    }
    $inter = $time->diff($duration);
    $rideDisplay .= "</ul>";
    $rideArray = array($rideDisplay, $distance, $elevation, $inter, $trail_name, $date, $rideName);
    return $rideArray;

}

function buildTrailSelect($trailList) {
    $trailSelect = "<select class='select' name='trail'>";
        foreach ($trailList as $trail) {
            $trailSelect .= "<option value='$trail[trail_id]'>$trail[trail_name]</option>";
        }
    $trailSelect .= "</select>";
        return $trailSelect;
}





    ?>