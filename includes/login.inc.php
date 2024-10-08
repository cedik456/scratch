<?php

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
       
        require_once 'db.inc.php';
        require_once './model/login_model.inc.php';
        require_once './controller/login_contr.inc.php';


        // ERROR HANDLERS
        $errors = [];

        if (isInputEmpty($username, $password)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        $result = getUser($pdo, $username);

        if (isUsernameWrong($result)) {
            $errors["login_incorrect"] = "Invalid username and password!";
        }

        // Check orders!
        if (!isUsernameWrong($result) && isPasswordWrong($password, $result["password"])) {
            $errors["password_incorrect"] = "Invalid username and password!";
        }

        require_once 'config_session.inc.php'; // session start by using the config file

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["user_id"];
        session_id($sessionId);

        $_SESSION["current_user_id"] = $result["user_id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["last_regeneration"] = time();

        header("Location: ../main_dashboard.php");

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}
