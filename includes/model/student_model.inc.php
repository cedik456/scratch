<?php

declare(strict_types=1);

function setStudent(object $pdo, $user_id, string $first_name, string $last_name, string $email, $program_id, $year_level) {

    $query = "INSERT INTO Students (user_id, first_name, last_name, email, program_id, year_level ) VALUES
    (:user_id, :first_name, :last_name,:email, :program_id, :year_level);";
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":program_id", $program_id);
    $stmt->bindParam(":year_level", $year_level);
    $stmt->execute();
}


function getProgramName(object $pdo, int $program_id) {
    $query = "SELECT program_name FROM Programs WHERE id = :program_id";
    $stmt = $pdo->prepare($query);
    
    $stmt->bindParam(":program_id", $program_id);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchStudents($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM Students WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


