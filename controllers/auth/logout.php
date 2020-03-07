<?php

/* Session Section */

// Starts the session
session_start();

// Unsets the auth fields
unset($_SESSION["firstname"]);
unset($_SESSION["lastname"]);
unset($_SESSION["connected"]);

// If the session uses cookies
if (ini_get("session.use_cookies")) {
    // Forces the cookie expiration date
    setcookie(session_name(), "", time() - 42000);
}

// Destroys what remains of the session
session_destroy();

// Redirects the user to the main page
header("Location: ../../index.php");
