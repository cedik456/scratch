<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {

    $query = "SELECT * FROM UserLogins WHERE username = :username;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
};

function get_email(object $pdo, string $email) {

    $query = "SELECT * FROM UserLogins WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
};

function setUser(object $pdo, string $faculty_id, string $fname, string $midname, string $lname, string $dob, int $age) {

    $query = "INSERT INTO Users (faculty_id, fname, midname, lname, dob, age ) VALUES
    (:faculty_id, :fname, :midname, :lname, :dob, :age);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":faculty_id", $faculty_id);
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":midname", $midname);
    $stmt->bindParam(":lname", $lname);
    $stmt->bindParam(":dob", $dob);
    $stmt->bindParam(":age", $age);
    $stmt->execute();

    $user_id = $pdo->lastInsertId();

    return $user_id;
}

function setUserLogin(object $pdo, $user_id, string $username, string $email, string $password) {

    $query = "INSERT INTO UserLogins (user_id, username, email, password) VALUES
    (:user_id, :username, :email, :password);";
    $stmt = $pdo->prepare($query);

    $option = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPwd);
    $stmt->execute();
}