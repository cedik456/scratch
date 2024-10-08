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
        require_once "./model/student_model.inc.php"; 
        require_once "./controller/student_controller.inc.php"; 
    
        require_once "config_session.inc.php"; 

        $user_id = $_SESSION['current_user_id'];
        // ERROR HANDLERS
        $errors = [];  

        if (isInputEmpty($user_id, $first_name, $last_name, $email, $program_id, $year_level)) {

            $errors["empty_input"] = "Fill in all fields";
        }


        if ($errors) {
            $_SESSION["errors_student"] = $errors;

            header("Location: ../students_form.php");
            die();
        }


        addStudent($pdo, $user_id, $first_name, $last_name, $email, $program_id, $year_level); 
        
        header("Location: ../main_dashboard.php");

        $pdo = null;
        $stmt = null;
        
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../students_form.php");
    die();
}
?>
