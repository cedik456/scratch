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
        <form action="./includes/register.inc.php" method="POST">
    
            <label for="faculty_id">Faculty ID:</label>
            <input type="text" id="faculty_id" name="faculty_id" required readonly>
    
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" required>
    
            <label for="midname">Middle Name:</label>
            <input type="text" id="midname" name="midname" required>
    
            <label for="lname">Last name:</label>
            <input type="text" id="lname" name="lname" required>
    
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>
    
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required readonly>
    
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
    
            <input type="submit" value="Submit">
        </form>

        <?php
        check_signup_errors();// last left 
        ?>

    </div>
    
    <script src="./js/calculate_age.js"></script>
    <script src="./js/generate_faculty_id.js"></script>
    
</body>
</html>