<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!-- Tammy Dresen, CS313,
Update password page. -->

<html lang="en-us">
<head>
    <title>Ride Keeper Update</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/cart.css" type="text/css" rel="stylesheet">
</head>
<body>
    <?php include('templates/header.php'); ?>
<main>
    <div class="center">

        <h2>Reset Password</h2>
        <form method="post" action="index.php">
            <fieldset>
                <legend class="error">* required field</legend>
                <?php if (isset($message)) {echo $message;} ?>
               <label for="password" class="label">Old Password</label>
                <input class="address" type="text" name="password" required><span class="error">*</span><br>
                <label for="newPassword" class="label">New Password</label>
                <input class="address" type="newPassword" name="newPassword" required><span class="error">*</span><br>
                <input class="button1 button4" type="submit" value="RESET Password">
                <input type="hidden" name="action" value="reset";




            </fieldset>
        </form>
    </div>
</main>
</body>
</html>