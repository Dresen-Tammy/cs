<?php
include_once('dbconnect.php');
include_once ('functions.php');




session_start();
// get user name from session if set. Store in variable.
$sessionName;
if (isset($_SESSION['name'])) {
    $sessionName = $_SESSION['name'];
}

// get input on which page to display. If no input, display login page.
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'log';
        }
    }
    $time = filter_input(INPUT_POST, 'time');
    if ($time == NULL) {
        $time = filter_input(INPUT_GET, 'time');
        if ($time == NULL) {
            $time = 'all';
        }
    }



// switch to deliver correct view.

    switch ($action) {

        // login page without processing.
        case 'log':
            {
                // deliver login page without processing it.
                include 'view/login.php';
                exit();
                break;
            }

        // Login with processing
        case 'login':
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
                    exit();
                }


                 //check for existing name
                $clientData = checkName($name, $db);
                if (!$clientData) {
                    $message = "The username or password do not match our records.<br> Please try again or register a new account.<br>";
                    include 'view/login.php';
                    $message = "";
                    exit();
                } else { // if user exists, check passwords for match

                    $hashCheck = password_verify($password, $clientData['password']);
                     //if hashes don't match, create error and return to login view


                    if ($hashCheck) {
                        // success. Matching name and password. login
                        $_SESSION['loggedin'] = TRUE;

                        $_SESSION['name'] = $clientData['rider_name'];
                        $sessionName = $_SESSION['name'];
                        // create and display add ride view
                        $trailList = getTrails($db);
                        $trailSelect = buildTrailAddNew($trailList);
                        include 'view/home.php';
                        exit();
                    } else {
                        $message = "The username or password do not match our records.<br> Please try again or register a new account.<br>";
                        include 'view/login.php';
                        $message = "";
                        exit();
                    }
                }
                    break;
            }

        // Register New Account
        case 'register':
            {
                // get name and password. Validate input. Check to see if name and password match database.
                // if no, add to database, save name to session variable, and deliver home view.
                // if yes, display error message and deliver login view.
                if (!empty($_POST)) {
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $passwordCheck = filter_input(INPUT_POST, 'passwordCheck', FILTER_SANITIZE_STRING);

                    if (empty($name) || empty($password) || empty($passwordCheck)) {
                        // check for empty fields. If yes, return with error message
                        $message = 'Please fill in all fields<br>';

                    } elseif ($password != $passwordCheck) {
                        $message = "Passwords don't match<br>";

                    } elseif (checkUser($name, $db) == 1) {// if no empty fields, check to see if user is already in database.
                        // if name already in database, return error
                        $message = "There is already a user with that name. Login or register with another name.<br>";

                    } elseif (!passwordPattern($password)) {
                        $message = "Password must be at least 8 characters with at least 1 number.<br>";

                    } else { // if not, then hash password and register user for account
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                        $registered = createUser($name, $passwordHash, $db);
                        if ($registered == 0) { // check to see if registration worked. If not return error
                            $message = 'There was an error with your registration. Please try again.';

                        } else { // if it worked, deliver message to login.
                            //success
                            $message = "Thank you for registering, $name.  Please use your username and password to login.<br>";
                            include 'view/login.php';
                            exit();

                            }
                        }
                    }

                    include 'view/register.php';
                echo '<script type="text/javascript">loadEvents();</script>';
                    exit();
                    break;

            }

        case 'reset':
            {
                if (isset($_POST)) {
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
                    $newPassword = filter_input(INPUT_POST, 'newPassword', FILTER_SANITIZE_STRING);
                    if (empty($password) || empty($newPassword)) {
                        $message = "Please fill in all fields.<br>";

                    } else {

                        $clientData = checkName($sessionName, $db);


;                        $hashCheck = password_verify($password, $clientData['password']);
                        if (!$hashCheck) {
                            
                            $message = "Current password didn't match records.<br>";
                            include 'view/updatePassword.php';
                            exit();
                        } else {

                            $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                            $updated = updatePassword($passwordHash, $sessionName, $db);

                            if ($updated = 1) {
                                $message = "Password updated successfully.<br>";

                            } else {
                                $message = "Error updating password. Please try again.";
                            }

                        }
                    }
                }

                include 'view/updatePassword.php';
                exit();
                break;
        }
        // deliver home page
        case 'home':
            {
                // create and display add ride view
                $trailList = getTrails($db);
                $trailSelect = buildTrailAddNew($trailList);
                include 'view/home.php';
                exit();
                break;
            }

        // show list of rides
        case 'view':
            {
                $deleteButton = "";
                $title = "";
                $trailList = getTrails($db);
                $trailChoose = buildTrailSelect($trailList);
                $sessionName = $_SESSION['name'];

                switch ($time) {
                    case 'all':
                        {   // show all rides for person
                            $title = "$sessionName's Rides";
                            $rideList = getRides($sessionName, $db);
                            break;
                        }
                    case 'seven':
                        {   // show last week of rides
                            $title = "Rides This Week";
                            $rideList = getRidesWeek($sessionName, $db);
                            break;
                        }
                    case 'thirty':
                        {   // show last month of rides
                            $title = "Rides This Month";
                            $rideList = getRidesMonth($sessionName, $db);
                            break;
                        }

                }
                $buttonList = "<a class=\"button2 button3\" href=\"index.php?action=addRide\">Add New Ride</a><br>
                  <a class=\"button2\" onclick=\"unhide2()\">View By Trail</a><br>
                  <a class=\"button2\" onclick=\"unhide()\">View By Date</a><br>
                  <a class=\"button2\" href=\"index.php?action=view&time=seven\">Last 7 Days</a><br>
                  <a class=\"button2\" href=\"index.php?action=view&time=thirty\">Last 30 Days</a><br>";
                $arrayList = buildRideDisplay($rideList, $time);
                $list1 = "$arrayList[0]";
                $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";

                include 'view/viewRides.php';
                exit();
                break;

            }

        // show list of rides between date range
        case 'byDate':
            {
                $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_STRING);
                if ($startDate == NULL) {
                    $startDate = filter_input(INPUT_GET, 'startDate', FILTER_SANITIZE_STRING);
                }
                $endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_STRING);
                if ($endDate == NULL) {
                    $endDate = filter_input(INPUT_GET, 'endDate', FILTER_SANITIZE_STRING);
                }
                $buttonList = "<a class=\"button2 button3\" href=\"index.php?action=addRide\">Add New Ride</a><br>
                  <a class=\"button2\" onclick=\"unhide2()\">View By Trail</a><br>
                  <a class=\"button2\" onclick=\"unhide()\">View By Date</a><br>
                  <a class=\"button2\" href=\"index.php?action=view&time=seven\">Last 7 Days</a><br>
                  <a class=\"button2\" href=\"index.php?action=view&time=thirty\">Last 30 Days</a><br>";

                $trailList = getTrails($db);
                $trailChoose = buildTrailSelect($trailList);

                if (!empty($startDate) || !empty($endDate)) {
                    $sd = strtotime($startDate);
                    $ed = strtotime($endDate);
                    if ($sd > $ed) {
                        $message = "Start date must be before end date.";
                        include "view/viewRides.php";
                        echo '<script type="text/javascript">unhide();</script>';
                        exit();
                    } else {
                        $message = "";
                        $title = "Rides from <br>" . date('F d, Y', strtotime($startDate)) . " to " . date('F d, Y', strtotime($endDate));
                        $rideList = getRidesByDate($sessionName, $startDate, $endDate, $db);
                        $arrayList = buildRideDisplay($rideList, 'byDate', "", $startDate, $endDate);
                        $list1 = "$arrayList[0]";
                        $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                        include 'view/viewRides.php';
                        exit();
                    }
                } else {
                    $message = "Please enter dates in each field.";
                    include 'view/viewRides.php';
                    exit();

                }
                include 'view/viewRides.php';
                exit();
                break;
            }

        // show list of rides by trail
        case 'trail':
            {
                $trailList = getTrails($db);
                $trailChoose = buildTrailSelect($trailList);
                $trail = filter_input(INPUT_POST, 'trail', FILTER_SANITIZE_STRING);
                if ($trail == NULL) {
                    $trail = filter_input(INPUT_GET, 'trail', FILTER_SANITIZE_STRING);
                }
                $message = "";
                if (!empty($trail)) {

                    $rideList = getRidesByTrail($sessionName, $trail, $db);
                    $arrayList = buildRideDisplay($rideList, 'trail', $trail);
                    $title = "Rides on trail:<br> $arrayList[4]";
                    $list1 = "$arrayList[0]";
                    $list1 .= "<p>Totals:<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                    $buttonList = "<a class=\"button2 button3\" href=\"index.php?action=addRide\">Add New Ride</a><br>";
                    $buttonList .= "<a class=\"button2\" onclick=\"unhide2()\">View By Trail</a><br>";
                    $buttonList .= "<a class=\"button2\" onclick=\"unhide()\">View By Date</a><br>";
                    $buttonList .= "<a class=\"button2\" href=\"index.php?action=view&time=seven\">Last 7 Days</a><br>";
                    $buttonList .= "<a class=\"button2\" href=\"index.php?action=view&time=thirty\">Last 30 Days</a><br>";
                    include 'view/viewRides.php';
                    exit();
                } else {
                    $message = "Please select a trail.";
                    $buttonList = "<a class=\"button2 button3\" href=\"index.php?action=addRide\">Add New Ride</a><br>";
                    $buttonList .= "<a class=\"button2\" onclick=\"unhide2()\">View By Trail</a><br>";
                  $buttonList .= "<a class=\"button2\" onclick=\"unhide()\">View By Date</a><br>";
                  $buttonList .= "<a class=\"button2\" href=\"index.php?action=view&time=seven\">Last 7 Days</a><br>";
                  $buttonList .= "<a class=\"button2\" href=\"index.php?action=view&time=thirty\">Last 30 Days</a><br>";

                    include 'view/viewRides.php';
                    echo '<script type="text/javascript">unhide2();</script>';
                    exit();

                }
                break;
            }



        // display individual ride
        case 'individual':
            {
                if (empty($time)) {
                    $message = "Error loading individual Ride. Try again.";
                    include "view/viewRides.php";
                    exit();
                } else {

                    $back = filter_input(INPUT_GET, 'back', FILTER_SANITIZE_STRING);
                    $trail = filter_input(INPUT_GET, 'trail', FILTER_SANITIZE_STRING);
                    $startDate = filter_input(INPUT_GET, 'startDate', FILTER_SANITIZE_STRING);
                    $endDate = filter_input(INPUT_GET, 'endDate', FILTER_SANITIZE_STRING);
                    $trailList = getTrails($db);
                    $trailChoose = buildTrailSelect($trailList);
                    $trailSelect = buildTrailAddNew($trailList);
                    $rideList = getIndividualRide($sessionName, $time, $db);
                    $arrayList = buildRideDisplay($rideList, $back);
                    $title = "<h2 id='title'>$arrayList[6]</h2>";
                    $list1 = "<p id='listDate'>Date: $arrayList[5]</p><p id='listTrail'>Trail: $arrayList[4]</p><p id='listDistance'>Distance: $arrayList[1] miles</p><p id='listElevation'> Elevation Gain: $arrayList[2] feet</p>";
                    $deleteButton = "<a href='index.php?action=delete&time=$time' class='button2 button3'>Delete Ride</a>";
                    // create back button. May need to go back to trail, all, date, week, month, individual
                    if ($back == 'trail') {
                        $backButton = "<a href='index.php?action=trail&trail=$trail' class='button2 button3'>Back</a>";
                    } elseif ($back == 'byDate') {
                        $backButton = "<a href='index.php?action=byDate&startDate=$startDate&endDate=$endDate' class='button2 button3'>Back</a>";
                    } else {
                        $backButton = "<a href='index.php?action=view&time=$back' class='button2 button3'>Back</a>";
                    }
                    $editButton = "<a class='button2 button3' onclick='unhide4()'>Edit Ride</a><br>";
                    include "view/viewRides.php";
                    exit();
                    break;
                }

            }
        // update ride and display individual ride.
        case 'updateRideDisplay':
            {
                // get information about the ride that is being edited and
                //add it too the add ride page. Then get the input from the user
                //and update the database.
                if (empty($time)) {
                    $message = "There was an error retrieving the information. Please try again.<br>";
                    include "view/viewRides.php";
                    exit();
                } else {
                    //get information about which ride and deliver add ride page.
                    $message = "";
                    $trailList = getTrails($db);
                    $trailChoose = buildTrailAddNew($trailList);
                    $rideList = getIndividualRide($sessionName, $time, $db);
                    $rideName = $rideList['ride_name'];
                    $date = $rideList['ride_date'];
                    $duration = $rideList['ride_name'];
                    $hours = $rideList['ride_name'];
                    $minutes = $rideList['ride_name'];
                    $trail = $rideList['ride_name'];
                    $trailName = $rideList['ride_name'];
                    $deleteButton = "<a href='index.php?action=delete&time=$time' class='button2 button3'>Delete Ride</a>";
                    // create back button. May need to go back to trail, all, date, week, month, individual
                    if ($action = all) {
                        $backButton = "<a href='index.php?action=$action' class='button2 button3'>Back</a>";
                    }
                }
            }
        // add ride to database and display individual ride
        case 'addRide':
            {
                // create and display add ride view
                $message = "";
                $trailList = getTrails($db);
                $trailSelect = buildTrailAddNew($trailList);
                $rideName = filter_input(INPUT_POST, 'rideName', FILTER_SANITIZE_STRING);
                $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
                $hours = filter_input(INPUT_POST, 'hours', FILTER_SANITIZE_STRING);
                $minutes = filter_input(INPUT_POST, 'minutes', FILTER_SANITIZE_NUMBER_INT);
                $trail = filter_input(INPUT_POST, 'trail', FILTER_SANITIZE_NUMBER_INT);
                $trailName = filter_input(INPUT_POST, 'trailName', FILTER_SANITIZE_STRING);
                $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
                $distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_STRING);
                $elevation = filter_input(INPUT_POST, 'elevation', FILTER_SANITIZE_STRING);

                if (empty($rideName)) { // if ride name empty, fill it in.
                    $rideName = "Unnamed Ride";
                }
                if (empty($rideName) || empty($date) || empty($hours) || empty($minutes) || empty($trail)) {
                    // if main fields are empty, return error.
                    $message = "Please fill in all required fields.<br>";
                    include 'view/home.php';
                    if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                    exit();
                } else if ($hours < 0 || $hours > 23 || $minutes < 0 || $minutes > 59) {
                    // if hours and minutes don't make a valid time, return error.
                    $message = "Hours must between 0 - 23, and minutes must be between 0 - 59.<br>";
                    include "view/home.php";
                    if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                    exit();
                } else { // if all inputs to this point are correct, continue
                    if ($trail == -1) { // check to see if new trail is being entered, if yes:
                        if (empty($trailName) || empty($location) || empty($distance) || empty($elevation)) {
                            // if trail fields are empty, return error;
                            $message = "Please fill in all required fields.<br>";
                            include 'view/home.php';
                            if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                            exit();
                        } else { // if all fields are filled, check trail to see if already in db
                                $result = checkTrail($trailName, $db);
                                if ($result == 1) {
                                    $message = "This trail name is already in database. Use that trail or choose another name.<br>";
                                    include "view/home.php";
                                    if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                                    exit();
                                } else { // not in database
                                    $added = addTrail($trailName, $location, $distance, $elevation, $db);
                                    if (empty($added)) { // insert trail failed
                                        $message = "Sorry, there was a problem adding the trail to the database. Please try again.<br>";
                                        include 'view/home.php';
                                        if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                                        exit();
                                    } else { // successfully added
                                        $trail = $added;
                                        $message = "Trail added successfully";
                                    }
                            }
                        }


                    }
                    // add ride
                    $duration = $hours . " hours " . $minutes . " minutes";
                    $addedRide = addRide($rideName, $sessionName, $trail, $date, $duration, $db);
                    if ($addedRide > 0) {

                        // display new ride

                        $rideList = getIndividualRide($sessionName, $addedRide, $db);
                        $arrayList = buildRideDisplay($rideList);
                        $title = "<h2>$arrayList[6]</h2>";
                        $list1 = "<p>Date: $arrayList[5]<br>Trail: $arrayList[4]<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                        $deleteButton = "<a href='index.php?action=delete&time=$addedRide' class='button2 button3'>Delete Ride</a>";

                        // create back button. May need to go back to trail, all, date, week, month, individual

                        $backButton = "<a href='index.php?action=view&time=all' class='button2 button3'>Back</a>";

                        $editButton = "<a class='button2 button3' onclick='unhide4()'>Edit Ride</a><br>";
                        include "view/viewRides.php";
                        exit();
                    }
                    else { // failure
                        $message = "There was a problem adding the ride to the database. Please try again.";
                        include 'view/home.php';
                        if ($trail == -1) {echo '<script type="text/javascript">noShow();</script>'; }
                        exit();
                    }
                }
                break;

            }
        case 'addTrail':
            {
                // get post variables

                if (!empty($_POST)) {
                    $trailName = filter_input(INPUT_POST, 'trailName', FILTER_SANITIZE_STRING);
                    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
                    $distance = filter_input(INPUT_POST, 'distance', FILTER_SANITIZE_NUMBER_INT);
                    $elevation = filter_input(INPUT_POST, 'elevation', FILTER_SANITIZE_NUMBER_INT);

                    if (empty($trailName) || empty($location) || empty($distance) || empty($elevation)) {
                        // if empty fields, return error
                        $message = "Please fill in all fields.<br>";
                        include 'view/addTrail.php';

                        exit();
                    } else { // if not empty, check to see if trail is in database.
                        $check = checkTrail($trailName, $db);
                        if ($check > 0) { //trail is in database already
                            $message = "There is already a trail with that name. Choose a different name.<br>";
                            include 'view/addTrail.php';
                            exit();
                        } else  {// not already in db, add trail to db
                            $result = addTrail($trailName, $location, $distance, $elevation, $db);
                            if ($result == 0) { // check to see if added to database. if not return error
                                $message = "Error adding trail. Please try again.<br>";
                                include 'view/addTrail.php';
                                exit();
                            } else { // trail was added to database, success message, new trail list.
                                $message = "$trailName was successfully added to trails.<br>";

                            }

                        }
                    }
                }
                $title = "Add Ride";
                $trailList = getTrails($db);
                $trailDisplay = buildTrailDisplay($trailList);
                include 'view/addTrail.php';
                exit();
                break;
            }

        // display individual trail information
        case 'oneTrail':
            {  // get stats on individual trail, get all rides on that trail for that rider, create display, deliver page
                $trailInfo = getOneTrail($time, $db);
                $rideInfo = getRidesByTrail($sessionName, $time, $db);
                $oneTrail = buildOneTrail($trailInfo);
                $rideDisplay = buildRideDisplay($rideInfo);
                include 'view/viewTrail.php';
                exit();
                break;
            }

        // delete ride
        case 'delete':
            {
                $deleted = deleteRide($time, $sessionName, $db);
                if($deleted == 1) {
                    // success
                    $title = "Successfully deleted ride.";
                    include "view/viewRides.php";
                    break;
                } else {
                    $message = "There was an error deleting ride. Try again.";
                    $rideList = getIndividualRide($sessionName, $time, $db);
                    $arrayList = buildRideDisplay($rideList);
                    $title = "<h2>$arrayList[6]</h2>";
                    $list1 = "<p>Date: $arrayList[5]<br>Trail: $arrayList[4]<br>Distance: $arrayList[1] miles<br> Elevation Gain: $arrayList[2] feet<br>";
                    $deleteButton = "<a href='index.php?action=delete&time=$time' class='button2 button3'>Delete Ride</a>";
                    include "view/viewRides.php";
                    exit();

                }
                break;
            }

        // logout of session and deliver login page
        case 'logout':
            {
                $_SESSION = array();
                session_destroy();
                include "view/login.php";
                exit();
                break;
            }

    }

    ?>
