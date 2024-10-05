<?php
require_once "./includes/config_session.inc.php";
// require_once "./includes/view/student_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="./css/reset.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Update Profile</h2>
        
        <?php
        
        // Display any error messages
        if (isset($_SESSION["errors_update"])) {
            foreach ($_SESSION["errors_update"] as $error) {
                echo "<p class='error'>$error</p>";
            }
            unset($_SESSION["errors_update"]); // Clear errors after displaying
        }

        // Retrieve previous input data from session
        $updateData = $_SESSION['update_data'] ?? [];
        ?>

        <form action="./includes/update_user.inc.php" method="POST"> <!-- Replace 'your_php_file.php' with your actual PHP handling file -->
            <label for="faculty_id">Faculty ID:</label>
            <input type="text" id="faculty_id" name="faculty_id" value="<?= htmlspecialchars($updateData['faculty_id'] ?? '') ?>" required>

            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($updateData['fname'] ?? '') ?>" required>

            <label for="midname">Middle Name:</label>
            <input type="text" id="midname" name="midname" value="<?= htmlspecialchars($updateData['midname'] ?? '') ?>">

            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($updateData['lname'] ?? '') ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($updateData['dob'] ?? '') ?>" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($updateData['age'] ?? '') ?>" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($updateData['username'] ?? '') ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($updateData['email'] ?? '') ?>" required>

            <label for="password">Password (leave blank if not changing):</label>
            <input type="password" id="password" name="password">

            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script src="./js/calculate_age.js"></script>
    <script src="./js/generate_faculty_id.js"></script>
</body>
</html>
