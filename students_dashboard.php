<?php

// Start the session and include necessary files
require_once "./includes/db.inc.php"; // Database connection
require_once "./includes/config_session.inc.php"; // Session configuration

// Check if the user is logged in
if (!isset($_SESSION['current_user_id'])) {
    header("Location: ../signup.php");
    die();
}

// Fetch students from the database
try {
    // Modify the SQL statement to join the Programs table
    $stmt = $pdo->prepare("
        SELECT Students.*, Programs.program_name 
        FROM Students 
        JOIN Programs ON Students.program_id = Programs.program_id 
        WHERE Students.user_id = :user_id
    ");
    $stmt->bindParam(':user_id', $_SESSION['current_user_id'], PDO::PARAM_INT);
    $stmt->execute();

    // Fetch all students with program names
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students List</title>
    <link rel="stylesheet" href="./css/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="./css/reset.css">
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

        <h1>Students List</h1>
        <?php if (isset($_SESSION["errors_student"])): ?>
            <div class="error">
                <?php foreach ($_SESSION["errors_student"] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION["errors_student"]); ?>
            </div>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Program</th>
                    <th>Year Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (count($students) > 0): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['email']); ?></td>
                        <td><?php echo htmlspecialchars($student['program_name']); ?></td>
                        <td><?php echo htmlspecialchars($student['year_level']); ?></td>
                        <td>
                            <form action="./includes/delete_students.php" method="get" style="display:inline;">
                                <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No students found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>
        <a href="students_form.php">Add New Student</a> <!-- Link to add new students -->
    </div>
</body>
</html>
