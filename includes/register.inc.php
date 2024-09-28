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
    

   

} else {
    header("Location: ../index.php");
    die();
}