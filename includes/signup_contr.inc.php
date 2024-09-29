<?php

declare(strict_types=1);

function isInputEmpty(int $faculty_id, string $fname, string $lname, string $dob, int $age, string $username, string $email, string $password) {

    if (empty($faculty_id) || empty($fname) || empty($lname) || empty($dob) || empty($age) || empty($username) || empty($email) || empty($password)) {
       return true;
    } else {
        return false;
    }
} 

function isEmailInvalid(string $email) {
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function isUsernameTaken(object $pdo, string $username) {

    if (get_username($pdo, $username)) {
        return true;
    } else 
        return false;
}

function isEmailRegistered(object $pdo, string $email) {

    if (get_email($pdo, $email)) {
        return true;
    } else 
        return false;
}