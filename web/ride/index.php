<?php
  include_once ('../../dbconnect.php');

  $rideListQuery = $db->query('SELECT ride_name FROM public.ride;');
  $rideListQuery = $db->execute();
  $rideList = $rideListQuery->fetchAll(PDO::FETCH_NUM);

  function flattenList($item) { return $item[0]; }

  $rideList = array_map("flattenBook", $bookList);
  ?>

<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
Login page where user logs in or creates new account
Will include fields for username and password, login button, and register button. -->

<html lang="en-us">
<head>
    <title>Ride Keeper Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">
</head>
<body>
<header>
    <div class="center">
        <img class="logo" src="images/recyclery.png" alt="recyclery logo">
        <a href='index.php?action=logout' class='button1'>Log Out</a>"
    </div>
</header>
<main>
    <div class="center">
        <h1>Ride Keeper</h1>
        <h2>View Rides</h2>
        <?php
        foreach ($rideList as $ride) {
            echo "<a href='rideDetail.php?item=$ride'>$ride</a>";
        }
        ?>
        <a class="button1" href="index.php?action=byTrail">View By Trail</a>
        <a class="button1" href="index.php?action=byDate">View By Date</a>
        <a class="button1" href="index.php?action=thirtyDays">Last 30 Days</a>
        <a class="button1" href="index.php?action=sevenDays">Last 7 Days</a>

    </div>
</main>
</body>
</html>
