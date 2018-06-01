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
      <title>Ride Keeper Login</title>
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

          <?php if (isset($message)) {echo $message;} ?>
          <h2>Add a Ride</h2>
          <form action="index.php" method="post">
              <fieldset>
                  <legend>* Required Fields</legend>
                  <label for="rideName" class="label">Ride Name</label>
                  <input class="address" type="text" name="rideName" value="<?php if (isset($rideName)) {echo $rideName;}?>"><span class="error"></span><br>
                  <label for="date" class="label">Ride Date</label>
                  <input class="address" type="date" name="date" value="<?php if (isset($date)) {echo $date;}?>" required><span class="error">*</span><br>
                  <label for="rideName" class="label">Ride Length</label>
                  Hours <input class="hours" type="number" name="hours" max='23' min='0' value="<?php if (isset($hours)) {echo $hours;}?>" required >
                  Minutes <input class="hours" type="number" name="minutes" max='59' min='0' value="<?php if (isset($minutes)) {echo $minutes;}?>" required ><span class="error">*</span><br>
                  <label for="trail" class="label">Trail Name</label>
                  <select class='select' onchange='changeTrail()' id="selectTrail" name='trail'>
                  <?php if(isset($trailSelect)) {echo $trailSelect;} ?>
                  </select><span class="error">*</span><br>
                  <fieldset class="noShow" id="setTrailInfo">
                      <legend>New Trail Information</legend>
                      <label for="trailName" class="label" >Trail Name</label>
                      <input class="address" type="text" name="trailName" id="locationInput" value="<?php if (isset($trailName)) {echo $trailName;}?>"><span class="error">*</span><br>
                      <label for="location" class="label" >Start Location</label>
                      <input class="address" type="text" name="location" id="locationInput" value="<?php if (isset($location)) {echo $location;}?>"><span class="error">*</span><br>
                      <label for="distance" class="label" >Distance (miles)</label>
                      <input class="address" type="text" name="distance" id="distanceInput" value="<?php if (isset($distance)) {echo $distance;}?>"><span class="error">*</span><br>
                      <label for="elevation" class="label">Elevation Gain</label>
                      <input class="address" type="text" name="elevation" id="elevationInput" value="<?php if (isset($elevation)) {echo $elevation;}?>"><span class="error">*</span><br>
                  </fieldset>
                  <ul id="trailInfo" class="trailInfo"></ul>
                  <input type="submit" class="button1 button4" value="Add Ride">
                  <input type="hidden" name="action" value="addRide">
                  </fieldset>


          </form>


      </div>
  </main>
  </body>
</html>