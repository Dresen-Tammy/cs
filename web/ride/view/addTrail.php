<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
Add trail page. Display all trails, and have form to add another. -->

<html lang="en-us">
<head>
    <title>Ride Keeper Add trail</title>
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
        <h2>Trails</h2>
        <?php if (isset($trailDisplay)) {echo $trailDisplay;} ?>
        <a type="button" class="button1" onclick="unhide3()">Add A Trail</a>
        <div class="popup hide" id="trailForm">
        <h2>Enter New Trail Information</h2>
        <form method="post" action="index.php">

            <fieldset>
                <legend class="error">* required field</legend>
                <?php if (isset($message)) {echo $message;} ?>
                <label for="name" class="label">Trail Name</label>
                <input class="address" type="text" name="trailName" value="<?php if (isset($trailName)) {echo $trailName;}?>" required><span class="error">*</span><br>
                <label for="location" class="label">Start Location</label>
                <input class="address" type="text" name="location" value="<?php if (isset($location)) {echo $location;}?>" required><span class="error">*</span><br>
                <label for="distance" class="label">Distance (miles)</label>
                <input class="address" type="text" name="distance" value="<?php if (isset($distance)) {echo $distance;}?>" required><span class="error">*</span><br>
                <label for="elevation" class="label">Elevation Gain</label>
                <input class="address" type="text" name="elevation" value="<?php if (isset($elevation)) {echo $elevation;}?>" required><span class="error">*</span><br>
                <input class="button1" type="submit" name="action" value="Save Trail">
                <input type="hidden" name="action" value="addTrail">
            </fieldset>
        </form>
        </div>
    </div>
</main>
</body>
</html>