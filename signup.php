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
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    
    <div class="container">
        <span class="title">Registration</span>
        <form action="./includes/signup.inc.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Faculty Id</span>
                    <input type="text" id="faculty_id" name="faculty_id" readonly placeholder="Faculty ID" required>
                </div>
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" id="fname" name="fname" autocomplete="off" placeholder="First name" required>
                </div>
                <div class="input-box">
                    <span class="details">Middle Name</span>
                    <input type="text" id="midname" name="midname" autocomplete="off" placeholder="Middle name" required>
                </div>
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" id="lname" name="lname" autocomplete="off" placeholder="Last name" required>
                </div>
                <div class="input-box">
                    <span class="details">Date</span>
                    <input type="date" id="dob" name="dob" autocomplete="off" required>
                </div>
                <div class="input-box">
                    <span class="details">Age</span>
                    <input type="text" id="age" name="age" autocomplete="off" placeholder="Age" readonly required>
                </div>
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" id="username" name="username" autocomplete="off" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" id="email" name="email" autocomplete="off" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
            </div>

            <div class="button">
                <button type="submit">Sign up</button>
            </div>

            <div class="text">
                <a href="index.php">Already have an account?</a>
            </div>
        </form>
            <?php
            checkSignupErrors();
            ?>


    </div>
    
    <script src="./js/calculate_age.js"></script>
    <script src="./js/generate_faculty_id.js"></script>
    
</body>
</html>