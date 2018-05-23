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
          <!-- if already logged in, add logout button. <if(isset($_SESSION['name']) { echo "<a href='index.php?action=logout' class='button1'>Log Out</a>" } -->
      </div>
  </header>
  <main>
      <div class="center">
          <h1>Ride Keeper</h1>
          <h2>Login</h2>
              <form method="post" action="index.php">
                  <fieldset>
                      <legend class="error">* required field</legend>
                      <?php if (isset($error)) {echo $error;} ?>
                      <label for="name" class="label">Name</label>
                      <input class="address" type="text" name="name" value="<?php echo $name;?>" required><span class="error">*</span><br>
                      <label for="password" class="label">Password</label>
                      <input class="address" type="text" name="password" required><span class="error">*</span><br>
                      <!-- <input class="button1" type="submit" name="action" value="REGISTER"> -->
                      <input class="button1" type="submit" name="action" value="LOGIN">


                  </fieldset>
              </form>
      </div>
  </main>
  </body>
</html>