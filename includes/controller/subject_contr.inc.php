<?php
declare(strict_types=1);

function isInputEmpty(string $name, string $course_code, string $sub_detail, string $laboratory, $units, $prerequisite) {

    if (empty($name) || empty($course_code) || empty($sub_detail) || empty($laboratory) || empty($units) || empty($prerequisite)) {
       return true;
    } else {        
        return false;
    }
} 

function addSubject(object $pdo, string $name, string $course_code, string $sub_detail, string $laboratory, $units, $prerequisite, $program_id) {

    setSubject( $pdo,  $name,  $course_code,  $sub_detail,  $laboratory, $units, $prerequisite, $program_id);
}
