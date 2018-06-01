<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
Login page where user logs in or creates new account
Will include fields for username and password, login button, and register button. -->

<html lang="en-us">
<head>
    <title>Ride Keeper Individual Trail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">
    <script src="js/ride.js"></script>
</head>
<body>
<header>
    <div class="center">
        <img class="logo" src="images/recyclery.png" alt="recyclery logo">
        <h1>RideKeeper</h1>
    </div>
</header>
<nav>
    <div class="center">
        <ul class="navUl">
            <li><a class="nav" href="index.php?action=view&time=all">Rides</a></li>
            <li><a class="nav" href="index.php?action=addTrail">Trails</a></li>
            <li><a class='nav' href='index.php?action=logout'>Log Out</a></li>
        </ul>
    </div>
</nav>
<main>
    <div class="center">
        <div class="rideList">

            <?php


            if(isset($oneTrail)) {echo $oneTrail;}
            echo "<h2>Rides on trail</h2>";
            if(isset($rideDisplay)) {echo $rideDisplay[0];}
            ?>
        </div>
    </div>
</main>
</body>
</html>