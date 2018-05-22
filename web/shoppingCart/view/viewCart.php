<html lang="en-us">
  <head>
    <title>Cart</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">

</head>
  <body>

    <header>
        <div class="center">
        <img class="logo" src="images/recyclery.png" alt="recyclery logo">

        <a  href="index.php?action=browse" class="button1">CONTINUE SHOPPING</a>

      </div>
    </header>
    <main>
        <div class="center">
        <h1>Cart</h1>
        <?php
        if (isset($browseList2)) {
        echo $browseList2;
      }
        ?>
        <p class='total'>Total Price:  <span class="price p">$<?php echo $price; ?></span></p>
        <a  href="index.php?action=checkout" class="button1">CHECKOUT</a>
      </div>
    </main>
  </body>
</html>
