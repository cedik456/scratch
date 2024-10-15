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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Fetch new data from form submission
    $fname = $_POST["fname"];
    $midname = $_POST["midname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $username = $_POST["username"]; // Possibly updating username
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    
    // Fetch password if updating password
    $new_password = $_POST["new_password"]; // Leave empty if password change is not required

    try {
        // Include DB connection file
        require_once 'db.inc.php';

        // Update `Users` table
        $updateUsersSQL = "UPDATE Users SET 
            fname = ?, 
            midname = ?, 
            lname = ?, 
            dob = ?, 
            age = ?
            WHERE user_id = ?";


        $stmtUsers = $pdo->prepare($updateUsersSQL);
        $stmtUsers->execute([$fname, $midname, $lname, $dob, $age, $user_id]);

        // Update `Userlogins` table (if username, email, or password are being changed)
        $updateLoginsSQL = "UPDATE UserLogins SET 
            username = ?, 
            email = ?";
        
        $paramsLogins = [$username, $email];
        
        // Check if the password is being updated
        if (!empty($new_password)) {
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
            $updateLoginsSQL .= ", password = ?";
            $paramsLogins[] = $hashedPassword;
        }

        $updateLoginsSQL .= " WHERE user_id = ?";
        $paramsLogins[] = $user_id;

        $stmtLogins = $pdo->prepare($updateLoginsSQL);
        $stmtLogins->execute($paramsLogins);

        // If the username was updated, update it in the session too
        if ($_SESSION["user_username"] !== $username) {
            $_SESSION["user_username"] = htmlspecialchars($username);
        }

        // Redirect back to profile/dashboard or success page
        header("Location: ../index.php?update=success");
        exit();

    } catch (PDOException $e) {
        // Handle query errors
        die("Update Failed: " . $e->getMessage());
    }

} else {
    // If accessed without POST request, redirect to update form
    header("Location: ../update_user.php");
    exit();
}
?>
