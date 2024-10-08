
<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/view/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
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
                <li><a href="students_dashboard.php">Students</a></li>
                <li><a href="subjects.php">Subjects</a></li>
                <li><a href="update_user.php">Edit profile</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
        <div class="welcome">
            <p>Hello, <?php echo htmlspecialchars($_SESSION["user_username"]); ?>!</p>
            <p>Your user ID is: <?php echo htmlspecialchars($_SESSION["current_user_id"]); ?></p>
        </div>
        
        <?php
        outputUsername();
        ?>
    
        <form action="./includes/logout.inc.php" method="POST">
            <button type="submit" class="logout">Logout</button>
        </form>
    </div>
</body>
</html>
