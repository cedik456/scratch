<?php
   require_once "./includes/config_session.inc.php";
   require_once "./includes/db.inc.php"; // Database connection
    
   // Assuming the user_id is stored in session
   $user_id = $_SESSION['current_user_id'];

   $query = "SELECT Users.fname, Users.midname, Users.lname, UserLogins.email, Users.profile_pic   
              FROM Users
              INNER JOIN UserLogins ON Users.user_id = UserLogins.user_id
              WHERE Users.user_id = :user_id";

   // Prepare and execute the query
   $stmt = $pdo->prepare($query);
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
   $stmt->execute();

   // Fetch and display the result for the current user
   $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

   // Check if data exist
   $full_name = $user_data['fname'] . ' ' . $user_data['midname'] . ' ' . $user_data['lname'] ?? 'No Name Found';
   $email = $user_data['email'] ?? 'No Email Found';
   $profile_pic = $user_data['profile_pic'] ?? './assets/image.webp'; // Default image if not set
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="./css/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="./css/reset.css"> <!-- Link to your CSS file -->
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
            <li class="active">
                <a href="#">
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
                <h2>Profile</h2>
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
            <div class="update-profile-container"> 
                <div class="profile-details">
                    <h3 class="main-title">Update Profile</h3>
                        
                        <?php
                        
                        // Display any error messages
                        if (isset($_SESSION["errors_update"])) {
                            foreach ($_SESSION["errors_update"] as $error) {
                                echo "<p class='error'>$error</p>";
                            }
                            unset($_SESSION["errors_update"]); // Clear errors after displaying
                        }
                
                        // Retrieve previous input data from session
                        $updateData = $_SESSION['update_data'] ?? [];
                        ?>
                
                        <form action="./includes/update_user.inc.php" method="POST">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($userData['fname']); ?>" required autocomplete="off">
                
                            <label for="midname">Middle Name</label>
                            <input type="text" id="midname" name="midname" value="<?php echo htmlspecialchars($userData['midname']); ?>" autocomplete="off">
                
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($userData['lname']); ?>" required autocomplete="off">
                
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($loginData['email']); ?>" required autocomplete="off">
                
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($loginData['username']); ?>" required autocomplete="off">
                
                            <label for="dob">Date of Birth</label>
                            <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($userData['dob']); ?>" required autocomplete="off">
                
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($userData['age']); ?>" required autocomplete="off">
                
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password">
                
                            <button>Update Profile</button>
                        </form>
                </div>

                <div class="profile-pic-container">
                <a href="#"><img src="<?= htmlspecialchars('./includes/uploads/' . $profile_pic); ?>" alt="Profile Picture" class="profile-pic"></a>
                    <div class="profile-pic-details">
                    <h2> <?= htmlspecialchars($full_name); ?></h2>
                    <p> <?= htmlspecialchars($email); ?></p>
                    </div>

                    <div class="profile-pic-form">
                        <form action="./includes/upload.inc.php" method="POST" enctype="multipart/form-data">

                        <input type="file" name="my_image">

                        <input type="submit" name="submit" value="upload">
                        <?php if (isset($_GET['error'])): ?>
                        <p><?php echo $_GET['error']; ?></p>
                        <?php endif ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        
    </div>


    <script src="./js/calculate_age.js"></script>
    <script src="./js/generate_faculty_id.js"></script>
</body>
</html>
