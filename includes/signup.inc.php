<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $faculty_id = $_POST["faculty_id"];
    $fname = $_POST["fname"];
    $midname = $_POST["midname"];
    $lname = $_POST["lname"];
    $dob = $_POST["dob"];
    $age = $_POST["age"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    try {
        
        require_once "db.inc.php";
        require_once "signup_model.inc.php";
        require_once "signup_contr.inc.php";

        //ERROR HANDLERS
        $errors = [];

        if (isInputEmpty($faculty_id, $fname, $lname, $dob, $age, $username, $email, $password)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        if (isEmailInvalid($email)) {
            $errors["invalid_email"] = "The email is invalid";
        }

        if (isUsernameTaken($pdo, $username)) {
            $errors["username_taken"] = "The username is already taken";
        }

        if (isEmailRegistered($pdo, $email)) {
            $errors["email_registered"] = "This email is already registered";
        }

        require_once "config_session.inc.php"; // session start by using the config file

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../index.php");
            die();
        }
        

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
   

} else {
    header("Location: ../index.php");
    die();
}