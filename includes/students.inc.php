<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data using POST
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $program_id = $_POST['program_id'];
    $year_level = $_POST['year_level'];

    try {

        require_once "db.inc.php";
        require_once "./model/student_model.inc.php"; // should be students model
        require_once "./controller/student_controller.inc.php"; // students controller 
    
        //ERROR HANDLERS
        // $errors = [];  

        // if (isInputEmpty($first_name, $last_name, $email, $program_id, $year_level)) {

        //     $errors["empty_input"] = "Fill in all fields";

        // } else {

        //     if (isEmailInvalid($email)) {
        //         $errors["invalid_email"] = "The email is invalid";
        //     }
    
        //     if (isUsernameTaken($pdo, $username)) {
        //         $errors["username_taken"] = "The username is already taken";
        //     }
    
        //     if (isEmailRegistered($pdo, $email)) {
        //         $errors["email_used"] = "This email is already registered";
        //     }
        // }

        require_once "config_session.inc.php"; // session start by using the config file

        // if ($errors) {
        //     $_SESSION["errors_signup"] = $errors;

        //     $signupData = [
        //         "fname" => $fname,
        //         "midname" => $midname,
        //         "lname" => $lname,
        //         "dob" => $dob,
        //         "age" => $age,
        //         "email" => $email,
        //         "username" => $username
        //     ];

        //     $_SESSION['signup_data'] = $signupData;

        //     header("Location: ../signup.php");
        //     die();
        // }
    
        // Here you would typically insert the student data into the database
        // Example using PDO (assuming you have a PDO connection established)

        addStudent($pdo, $first_name, $last_name, $email, $program_id, $year_level); // gagawin palang
    
        // $pdo = new PDO('mysql:host=your_host;dbname=your_db', 'your_username', 'your_password');
        // $stmt = $pdo->prepare("INSERT INTO Students (first_name, last_name, email, profile_picture, program_id, year_level) VALUES (?, ?, ?, ?, ?, ?)");
        // $stmt->execute([$first_name, $last_name, $email, $profile_picture_name, $program_id, $year_level]);
    
        // Redirect or give feedback
        header("Location: ../students_form.php");
        exit;

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../students_form.php");
    die();
}
?>
