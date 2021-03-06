<?php
/* *********************************
*   Read only Queries
 * *********************************/
try
{



}
catch (PDOException $ex)
{
    echo 'Error!: ' . $ex->getMessage();
    die();
}
/* ********* Checks **********/
// check to see if user name is already in database for registration
function checkUser($name, $db)
{
    try
    {
        $sql = 'SELECT rider_name FROM rider WHERE rider_name=:name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $matchName = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!empty($matchName)) {
            return 1;
        } else {
            return 0;
        }
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function checkNameOld($name, $password, $db)
{
    try
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
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// check to see if username and password are correct to "login" to app on login page
function checkName($name, $db)
{
    try
    {
        $sql = 'SELECT rider_name, password FROM rider WHERE rider_name=:name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $clientInfo = $stmt->fetch(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $clientInfo;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }

}

// check to see if trail already in database.
function checkTrail($name, $db)
{
    try
    {
        $sql = 'SELECT trail_name FROM trail WHERE trail_name=:name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $match = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!empty($match)) {
            return 1;
        } else {
            return 0;
        }
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

/* ************ Get rides *************/

// get list of rides for the user
function getRides($name, $db)
{
    try
    {
        $sql = 'select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r 
    inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id where ri.rider_name=:name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $rideList;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// get list of rides for user over last 7 days
function getRidesWeek($name, $db)
{
    try
    {
        $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r 
    inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id 
    where ri.rider_name=:name AND r.ride_date > now() - interval '1 week'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $rideList;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// get list of rides for user over last 1 month
function getRidesMonth($name, $db)
{
    try
    {
        $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r
        inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id
        where ri.rider_name=:name AND r.ride_date > now() - interval '1 month'";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $rideList;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// get list of rides for user between selected dates
function getRidesByDate($name, $startDate, $endDate, $db)
{
    try
    {
        $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r
    inner join rider ri on r.rider_id = ri.rider_id inner join trail t on r.trail_id = t.trail_id
    where ri.rider_name=:name AND r.ride_date >= :startDate AND r.ride_date <= :endDate";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindValue(':endDate', $endDate, PDO::PARAM_STR);
        $stmt->execute();
        $rideList = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $rideList;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// get all rides for user on selected trail
function getRidesByTrail($name, $trail, $db)
{
    try
    {
        $sql = 'select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r 
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
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

// get specific ride by ride_id and user
function getIndividualRide($name, $ride, $db)
{
    try
    {
        $sql = "select r.ride_id, r.ride_date, r.ride_name, r.duration, t.distance, t.elevation, t.trail_name, t.trail_id from ride r 
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
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

/* ************* Get Trails *************/

// get list of trails
function getTrails($db)
{
    try
    {
        $sql = "SELECT trail_id, trail_name FROM trail";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $trailList = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $trailList;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function getOneTrail($trail_id, $db)
{
    try
    {
        $sql = "SELECT trail_name, start_location, distance, elevation FROM trail WHERE trail_id=:trail_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':trail_id', $trail_id, PDO::PARAM_INT);
        $stmt->execute();
        $trailInfo = $stmt->fetch(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        return $trailInfo;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}


/* ***************************************
*   Add/delete data queries
 * ***************************************/
function createUser($name, $password, $db)
{
    try
    {
        $sql = "INSERT INTO rider (rider_name, password) VALUES (:name, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function addTrail($name, $location, $distance, $elevation, $db)
{
    try
    {
        $sql = "INSERT INTO trail (trail_name, start_location, distance, elevation)
    VALUES (:name, :location, :distance, :elevation)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':location', $location, PDO::PARAM_STR);
        $stmt->bindValue(':distance', $distance, PDO::PARAM_STR);
        $stmt->bindValue(':elevation', $elevation, PDO::PARAM_STR);
        $stmt->execute();
        $newId = $db->lastInsertId('trail_trail_id_seq');
        $stmt->closeCursor();
        return $newId;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function addRide($ride_name, $rider, $trail_id, $ride_date, $duration, $db)
{
    try
    {
        $sql = "INSERT INTO ride (ride_name, rider_id, trail_id, ride_date, duration)
    VALUES (:ride_name, (SELECT rider_id from rider WHERE rider_name = :rider), :trail_id, :ride_date, :duration)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':ride_name', $ride_name, PDO::PARAM_STR);
        $stmt->bindValue(':rider', $rider, PDO::PARAM_STR);
        $stmt->bindValue(':trail_id', $trail_id, PDO::PARAM_INT);
        $stmt->bindValue(':ride_date', $ride_date, PDO::PARAM_STR);
        $stmt->bindValue(':duration', $duration, PDO::PARAM_STR);
        $stmt->execute();
        $newId = $db->lastInsertId('ride_ride_id_seq');
        $stmt->closeCursor();
        return $newId;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function deleteRide($ride_id, $rider_name, $db)
{
    try
    {
        $sql = "DELETE FROM ride WHERE ride_id=:ride_id AND rider_id = (SELECT rider_id from rider WHERE rider_name = :rider_name)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':ride_id', $ride_id, PDO::PARAM_INT);
        $stmt->bindValue(':rider_name', $rider_name, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}
/* ***************************************
*  Update
*****************************************/
function updatePassword($password, $name, $db)
{
    try
    {
        $sql = "UPDATE rider SET password = :password WHERE rider_name = :name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

function updateRide($id, $trail, $name, $date, $db)
{
    try
    {
        $sql = "UPDATE ride SET (ride_name=:name, ride_date=:date, trail_id =:trail) WHERE ride_id=:id";
        $rideListQuery = $db->prepare($sql);
        $rideListQuery->bindValue(':trail', $trail, PDO::PARAM_INT);
        $rideListQuery->bindValue(':name', $name, PDO::PARAM_STR);
        $rideListQuery->bindValue(':date', $date, PDO::PARAM_STR);
        $rideListQuery->bindValue(':id', $id, PDO::PARAM_INT);
        $rideListQuery->execute();
        $rideListQuery->closeCursor();
    }
    catch (PDOException $ex)
    {
        echo 'Error!: ' . $ex->getMessage();
        die();
    }
}

/* ***************************************
*  Functions that build displays for views
*****************************************/

// build ride display for viewRides page
function buildRideDisplay($rideList, $back = 'all', $trail = 0, $startDate = '1820-04-06', $endDate = '1820-04-06')
{

    // builds list of rides to display for viewRides.php
    $rideDisplay = "<ul>";
    $distance = 0;
    $duration = new DateTime('00:00');
    $time = clone $duration;
    $elevation = 0;
    $trail_name = "";
    $date = date("1");
    $dateRaw = date('1');
    $rideName = "";
    $trail_id = 0;
    foreach ($rideList as $ride) {
        $date = date('F d, Y', strtotime($ride['ride_date']));
        $dateRaw = date('Y-m-d',strtotime($ride['ride_date']));
        if ($back == 'byDate') {
            $rideDisplay .= "<li><a href='index.php?action=individual&time=$ride[ride_id]&back=$back&startDate=$startDate&endDate=$endDate'>$date  -  $ride[ride_name]</a></li>";
        } elseif ($back == 'trail') {
            $rideDisplay .= "<li><a href='index.php?action=individual&time=$ride[ride_id]&back=$back&trail=$trail'>$date  -  $ride[ride_name]</a></li>";
        } else {
            $rideDisplay .= "<li><a href='index.php?action=individual&time=$ride[ride_id]&back=$back'>$date  -  $ride[ride_name]</a></li>";
        }
        $distance += $ride['distance'];
        $rideName = $ride['ride_name'];
        $hours = substr($ride['duration'], 0, 2) . ' hours ' . substr($ride['duration'], 3, 2) . ' minutes';
        $duration->add(date_interval_create_from_date_string($hours));
        $elevation += $ride['elevation'];
        $trail_name = $ride['trail_name'];
        $trail_id = $ride['trail_id'];

    }

    $inter = $time->diff($duration);
    $rideDisplay .= "</ul>";
    $rideArray = array($rideDisplay, $distance, $elevation, $inter, $trail_name, $date, $rideName, $trail_id, $dateRaw);
    return $rideArray;

}



// build select input with list of trails for add rides and for view rides by trail
function buildTrailSelect($trailList)
{
    $trailSelect = "<select class='select' name='trail'>";
        foreach ($trailList as $trail) {
            $trailSelect .= "<option value='$trail[trail_id]'>$trail[trail_name]</option>";
        }
    $trailSelect .= "</select>";
        return $trailSelect;
}

// build select input with list of trails, and add new trail value too.
function buildTrailAddNew($trailList) {
    $trailSelect = "<option>Select</option>";
    $trailSelect .= "<option value='-1'>Add New Trail</option>";
    foreach ($trailList as $trail) {
        $trailSelect .= "<option value='$trail[trail_id]'>$trail[trail_name]</option>";
    }
    return $trailSelect;
}

// build display of trails for add trail page
function buildTrailDisplay($trailList) {
    $trailDisplay = "<ul>";

    foreach ($trailList as $trail) {
        $trailDisplay .= "<li><a href='index.php?action=oneTrail&time=$trail[trail_id]'>$trail[trail_name]</a></li>";
    }
    $trailDisplay .= "</ul>";
    return $trailDisplay;
}

// build display for one trail
function buildOneTrail($trailInfo) {
    $oneTrailDisplay = "<h2>$trailInfo[trail_name]</h2>";
    $oneTrailDisplay .= "<p>Start Location: $trailInfo[start_location]<br>Distance: $trailInfo[distance] miles<br>Elevation: $trailInfo[elevation] feet</p>";
    return $oneTrailDisplay;
}

function passwordPattern($password)
{
    $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
    return preg_match($pattern, $password);
}
