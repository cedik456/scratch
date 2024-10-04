<?php
require_once "./includes/config_session.inc.php";
// require_once "./includes/view/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="./css/reset.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <div class="logo">
            <h1>DWCL</h1>
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="students_form.php">Add Students</a></li>
                <li><a href="#">Add Subjects</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Student Registration Form</h1>
        <form action="./includes/students.inc.php" method="POST" enctype="multipart/form-data">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
    
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>
    
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
    
            <!-- <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required> -->
    
            <label for="program_id">Program ID:</label>
            <input type="number" id="program_id" name="program_id" required>
    
            <label for="year_level">Year Level:</label>
            <select id="year_level" name="year_level" required>
                <option value="">Select Year Level</option>
                <option value="1st Year">1st Year</option>
                <option value="2nd Year">2nd Year</option>
                <option value="3rd Year">3rd Year</option>
                <option value="4th Year">4th Year</option>
            </select>
    
            <button type="submit">Add</button>
        </form>
        
    </div>
</body>
</html>
