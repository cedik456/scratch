<?php
declare(strict_types=1);

function addStudent(object $pdo, string $first_name, string $last_name, string $email, $program_id, $year_level) {

    setStudent($pdo,  $first_name,  $last_name,  $email, $program_id, $year_level);
}

