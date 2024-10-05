<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/view/signup_view.inc.php";
require_once "./includes/view/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>

    <form action="./includes/login.inc.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Submit</button>
    </form>

    <a href="signup.php"><button>No account? Signup</button></a>
    
    <?php
    checkLoginErrors();
    ?>

</body>
</html>

