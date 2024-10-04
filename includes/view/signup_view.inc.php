<?php

declare(strict_types=1);

function signupInputs() {


    echo '<input type="text" id="faculty_id" name="faculty_id" readonly>';

    if(isset($_SESSION["signup_data"]["fname"])) {
        echo ' <input type="text" id="fname" name="fname" value="'. $_SESSION["signup_data"]["fname"] . '">';
    } else {
        echo ' <input type="text" id="fname" name="fname">';
    }

    if(isset($_SESSION["signup_data"]["midname"])) {
        echo ' <input type="text" id="midname" name="midname" value="'. $_SESSION["signup_data"]["midname"] . '">';
    } else {
        echo ' <input type="text" id="midname" name="midname">';
    }

    if(isset($_SESSION["signup_data"]["lname"])) {
        echo ' <input type="text" id="lname" name="lname" value="'. $_SESSION["signup_data"]["lname"] . '">';
    } else {
        echo ' <input type="text" id="lname" name="lname">';
    }

    if(isset($_SESSION["signup_data"]["dob"])) {
        echo ' <input type="date" id="dob" name="dob" value="'. $_SESSION["signup_data"]["dob"] . '">';
    } else {
        echo ' <input type="date" id="dob" name="dob">';
    }

    if(isset($_SESSION["signup_data"]["age"])) {
        echo ' <input type="text" id="age" name="age" value="'. $_SESSION["signup_data"]["age"] . '">';
    } else {
        echo ' <input type="text" id="age" name="age">';
    }

    if(isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo ' <input type="text" id="username" name="username" value="'. $_SESSION["signup_data"]["username"] . '">';
    } else {
        echo ' <input type="text" id="username" name="username">';
    }

    if(isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalid_email"])) {
        echo ' <input type="text" id="email" name="email" value="'. $_SESSION["signup_data"]["email"] .'">';
    } else {
        echo ' <input type="text" id="email" name="email">';
    }

    echo '<input type="password" id="password" name="password">';

}

function checkSignupErrors() {
   
    if(isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_signup']);
    } else if (isset($_GET['signup']) && $_GET['signup'] === "success") {
        echo '<br>';
        echo '<p class="form-success">Signup Success!</p>'; 
    }
}