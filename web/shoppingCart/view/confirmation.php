<head>
  <title>Confirm</title>
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
      <h1>Confirmation</h1>
      <p>Congratulations! You have purchased:</p>
      <?php
      if (isset($browseList2)) {
      echo $browseList2;
    }
    echo "<p class='total'>Total Cost: $<span>$price</span></p>";
    echo "<p>Your purchases will be sent to:</p>";
    echo "<p>$street<br>";
    echo "<p>$city, $state $zip</p>";
      ?>
    </div>
  </main>

</body>
</html>
