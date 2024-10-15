<?php
require_once "./includes/db.inc.php"; // Database connection
require_once "./includes/profile.inc.php" ;


// Check if program_id is set in the query parameters
if (isset($_GET['program_id'])) {
    $program_id = $_GET['program_id'];

    try {
        // Prepare SQL statement to fetch subjects by program_id
        $stmt = $pdo->prepare("
            SELECT * FROM Subjects WHERE program_id = :program_id
        ");
        $stmt->bindParam(':program_id', $program_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch all subjects
        $subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    $subjects = []; // No subjects if program_id is not set
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
                <a href="./includes/logout.inc.php">
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
                <h2>Programs</h2>
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
                <!-- <h3 class="main-title">BSIT</h3> -->
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
                        <th>Course Code</th>
                        <th>Subject ID</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Laboratory</th>
                        <th>Units</th>
                        <th>Prerequisite</th>
                        
                        <tbody>
                    <?php if (count($subjects) > 0): ?>
                        <?php foreach ($subjects as $subject): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($subject['course_code']); ?></td>
                                <td><?php echo htmlspecialchars($subject['subject_id']); ?></td>
                                <td><?php echo htmlspecialchars($subject['name']); ?></td>
                                <td><?php echo htmlspecialchars($subject['sub_detail']); ?></td>
                                <td><?php echo htmlspecialchars($subject['laboratory']); ?></td>
                                <td><?php echo htmlspecialchars($subject['units']); ?></td>
                                <td><?php echo htmlspecialchars($subject['prerequisite']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No subjects found for this program.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
    <script src="./js/modal.js"></script>
</body>
</html>


