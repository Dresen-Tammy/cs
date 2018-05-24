<?php
$name = 'John';
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
          <a class="button1" href='index.php?action=logout' class='button1'>Log Out</a>
      </div>
  </header>
  <main>
      <div class="center">
          <h1>RideKeeper</h1>
          <h2>Hello <?php echo $cookieName; ?>, Welcome to RideKeeper</h2>
          <a class="button1" href="index.php?action=view&time=all">View Rides</a>
          <a class="button1" href="index.php?action=addRide">Add a Ride</a>
          <a class="button1" href="index.php?action=addTrail">Add a Trail</a>
      </div>
  </main>
  </body>
</html>