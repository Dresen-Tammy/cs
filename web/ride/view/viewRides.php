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
    <?php include 'templates/header.php'; ?>
  <main>
      <div class="center">

          <?php if(isset($message)) { echo $message;} ?>


          <div class="rideList">
          <h2> <?php if (isset($title)) { echo $title; }?></h2>
          <?php


          if(isset($list1)) {echo $list1;
          echo "Duration: " . $arrayList[3]->format('%h:%I') . " hours</p>";}
            ?>
              <div class="buttons" id="buttons">
                  <a class="button2" href="index.php?action=addRide">Add New Ride</a><br>
                  <a class="button2" onclick="unhide2()">View By Trail</a><br>
                  <a class="button2" onclick="unhide()">View By Date</a><br>
                  <a class="button2" href="index.php?action=view&time=seven">Last 7 Days</a><br>
                  <a class="button2" href="index.php?action=view&time=thirty">Last 30 Days</a><br>
                  <?php if(isset($deleteButton)) {echo $deleteButton;} ?>

              </div>
          </div>

          <form class="popup hide" id="trailList" method="post" action="index.php">
              <h2>Choose Trail</h2>
              <?php if(isset($message)) { echo $message;}
               if(isset($trailChoose)) {echo $trailChoose;}
                ?>

              <input type="submit" class="button1" onclick="hideForm2" value="Enter">
              <input type="hidden" name="action" value="trail">
          </form>
          <form class="popup hide" id="dateForm" method="post" action="index.php">
            <h2>Enter Start and End Dates</h2>
              <?php if(isset($message)) { echo $message;} ?>
              <label for="startDate" class="label">Start Date</label>
              <input type="date" name="startDate" class="address">
              <label for="endDate" class="label">End Date</label>
              <input type="date" name="endDate" class="address">
              <input type="submit" class="button1"  onclick="hideForm()" value="Submit">
              <input type="hidden" name="action" value="byDate">
          </form>




      </div>
  </main>
  </body>
</html>