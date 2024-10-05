<?php

declare(strict_types=1);

function checkSignupErrors() {
   
    if(isset($_SESSION['errors_student'])) {
        $errors = $_SESSION['errors_student'];

        echo "<br>";

        foreach($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_student']);
    } 
}