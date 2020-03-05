<?php
require_once "../../models/auth.php";

/* Session Section */

// Starts the session
session_start();

/* -------------------------------------------------------------------------------- */


/* Page Variables Section */

// Here lies the regex used for this form
const IS_VALID_PASSWORD = "/^(?=.+[a-z])(?=.+[A-Z]+)(?=.+[!@#\$%\^&\*])(?=.+\d)\S{8,}$/";
const IS_VALID_STRING = "/^[\wÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'’\s-]+$/i";

// Sets the page's title
$title = "Velvet Records - Création d'un compte";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Creates a new Auth model instance
$auth = new Auth();

// Gets ths users email
$users = $auth->getUsersEmail();

/* -------------------------------------------------------------------------------- */


/* Form Handling Section */

// Here lies all the forms variables
$confirmation = $email = $firstname = $lastname = $password = "";

// An array filled the with the form input errors
$formErrors = [];

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["email"])) {
        if (filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
            foreach ($users as $user) {
                if ($user->user_email == $_POST["email"]) {
                    $formErrors["email"] = "Cet email est déjà pris";
                }
            }
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        } else {
            $formErrors["email"] = "L'email n'est pas valide.";
        }
    } else {
        $formErrors["email"] = "L'email est requis.";
    }

    // If the value is not empty
    if (!empty($_POST["lastname"])) {
        // If the value is valid
        if (preg_match(IS_VALID_STRING, $_POST["lastname"])) {
            // It filters the input and makes it safe to insert into the database
            $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            // If it's not valid it asks the user to give a valid genre
            $formErrors["lastname"] = "Le nom n'est pas valide.";
        }
    } else {
        // If it's empty it asks the user to give a lastname
        $formErrors["lastname"] = "Le nom est requis.";
    }

    if (!empty($_POST["firstname"])) {
        if (preg_match(IS_VALID_STRING, $_POST["firstname"])) {
            $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $formErrors["firstname"] = "Le prénom n'est pas valide.";
        }
    } else {
        $formErrors["firstname"] = "Le prénom est requis.";
    }

   if (!empty($_POST["password"])) {
       if (preg_match(IS_VALID_PASSWORD, $_POST["password"])) {
           $password = $_POST["password"];
       } else {
           $formErrors["password"] = "Le mot de passe n'est pas assez robuste.";
       }
   } else {
       $formErrors["password"] = "Le mot de passe est requis.";
   }

   if (!empty($_POST["confirmation"])) {
       if ($_POST["password"] !== $_POST["confirmation"])  {
           $formErrors["confirmation"] = "Les mots de passe ne sont pas identiques.";
       }
   } else {
       $formErrors["confirmation"] = "Le mot de passe doit être confirmé.";
   }

   if (empty($formErrors)) {
       // Hashes the password with a custom cost
       $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 10]);

       // Creates the user with the form inputs
       $auth->createUser([
           ":user_firstname" => $firstname,
           ":user_lastname" => $lastname,
           ":user_password" => $password,
           ":user_email" => $email
       ]);

       // Makes the new created user connected
       $_SESSION["connected"] = true;

       // Regenerates the id for security puroposes
       session_regenerate_id(true);

       // Redirects to the main page
       header("Location: ../../index.php");
   }
}