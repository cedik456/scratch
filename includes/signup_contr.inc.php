<?php

declare(strict_types=1);

function isInputEmpty(string $faculty_id, string $fname, string $lname, $dob, $age, string $username, string $email, string $password) {

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

function createUser(object $pdo, string $faculty_id, string $fname, string $midname, string $lname,string $dob,int $age) {

    return setUser($pdo, $faculty_id, $fname, $midname, $lname, $dob, $age);
}

function createUserLogin(object $pdo, $user_id, string $username, string $email, string $password) {

    setUserLogin($pdo, $user_id, $username, $email, $password);
}