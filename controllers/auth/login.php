<?php
require_once "../../models/auth.php";

/* Session Section */

// Starts the session
session_start();

// If the user is connected he gets redirected to the index
if ($_SESSION["connected"]) {
    header("Location: ../../index.php");
}

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Connexion";

/* Database Section */

// Creates a new Auth model instance
$auth = new Auth();

/* Form Handling Section */

// Here lies all the forms variables
$email = $password = "";

// An array filled the with the form input errors
$formErrors = [];

// If the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["email"])) {
        if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        } else {
            $formErrors["email"] = "L'email n'est pas valide.";
        }
    } else {
        $formErrors["email"] = "L'email est requis.";
    }

    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
    } else {
        $formErrors["password"] = "Le mot de passe est requis.";
    }

    // If there is no errors
    if (empty($formErrors)) {
        // Gets the user
        $user = $auth->getUser($email);

        // If there is a user
        if (!empty($user)) {
            // If the user gives the correct password
            if (password_verify($password, $user->user_password)) {
                // Makes the user connected and stores his full name in session
                $_SESSION["connected"] = true;
                $_SESSION["firstname"] = $user->user_firstname;
                $_SESSION["lastname"] = $user->user_lastname;

                // If there aren't any crsf_token
                if (empty($_SESSION["crsf_token"])) {
                    // Creates a crsf_token with a random generated value
                    $_SESSION["crsf_token"] = bin2hex(random_bytes(32));
                }

                // Regenerates the session ID for security purposes
                session_regenerate_id();

                // Redirects the user to the main page
                header("Location: ../../index.php");
            } else {
                $formErrors["password"] = "Le mot de passe est incorrect.";
            }
        } else {
            $formErrors["email"] = "Le compte auquel vous souhaitez vous connecter n'exsite pas.";
        }
    }
}

