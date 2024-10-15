<?php
// Start session to access user data
require_once 'config_session.inc.php';

// Ensure user is logged in by checking if `current_user_id` is set
if (!isset($_SESSION["current_user_id"])) {
    header("Location: ../login.php"); // Redirect if user is not logged in
    exit();
}

// Fetch the user_id from the session
$user_id = $_SESSION["current_user_id"];

try {
    // Include DB connection file
    require_once 'db.inc.php';

    // Prepare SELECT query to fetch user data
    $selectUserSQL = "SELECT u.fname, u.midname, u.lname, u.dob, u.age, ul.username, ul.email 
                      FROM Users u
                      JOIN UserLogins ul ON u.user_id = ul.user_id
                      WHERE u.user_id = ?";

    $stmt = $pdo->prepare($selectUserSQL);
    $stmt->execute([$user_id]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return user data as an associative array for form pre-filling
    return $userData;

} catch (PDOException $e) {
    // Handle query errors
    die("Failed to fetch user data: " . $e->getMessage());
}

