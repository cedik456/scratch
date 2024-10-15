<?php
// Start the session and include necessary files
require_once "db.inc.php"; // Database connection
require_once "config_session.inc.php"; // Session configuration

// Check if the user is logged in
if (!isset($_SESSION['current_user_id'])) {
    header("Location: ../login.php");
    die();
}

// Check if the student_id is set in the GET request
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    try {
        // Prepare the DELETE SQL statement
        $stmt = $pdo->prepare("DELETE FROM Students WHERE student_id = :student_id AND user_id = :user_id");
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['current_user_id'], PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['delete_success'] = "Student record deleted successfully.";
        } else {
            $_SESSION['delete_error'] = "Failed to delete student record.";
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    $_SESSION['delete_error'] = "Invalid student ID.";
}

// Redirect to the students display page
header("Location: ../main_dashboard.php");
die();
?>
