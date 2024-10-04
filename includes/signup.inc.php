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
        require_once "./model/signup_model.inc.php";
        require_once "./controller/signup_contr.inc.php";

        //ERROR HANDLERS
        $errors = [];  

        if (isInputEmpty($faculty_id, $fname, $lname, $dob, $age, $username, $email, $password)) {

            $errors["empty_input"] = "Fill in all fields";

        } else {

            if (isEmailInvalid($email)) {
                $errors["invalid_email"] = "The email is invalid";
            }
    
            if (isUsernameTaken($pdo, $username)) {
                $errors["username_taken"] = "The username is already taken";
            }
    
            if (isEmailRegistered($pdo, $email)) {
                $errors["email_used"] = "This email is already registered";
            }
        }

        require_once "config_session.inc.php"; // session start by using the config file

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "fname" => $fname,
                "midname" => $midname,
                "lname" => $lname,
                "dob" => $dob,
                "age" => $age,
                "email" => $email,
                "username" => $username
            ];

            $_SESSION['signup_data'] = $signupData;

            header("Location: ../signup.php");
            die();
        }

        $user_id = createUser($pdo, $faculty_id, $fname, $midname, $lname, $dob, $age);    
        createUserLogin($pdo, $user_id, $username, $email, $password);

        unset($_SESSION['signup_data']);
        unset($_SESSION['errors_signup']);

        header("Location: ../index.php?signup=success");  
        
        $pdo = null;
        $stmt = null;
        
        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
   

} else {
    header("Location: ../signup.php");
    die();
}