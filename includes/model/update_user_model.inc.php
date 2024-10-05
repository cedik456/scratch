<?php

function updateUser($pdo, $user_id, $faculty_id, $fname, $midname, $lname, $dob, $age) {
    $sql = "UPDATE users SET faculty_id = :faculty_id, first_name = :fname, middle_name = :midname, last_name = :lname, dob = :dob, age = :age WHERE user_id = :user_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':faculty_id' => $faculty_id,
        ':fname' => $fname,
        ':midname' => $midname,
        ':lname' => $lname,
        ':dob' => $dob,
        ':age' => $age,
        ':user_id' => $user_id,
    ]);
}

function updateUserLogin($pdo, $user_id, $username, $email, $password = null) {
    $sql = "UPDATE user_logins SET username = :username, email = :email" . ($password ? ", password = :password" : "") . " WHERE user_id = :user_id";
    
    $stmt = $pdo->prepare($sql);
    $params = [
        ':username' => $username,
        ':email' => $email,
        ':user_id' => $user_id,
    ];

    if ($password) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $params[':password'] = $hashedPassword;
    }

    $stmt->execute($params);
}
