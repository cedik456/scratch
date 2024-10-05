<?php
declare(strict_types=1);

function isInputEmpty($user_id, string $first_name, string $last_name, string $email, $program_id, $year_level) {

    if (empty($user_id) || empty($first_name) || empty($last_name) || empty($email) || empty($program_id) || empty($year_level)) {
       return true;
    } else {        
        return false;
    }
} 

function addStudent(object $pdo, $user_id, string $first_name, string $last_name, string $email, $program_id, $year_level) {

    setStudent($pdo, $user_id,  $first_name,  $last_name,  $email, $program_id, $year_level);
}

