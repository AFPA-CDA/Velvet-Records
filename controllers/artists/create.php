<?php
require_once "../../models/artist.php";

/* Session Section */

// Starts the session
session_start();

// If the user is not connected he gets redirected to the login page
if (!$_SESSION["connected"]) {
    header("Location: ../../views/auth/login.php");
}

/* Page Variables Section */

// Here lies the regexes used for this form
const IS_NOT_DANGEROUS = "/^[^<>&]+$/i";

// Sets the page's title
$title = "Velvet Records - Ajout d'un artiste";

/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

/* Form Handling Section */

// Here lies all the forms variables
$artistName = "";

// An array filled the with the form input errors
$formErrors = [];

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // If the value is set
    if (!empty($_POST["name"])) {
        if (preg_match(IS_NOT_DANGEROUS, $_POST["name"])) {
            // It filters the input in order to prevent XSS Attacks
            $artistName = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $formErrors["name"] = "Le nom n'est pas valide.";
        }
    } else {
        $formErrors["name"] = "Vous devez choisir un artiste.";
    }

    // Checks that there is no error and that the crsf token isn't empty
    if (empty($formErrors) && !empty($_SESSION["crsf_token"])) {
        // If the CRSF tokens are equal
        if (hash_equals($_SESSION["crsf_token"], $_POST["crsf_token"])) {
            // Creates and inserts a artist in the database with the form inputs
            $artist->createArtist([":artist_name" => $artistName]);

            // Redirects the user to the discs list view
            header("Location: ../../views/artists/list.php");
        }
    }
}