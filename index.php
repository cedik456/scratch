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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>

    <div class="container">
        <div class="form">
            <div class="form login">
                <span class="title">Login</span>

                <form action="./includes/login.inc.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Enter your username" required autocomplete="off">
                        <i class="uil uil-envelope icon"></i>
                    </div>

                    <div class="input-field">
                        <input type="password" name="password" placeholder="Enter your password" required autocomplete="off">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <!-- <button type="submit">Submit</button> -->

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        
                         <button type="submit" class="button">Submit</button>

                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?</span>
                    <a href="signup.php" class="text signup-text">Sign up now</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    checkLoginErrors();
    ?>

</body>
</html>

