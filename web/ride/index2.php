<?php

/*
* Controller for Ride keeper app
*/

// Create or access a session
session_start();

// Get the database connetion file
include_once('../../dbconnect.php');

// get user name from session if set. Store in variable.
if (isset($_COOKIE['name'])) {
    $cookieName = filter_input(INPUT_COOKIE, 'name', FILTER_SANITIZE_STRING);
}

// get input on which page to display. If no input, display login page.
$action = filter_input(INPUT_POST, 'action');
if($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'log';
    }
}


// switch to deliver correct view.

switch ($action) {
    case 'log':
        // deliver login page without processing it.
        include 'view/login.php';
        break;

    case 'LOGIN':
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
       $db = dbconnect();
       $stmt = $db->prepare('SELECT rider_name FROM rider WHERE rider_name=:name');
       $stmt->bindValue(':rider_name, $name, PDO::PARAM_STR');
       $stmt->execute();
       $match = $stmt->fetch(PDO::FETCH_NUM);
       $stmt->closeCursor();
       if(empty(!$match)) {
           echo "Success!";
       } else {
           echo "No Match";
       }
}





?>


