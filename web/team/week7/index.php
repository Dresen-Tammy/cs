<?php

session_start();

require('dbconnect.php');
require('functions.php');


$_SESSION['username'];

if (!isset($_SESSION['valid_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = user($username);

    if (password_verify($password, $user['password'])) {
        validateLogin($username, $password);
        $_SESSION['valid_user'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $username;

        header('Location: home.php');
        die();
    } elseif (isset($username) || isset($password)) {
        $message = "<span style='color:red'>Invalid username or password</span>";
        include('login.php');
    } else {
        $message = 'You must login to continue.';
        include('login.php');
    }
} else {
    header('Location: home.php');
}
