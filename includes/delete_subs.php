<?php
// Start the session and include necessary files
require_once "db.inc.php"; // Database connection
require_once "config_session.inc.php"; // Session configuration

// Check if the user is logged in
if (!isset($_SESSION['current_user_id'])) {
    header("Location: ../login.php");
    die();
}

// Check if the subject_id is set in the GET request
if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];

    try {
        // Prepare the DELETE SQL statement
        $stmt = $pdo->prepare("DELETE FROM Subjects WHERE subject_id = :subject_id");
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        
        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['delete_success'] = "Subject record deleted successfully.";
        } else {
            $_SESSION['delete_error'] = "Failed to delete subject record.";
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    $_SESSION['delete_error'] = "Invalid subject ID.";
}

// Redirect to the subjects display page
header("Location: ../subs_dashboard.php");
die();

