<?php

declare(strict_types=1);

function setSubject(object $pdo, string $name, string $course_code, string $sub_detail, string $laboratory, $units, $prerequisite, $program_id) {

    $query = "INSERT INTO Subjects (name, course_code, sub_detail, laboratory, units, prerequisite, program_id ) VALUES
    (:name, :course_code, :sub_detail,:laboratory, :units, :prerequisite, :program_id);";
    $stmt = $pdo->prepare($query);


    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":course_code", $course_code);
    $stmt->bindParam(":sub_detail", $sub_detail);
    $stmt->bindParam(":laboratory", $laboratory);
    $stmt->bindParam(":units", $units);
    $stmt->bindParam(":prerequisite", $prerequisite);
    $stmt->bindParam(":program_id", $program_id);
    $stmt->execute();
}