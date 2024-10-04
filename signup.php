<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/view/signup_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">

        <h2>Sign Up</h2>
        <form action="./includes/signup.inc.php" method="POST">
    
            <?php
            signupInputs();
            ?>
    

            <button type="submit">Sign up</button>
        </form>
            <?php
            checkSignupErrors();
            ?>


    </div>
    
    <script src="./js/calculate_age.js"></script>
    <script src="./js/generate_faculty_id.js"></script>
    
</body>
</html>