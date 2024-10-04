<?php

declare(strict_types=1);

function setStudent(object $pdo, string $first_name, string $last_name, string $email, $program_id, $year_level) {

    $query = "INSERT INTO Students (first_name, last_name, email, program_id, year_level ) VALUES
    (:first_name, :last_name,:email, :program_id, :year_level);";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":first_name", $first_name);
    $stmt->bindParam(":last_name", $last_name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":program_id", $program_id);
    $stmt->bindParam(":year_level", $year_level);
    $stmt->execute();
}