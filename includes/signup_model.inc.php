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