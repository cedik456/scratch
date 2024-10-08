<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/view/student_view.inc.php";
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
                <li><a href="students_dashboard.php">Students</a></li>
                <li><a href="#">Subjects</a></li>
                <li><a href="update_user.php">Edit profile</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
    <h1>Add Students</h1>
    <button id="openModal">Add Student</button>

    <!-- Modal Structure -->
    <div id="studentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Student</h2>
            <form action="./includes/students.inc.php" method="POST" enctype="multipart/form-data">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" autocomplete="off" required>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" autocomplete="off" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" autocomplete="off" required>

                <label for="program_id">Course:</label>
                <select name="program_id" required>
                    <option value="" selected disabled>Select a program</option>
                    <option value="1">BSIT</option>
                    <option value="2">BSCS</option>
                </select>

                <label for="year_level">Year Level:</label>
                <select id="year_level" name="year_level" required>
                    <option value="" selected disabled>Select year level</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
                
                <?php checkSignupErrors(); ?>
                <button type="submit">Add</button>
            </form>
        </div>
    </div>
        
    </div>
    <script src="./js/modal.js"></script>
</body>
</html>
