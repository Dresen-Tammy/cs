<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
List of items to add to cart and purchase.
Button or link to add item to cart
Clicking button will store item in session, return to browseItem page  -->
<html lang="en-us">
  <head>
    <title>Browse</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">
</head>

<body>
  <header>
    <div class="center">
        <img class="logo" src="images/recyclery.png" alt="recyclery logo">
        <a  href="index.php?action=cart" class="button1">CART <span><?php if (isset($sessionCart)) {
               echo count($sessionCart); }
               else {
                 echo "0";}  ?></span></a>
    </div>
  </header>
  <main>
    <div class="center">
      <h1>Cycling Gear</h1>
      <?php
        if (isset($browseList)) {
        echo $browseList;
      }

        ?>
      <a  href="index.php?action=cart" class="button1">Go to Cart</a>
    </div>
  </main>

</body>
</html>
