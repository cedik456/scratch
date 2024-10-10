<?php

// Start the session and include necessary files
require_once "./includes/db.inc.php"; // Database connection
require_once "./includes/config_session.inc.php"; // Session configuration
require_once "./includes/profile.inc.php" ;


// Check if the user is logged in
if (!isset($_SESSION['current_user_id'])) {
    header("Location: ../signup.php");
    die();
}

// Fetch subjects from the database
try {
    // Modify the SQL statement to join the Programs table
    $stmt = $pdo->prepare("
        SELECT Subjects.*, Programs.program_name 
        FROM Subjects 
        JOIN Programs ON Subjects.program_id = Programs.program_id
    ");
    $stmt->execute();

    // Fetch all subjects with program names
    $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/reset.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="main_dashboard.php">
                <i class="uil uil-home"></i>
                <span>Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="#">
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
                <h2>Subjects</h2>
            </div>

            <div class="user-info">
                <div class="search-box">
                    <i class="uil uil-search"></i>
                    <input type="search" placeholder="Search">
                </div>

                <a href="#"><img src="<?= htmlspecialchars('./includes/uploads/' . $profile_pic); ?>" alt="Profile Picture" class="profile-pic"></a>
            </div>
        </div>

        <div class="tabular-wrapper">
            <div class="subject-header">
                <h3 class="main-title">Subject List</h3>
                <button class="add-button">Add Subject</button>
            </div>
            <?php if (isset($_SESSION["errors_subject"])): ?>
            <div class="error">
                <?php foreach ($_SESSION["errors_subject"] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION["errors_subject"]); ?>
            </div>
            <?php endif; ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Course Code</th>
                            <th>Details</th>
                            <th>Laboratory</th>
                            <th>Units</th>
                            <th>Prerequisite</th>
                            <th>Program</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (count($subjects) > 0): ?>
                        <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['name']); ?></td>
                            <td><?php echo htmlspecialchars($subject['course_code']); ?></td>
                            <td><?php echo htmlspecialchars($subject['sub_detail']); ?></td>
                            <td><?php echo htmlspecialchars($subject['laboratory']); ?></td>
                            <td><?php echo htmlspecialchars($subject['units']); ?></td>
                            <td><?php echo htmlspecialchars($subject['prerequisite']); ?></td>
                            <td><?php echo htmlspecialchars($subject['program_name']); ?></td>
                            <td>
                                <!-- <button class="edit-button">Edit</button> -->
                                <form action="./includes/delete_subs.php" method="get" style="display:inline;">
                                    <input type="hidden" name="subject_id" value="<?php echo htmlspecialchars($subject['subject_id']); ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this subject?');" class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No subjects found.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="addSubjectModal" class="modal">
        <div class="modal-content modal-content-subs">
        <span class="close-button">&times;</span>
            <h2>Add Subject</h2>
            <form action="./includes/subjects.inc.php" method="post">
                
                <label for="name">Subject Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="course_code">Course Code:</label>
                <input type="text" id="course_code" name="course_code" required>
                
                <label for="sub_detail">Details:</label>
                <input type="text" id="sub_detail" name="sub_detail" required>
                
                <label for="laboratory">Laboratory:</label>
                <input type="text" id="laboratory" name="laboratory" required>
                
                <label for="units">Units:</label>
                <input type="number" id="units" name="units" required>
                
                <label for="prerequisite">Prerequisite:</label>
                <input type="text" id="prerequisite" name="prerequisite">
                
                <div class="select-container-subs">
                <label for="program_name">Select Program:</label>
                <select name="program_name" id="program_name">
                    <option value="BSIT">BSIT</option>
                    <option value="BSCS">BSCS</option>
                    <!-- Add more programs as needed -->
                </select>
                </div>

                <button type="submit">Add Subject</button>
            </form>
        </div>
    </div>
    
    <script src="./js/modalsubs.js"></script>
</body>
</html>
