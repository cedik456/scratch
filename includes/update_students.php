<?php
require_once "./includes/db.inc.php";

// Check if the PDO connection is established
if (!isset($pdo)) {
    die("Database connection not established.");
}

// Check if a student ID is provided (for pre-filling values)
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch the current student data from the database
    try {
        $stmt = $pdo->prepare("SELECT * FROM Students WHERE student_id = :student_id");
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the student data
        $student = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$student) {
            die("Student not found.");
        }
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
    

// Check if the form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and trim white spaces
    $student_id = $_POST['student_id'];
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $program_id = $_POST['program_id'];
    $year_level = $_POST['year_level'];

    // Validate inputs (e.g., email format, non-empty names, etc.)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    if (empty($first_name) || empty($last_name)) {
        die("First name and Last name cannot be empty.");
    }

    // Update the student record in the database
    try {
        $stmt = $pdo->prepare("
            UPDATE Students
            SET first_name = :first_name, last_name = :last_name, email = :email, 
                program_id = :program_id, year_level = :year_level
            WHERE student_id = :student_id
        ");
        // Bind parameters
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':program_id', $program_id, PDO::PARAM_INT);
        $stmt->bindParam(':year_level', $year_level, PDO::PARAM_INT);  // Updated for proper type
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);

        // Execute the update
        $stmt->execute();

        // Redirect back to dashboard with success message
        header("Location: ./main_dashboard.php?success=Profile updated successfully");
        die();
    } catch (PDOException $e) {
        // If there's an error, output the message
        die("Update failed: " . $e->getMessage());
    }
}
?>
