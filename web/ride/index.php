<?php
include_once('dbconnect.php');
include_once ('functions.php');





// get user name from session if set. Store in variable.
if (isset($_COOKIE['name']))
{
    $cookieName = filter_input(INPUT_COOKIE, 'name', FILTER_SANITIZE_STRING);
}

// get input on which page to display. If no input, display login page.
$action = filter_input(INPUT_POST, 'action');
if($action == NULL)
{
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL)
    {
        $action = 'log';
    }
}
$time = filter_input(INPUT_POST, 'time');
if($time == NULL)
{
    $time = filter_input(INPUT_GET, 'time');
    if ($time == NULL)
    {
        $time = 'all';
    }
}


// switch to deliver correct view.

switch ($action)
{
    case 'log':
        {
            // deliver login page without processing it.
            include 'view/login.php';
            break;
        }
    case 'LOGIN':
        {
            // get name and password. Validate input. Check to see if name and password match database.
            // if yes, save name to session variable, and deliver home view.
            // if no, display error message and deliver login view.

            //get name and password
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // check for empty fields
            if (empty($name) || empty($password)) {
                $message = "Please fill in all fields";
                include 'view/login.php';
                break;
            }



        // check for existing name

        $match = checkName($name, $password, $db);

            if (!empty($match))
            {
                // success. Matching name in database.
                setcookie('name', $name);
                $cookieName = $name;
                include 'view/home.php';
                break;
            } else {
                $message = "The username or password do not match our records.<br> Please try again or register a new account.<br>";
                include 'view/login.php';
                $message = "";
                break;
            }

        }

    case 'home':
        {

            include 'view/home.php';
            break;
        }
    case 'view':
        {
            $title = "";
            $trailList = getTrails($db);
            $trailSelect = buildTrailSelect($trailList);


            switch ($time) {
                case 'all':
                    {
                        $title = "$cookieName's Rides";
                        $rideList = getRides($cookieName, $db);
                        break;
                    }
                case 'seven':
                    {
                        $title = "Rides This Week";
                        $rideList = getRidesWeek($cookieName, $db);
                        break;
                    }
                case 'thirty':
                    {
                        $title = "Rides This Month";
                        $rideList = getRidesMonth($cookieName, $db);
                        break;
                    }

                case 'trail':
                    {
                        // add dropdown list of trails, then search by trail.
                        break;
                    }
            }

            $arrayList = buildRideDisplay($rideList);
            $list1 = "$arrayList[0]";
            $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
            include 'view/viewRides.php';
            break;

        }

    case 'byDate':
        {
            $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
            $endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
            $trailList = getTrails($db);
            $trailSelect = buildTrailSelect($trailList);

            if (!empty($startDate) || !empty($endDate)) {
                $sd = strtotime($startDate);
                $ed = strtotime($endDate);
                if ($sd > $ed) {
                    $message = "Start date must be before end date.";
                    include "view/viewRides.php";
                    echo '<script type="text/javascript">unhide();</script>';
                    break;
                } else {
                    $message = "";
                    $title = "Rides between $startDate and $endDate";
                    $rideList = getRidesByDate($cookieName, $startDate, $endDate, $db);
                    $arrayList = buildRideDisplay($rideList);
                    $list1 = "$arrayList[0]";
                    $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                    include 'view/viewRides.php';
                    break;
                }
            } else {
                $message = "Please enter dates in each field.";
                include 'view/viewRides.php';
                break;

            }
            include 'view/viewRides.php';
            break;
        }

    case 'trail':
        {
            $trailList = getTrails($db);
            $trailSelect = buildTrailSelect($trailList);
            $trail = filter_input(INPUT_POST, 'trail', FILTER_SANITIZE_STRING);
            $message = "";
            if (!empty($trail)) {

                $rideList = getRidesByTrail($cookieName, $trail, $db);
                $arrayList = buildRideDisplay($rideList);
                $title = "Rides on trail:<br> $arrayList[4]";
                $list1 = "$arrayList[0]";
                $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                include 'view/viewRides.php';
                break;
            } else {
                $message = "Please select a trail.";
                include 'view/viewRides.php';
                echo '<script type="text/javascript">unhide2();</script>';
                break;
            }
        }
    case 'individual':
        {
            if (empty($time)) {
                $message = "Error loading individual Ride. Try again.";
                include "view/viewRides.php";
                break;
            } else {
                $rideList = getIndividualRide($cookieName, $time, $db);
                $arrayList = buildRideDisplay($rideList);
                $title = "<h2>$arrayList[6]</h2>";
                $list1 = "<p>Date: $arrayList[5]<br>Trail: $arrayList[4]<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                include "view/viewRides.php";
                break;
            }

        }
    case 'addRide':
        {
            include 'view/comingSoon.php';
            break;
        }
    case 'addTrail':
        {
        include 'view/comingSoon.php';
        break;
        }
    case 'logout':
        {
            $_SESSION = array();
            session_abort();
            include "view/login.php";
            break;
        }

}






?>
