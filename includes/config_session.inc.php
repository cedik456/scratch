<?php

// Set session configuration
ini_set('session.use_only_cookies', 1); 
ini_set('session.use_strict_mode', 1); 

session_set_cookie_params([
    'lifetime' => 1800,
    'path' => '/',
    'domain' => 'localhost',
    'secure' => true, // true if using HTTPS
    'httponly' => true
 
]);

session_start();

// Regenerate session ID on login
if (isset($_SESSION["last_regeneration"])) {
    regenerate_session_id();
} else {
    $interval = 60 * 30;
    if (time() - $_SESSION["last_regeneration"] >= $interval) {
        regenerate_session_id();
    }
}

function regenerate_session_id() {
    session_regenerate_id();
    $_SESSION["last_regeneration"] = time();
};
