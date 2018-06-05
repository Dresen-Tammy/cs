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
    <title>Ride Keeper Registration</title>
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
<nav class="nav">
</nav>

<main>
    <div class="center">

        <h2>Register</h2>
        <form method="post" action="index.php">
            <fieldset>
                <legend class="error">* required field</legend>
                <?php if (isset($message)) {echo $message;} ?>
                <label for="name" class="label">Name</label>
                <input class="address" type="text" name="name" value="<?php if(isset($name)) {echo $name;} ?>" required><span class="error">*</span><br>

                <label for="password" class="label">Password</label>
                <input class="address" type="password" name="password" id="pass1"  required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"><span class="error">*</span><br>
                <label for="passwordCheck" class="label">Repeat Password</label>
                <input class="address" type="password" name="passwordCheck" id="pass2"  required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"><span class="error" >*</span><br>
                <p class="pwd"> Password must have 8 characters including at least 1 number.</p>
                <input class=" button1 button4 disabled" id="regButton" type="submit" value="REGISTER">
                <input type="hidden" name="action" value="register">
                <a class="button4 b5" href="index.php?action=log">LOGIN</a>



            </fieldset>
        </form>
    </div>
</main>
<script src="js/register.js"></script>
</body>
