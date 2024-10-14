<?php

// Start the session and include necessary files
require_once "./includes/db.inc.php"; // Database connection
require_once "./includes/config_session.inc.php"; // Session configuration
require_once "./includes/profile.inc.php" ;
require_once "./includes/update_students.php";


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
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/reset.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="#">
                <i class="uil uil-home"></i>
                <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="subs_dashboard.php">
                <i class="uil uil-subject"></i>
                <span>Subjects</span>
                </a>
            </li>
            <li>
                <a href="#">
                <i class="uil uil-chart-bar-alt"></i>
                <span>Statistics</span>
                </a>
            </li>
            <li>
                <a href="#">
                <i class="uil uil-suitcase"></i>
                <span>Careers</span>
                </a>
            </li>
            <li>
                <a href="profile.php">
                <i class="uil uil-user"></i>
                <span>Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                <i class="uil uil-setting"></i>
                <span>Settings</span>
                </a>
            </li>
            <li class="logout">
                <a href="index.php">
                <i class="uil uil-signout"></i>
                <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <!-- <span>Primary</span> -->
                <h2>Dashboard</h2>
            </div>

            <div class="user-info">
                <div class="search-box">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search">
                </div>

                <a href="profile.php"><img src="<?= htmlspecialchars('./includes/uploads/' . $profile_pic); ?>" alt="Profile Picture" class="profile-pic"></a>
            </div>
        </div>

        <div class="tabular-wrapper">
              <div class="subject-header">
                <h3 class="main-title">Student List</h3>
                <button class="add-button">Add Students</button>
            </div>
            <?php if (isset($_SESSION["errors_student"])): ?>
            <div class="error">
                <?php foreach ($_SESSION["errors_student"] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION["errors_student"]); ?>
            </div>
            <?php endif; ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Year Level</th>
                        <th></th>
                        <th>Show Subjects</th>
                    
                      
                        <tbody>
                        <?php if (count($students) > 0): ?>
                            <?php foreach ($students as $student): ?>
                        </tr>
                            <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['program_name']); ?></td>
                            <td><?php echo htmlspecialchars($student['year_level']); ?></td>
                           
                            <td>
                            <button id="editStudentButton" class="edit-button">Edit Student</button>    
                            <form action="./includes/delete_students.php" method="get" style="display:inline;">
                                <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this student?');" class="delete-button">Delete</button>
                            </form></td>
                            <td>
                            <a href="program_dashboard.php?program_id=<?php echo htmlspecialchars($student['program_id']); ?>">
                                <button class="subjects-button">View</button>
                            </a>
                        </td>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7">No students found.</td>
                            </tr>
                           <?php endif; ?>
                        </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Add Student</h2>
            <form action="./includes/students.inc.php" method="POST" id="addStudentForm">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div class="select-container">
                    <label for="program_id">Program:</label>
                    <select id="program_id" name="program_id" required>
                        <!-- Options will be populated dynamically from the database -->
                        <?php
                        // Fetch programs from the database and populate the options
                        $programsStmt = $pdo->query("SELECT program_id, program_name FROM Programs");
                        while ($program = $programsStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"" . htmlspecialchars($program['program_id']) . "\">" . htmlspecialchars($program['program_name']) . "</option>";
                        }
                        ?>
                    </select>
                    <label for="year_level">Year Level:</label>
                    <select id="year_level" name="year_level" required>
                        <option value="" selected disabled>Select year level</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>
                </div>
                <button type="submit">Add Student</button>
            </form>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="editStudentModal" class="modal">
        <div class="modal-content">
            <span class="close-buttons close-button">&times;</span>
            <h2>Edit Student</h2>
            <form action="./includes/update_students.php" method="POST" id="editStudentForm">
                <input type="hidden" name="student_id" value="<?= htmlspecialchars($student['student_id']); ?>">
                
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($student['first_name']); ?>" required>
                
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($student['last_name']); ?>" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>

                <!-- Program Dropdown -->
                <label for="program_id">Program:</label>
                <select id="program_id" name="program_id" required>
                    <?php
                    $programsStmt = $pdo->query("SELECT program_id, program_name FROM Programs");
                    while ($program = $programsStmt->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($student['program_id'] == $program['program_id']) ? 'selected' : '';
                        echo "<option value=\"" . htmlspecialchars($program['program_id']) . "\" $selected>" . htmlspecialchars($program['program_name']) . "</option>";
                    }
                    ?>
                </select>
                
                <!-- Year Level Dropdown -->
                <label for="year_level">Year Level:</label>
                    <select id="year_level" name="year_level" required>
                        <option value="" selected disabled>Select year level</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                    </select>

                <button type="submit">Update Student</button>
            </form>
        </div>

    
    <script src="./js/modal.js"></script>
    <script src="./js/modal_students.js"></script>
</body>
</html>