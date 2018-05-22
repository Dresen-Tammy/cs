<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
List of items to add to cart and purchase.
Button or link to add item to cart
Clicking button will store item in session, return to browseItem page  -->
<html lang="en-us">
  <head>
    <title>CheckOut</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">

</head>
  <body>

    <header>
        <div class="center">
        <img class="logo" src="images/recyclery.png" alt="recyclery logo">


        <a  href="index.php?action=cart" class="button1">RETURN TO CART</a>
      </div>
    </header>
    <main>
      <div class="center">
        <h1>Checkout</h1>
        <?php
          echo "<p>Total Cost: $<span>$price</span></p>"

        ?>
        <form method="post" action="index.php">
          <fieldset>
          </legend class="error">* required field</legend><br>
          <?php if (isset($error)) {echo $error;} ?>
          <label for name class="label">Street Address:</label>
          <input class="address" type="text" name="street" value="<?php echo $street;?>" required><span class="error">*</span><br>
          <label for name class="label">City:</label>
          <input class="address" type="text" name="city" value="<?php echo $city;?>" required><span class="error" >*</span><br>
          <label for name class="label">State:</label>
          <input class="address" type="text" name="state" value="<?php echo $state;?>" required><span class="error">*</span><br>
          <label for name class="label">ZIP Code:</label>
          <input class="address" type="number" name="zip" value="<?php echo $zip;?>" required><span class="error">*</span><br>
          <input  class="button1" type="submit" name="submit" value="COMPLETE PURCHASE">
          <input type="hidden" name="action" value="confirm">
        </fieldset>
      </form>
    </div>
  </main>

  </body>
  </html>
