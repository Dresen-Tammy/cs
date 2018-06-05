<?php
session_start();

if (!isset($_SESSION['valid_user'])) {
    header('Location: index.php');
    die();
}

if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    session_unset();
    header('Location: index.php');
    die();
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Homepage</title>
</head>
<body>
<h1>Welcome <?php if(isset($_SESSION['username'])) {echo $_SESSION['username']; } ?></h1>
<form action="home.php" method="post">
    <input type="hidden" name="logout" value="logout">
    <input type="submit" value="logout">
</form>
<hr>

<?php
echo '<pre><p>$_SESSION</p>';
print_r($_SESSION);
echo '</pre>';
?>
<hr>
</body>
</body>
</html>