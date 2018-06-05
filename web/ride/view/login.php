<?php
  if (isset($_SESSION['loggedin'])) {
      header('Location: index.php?action=home');
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
  </head>
  <body>
  <header>
      <div class="center">
          <img class="logo" src="images/recyclery.png" alt="recyclery logo">
          <h1>RideKeeper</h1>
      </div>
  </header>
  <?php if (isset($_SESSION['loggedin'])) { echo "<nav>
      <div class='center'>
          <a class='settings' href='index.php?action=reset' title='settings'><img src='images/wheel.png' alt='settings'> </a>

          <ul class='navUl'>
              <li><a class='nav' href='index.php?action=view&time=all'>Rides</a></li>
              <li><a class='nav' href='index.php?action=addTrail'>Trails</a></li>
              <li><a class='nav' href='index.php?action=logout'>Log Out</a></li>
          </ul>
      </div>
  </nav>"; }  ?>

  <main>
      <div class="center">

          <h2>Login</h2>
              <form method="post" action="index.php">
                  <fieldset>
                      <legend class="error">* required field</legend>
                      <?php if (isset($message)) {echo $message;} ?>
                      <label for="name" class="label">Name</label>
                      <input class="address" type="text" name="name" required><span class="error">*</span><br>
                      <label for="password" class="label">Password</label>
                      <input class="address" type="password" name="password" required><span class="error">*</span><br>
                      <input class="button1 button4" type="submit" name="action" value="LOGIN">
                      <input class=" button4 b5" type="submit" name="action" value="REGISTER">




                  </fieldset>
              </form>
      </div>
  </main>
  </body>
</html>