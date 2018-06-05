<?php

require('dbconnect.php');
require('functions.php');

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordCheck'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    echo "submitted";
    if ($password == $passwordCheck) {
        echo 'equal';
        if (checkPassword($password)) {
            echo 'regex';
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            echo 'hashed';
            addUser($username, $passwordHash);

            header('Location: home.php');
            die();
        } else {
            echo 'regexerror';
            $message = "<span style='color:red'>Password needs to be at least 7 characters and at least 1 number.</span>";
        }
    } else {
        echo 'matcherror';
        $message = "<span style='color:red'>Password does not match.</span>";
    }
} else {
    echo "clear message";
    $message = '';
}

function checkPassword($password)
{
    $pattern = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$/';
    return preg_match($pattern, $password);
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <script>
        function validate() {
            if(document.getElementById('p2').value != document.getElementById('p1').value) {
                alert("Passwords don't match");
                return false;
            }
        }
    </script>
</head>
<body>
<main>
    <h1>Sign Up</h1>
    <div>
        <form name="sign-up" method="post" action="signup.php">
            <input type="hidden" name="action" value="signup"/>
            <label for="username">Username</label><input  type="text" name="username" value="<?php if(isset($_POST['username'])) { echo $_POST['username'];} ?>" required>
            <label for="password">Password</label><input id="p1" type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$" required>
            <label for="passwordCheck">Password (Again)</label><input id="p2" type="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{7,}$" name="passwordCheck" required>

            <input type="submit" value="Sign Up">

            <!--<p><a href="index.php?action=logout">Logout</a></p>-->
        </form>
    </div>
    <div>
        <p><?php echo $message ?></p>
    </div>
</main>
<hr>
<section>
    <input type="button" onClick="window.location.href='login.php'" value="Back">
</section>
</body>
</html>