<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
<main>
    <h1>Sign In</h1>
    <div>
        <form name="login" method="post" action=".">
            <input type="hidden" name="action" value="login"/>
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $username ?>" required>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
            <!--<p><a href="index.php?action=logout">Logout</a></p>-->
        </form>
    </div>
    <div>
        <p><?php echo $message ?></p>
    </div>
</main>
<hr>
<section>
    <input type="button" onClick="window.location.href='signup.php'"  value="Sign Up">
</section>
</body>
</html>