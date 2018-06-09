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
      <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
      <script src="js/ride.js"></script>

  </head>
  <body>
    <?php include 'templates/header.php'; ?>
  <main>
      <div class="center">

          <?php if(isset($message)) { echo $message;} ?>


          <div class="rideList">
          <h2> <?php if (isset($title)) { echo $title; }?></h2>



              <?php if(isset($list1)) {echo $list1;} ?>
              <?php if (isset($arrayList)) {echo "Duration: " . $arrayList[3]->format('%h:%I') . " hours";} ?>

              <div class="buttons" id="buttons">
                  <?php if(isset($deleteButton)) {echo $deleteButton . "<br>";}
                  if (isset($editButton)) {echo $editButton . "<br>";}
                  if (isset($backButton)) {echo $backButton . "<br>";}
                  if (isset($buttonList)) {echo $buttonList . "<br>";}

                  ?>



              </div>
          </div>
          <!-- display by trail form -->
          <form class="popup hide" id="trailList" method="post" action="index.php">
              <h2>Choose Trail</h2><span onclick="hideForm2()" class="exit"></span>
              <?php if(isset($message)) { echo $message;}
               if(isset($trailChoose)) {echo $trailChoose;}
                ?>

              <input type="submit" class="button1" onclick="hideForm2" value="Enter">
              <input type="hidden" name="action" value="trail">
          </form>
          <!-- display by date form -->
          <form class="popup hide" id="dateForm" method="post" action="index.php">
            <h2>Enter Start/End Dates</h2><span class="exit" onclick="hideForm()"></span>
              <?php if(isset($message)) { echo $message;} ?>
              <label for="startDate" class="label">Start Date</label>
              <input type="date" name="startDate" class="address">
              <label for="endDate" class="label">End Date</label>
              <input type="date" name="endDate" class="address">
              <input type="submit" class="button1"  onclick="hideForm()" value="Submit">
              <input type="hidden" name="action" value="byDate">
          </form>
          <!-- edit ride form -->
          <form class="popup hide" id="editRide" method="post" action="index.php">
              <h2>Edit Ride</h2><span onclick="hideForm4()" class="exit"></span>
              <fieldset>
                  <legend>* Required Fields</legend>
                  <label for="rideName" class="label">Ride Name</label>
                  <input class="address" type="text" name="rideName" id="editName" value="<?php if (isset($arrayList)) {echo $arrayList[6];}?>"><span class="error"></span><br>
                  <label for="date" class="label">Ride Date</label>
                  <input class="address" type="date" name="date" id="editDate" value="<?php if (isset($arrayList)) {echo $arrayList[8];}?>" required><span class="error">*</span><br>


                  <label for="trail" class="label">Trail Name</label>
                  <select class='select' id="selectTrail2" name='trail' >
                      <?php if(isset($trailSelect)) {echo $trailSelect;} ?>
                  </select><span class="error">*</span><br>

                  <a class="button1 button4" onclick="editRide()">Edit Ride</a>

                  <input type="hidden" id="selectChoice" value="<?php echo $arrayList[7]; ?>">
                  <input type="hidden" id="rideId" value="<?php echo $time; ?>">

              </fieldset>
          </form>




      </div>
  </main>
  </body>
</html>