<?php
require_once 'config_session.inc.php'; // Ensure session is started

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $course_code = $_POST['course_code'];
    $sub_detail = $_POST['sub_detail'];
    $laboratory = $_POST['laboratory'];
    $units = $_POST['units'];  // Fixed: added 'units' and 'prerequisite'
    $prerequisite = $_POST['prerequisite'];
    $program_name = $_POST['program_name'];

    try {
        require_once "db.inc.php";
        require_once "./model/subject_model.inc.php"; 
        require_once "./controller/subject_contr.inc.php"; 
    
    
        $user_id = $_SESSION['current_user_id'];  // Get user ID from session
        
        $errors = [];  

        // Function to check if inputs are empty (add it if not yet defined)
        if (isInputEmpty($name, $course_code, $sub_detail, $laboratory, $units, $prerequisite)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        if ($errors) {
            $_SESSION["errors_student"] = $errors;
            header("Location: ../students_form.php");
            die();
        }

        // Fetch program_id from Programs table
        $stmt = $pdo->prepare("SELECT program_id FROM Programs WHERE program_name = :program_name");
        $stmt->execute([':program_name' => $program_name]);
        $program_id = $stmt->fetchColumn();

        if (!$program_id) {
            $_SESSION["errors_student"] = ["program_error" => "Program not found"];
            header("Location: ../subs_dashboard.php");
            die();
        }

        

        if (!$program_id) {
            $_SESSION["errors_student"] = ["program_error" => "Program not found"];
            header("Location: ../subs_dashboard.php");
            die();
        }

        // Add subject with program_id
        addSubject($pdo, $name, $course_code, $sub_detail, $laboratory, $units, $prerequisite, $program_id);

        header("Location: ../subs_dashboard.php");
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../main_dashboard.php");
    die();
}
?>
