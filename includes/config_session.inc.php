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

if(isset($_SESSION["current_user_id"])) {

    if (isset($_SESSION["last_regeneration"])) {
        regenerateSessionIdloggedIn();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSessionIdloggedIn();
        }
    }
    
} else {
    
    if (isset($_SESSION["last_regeneration"])) {
        regenerateSessionId();
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerateSessionId();
        }
    }
    
}

function regenerateSessionIdloggedIn() {

    session_regenerate_id(true);

    $currentUserId = $_SESSION["current_user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $currentUserId;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();
};

function regenerateSessionId() {

    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();
};

