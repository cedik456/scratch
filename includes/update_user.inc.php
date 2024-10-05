<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "config_session.inc.php";
    require_once "db.inc.php";
    require_once "./model/student_model.inc.php"; 

    // Assuming the user_id is fetched from session as the user is already registered
    $user_id = $_SESSION['user_id']; 

    // Get input data
    $faculty_id = $_POST["faculty_id"];
    $fname = $_POST["fname"];
    $midname = $_POST["midname"];
    $lname = $_POST["lname"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // Check if password is being updated or left empty for no update

    try {
        // Update user information
        updateUser($pdo, $user_id, $faculty_id, $fname, $midname, $lname, $dob, $age);

        // Update user login information if a new password is provided
        if (!empty($password)) {
            updateUserLogin($pdo, $user_id, $username, $email, $password);
        } else {
            updateUserLogin($pdo, $user_id, $username, $email);
        }

        // Clear session data related to previous input
        unset($_SESSION['update_data']);

        // Redirect to a success page
        header("Location: ../index.php?update=success");  
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../update_profile.php");
    exit();
}
