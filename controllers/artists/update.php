<?php
require_once "../../models/artist.php";

/* Page Variables Section */

// Here lies the regexes used for this form
const IS_NOT_DANGEROUS = "/^[^<>&]+$/i";

// Sets the page's title
$title = "Velvet Records - Mise à jour d'un artiste";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

// Gets and filters the artist ID
$artistId = filter_input(INPUT_GET, "artist_id", FILTER_SANITIZE_NUMBER_INT);

/* -------------------------------------------------------------------------------- */


/* Form Handling Section */

// Here lies all the forms variables
$artistName = "";

// An array filled the with the form input errors
$formErrors = [];

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Checks that there is no error and that the mime type is allowed
    if (empty($formErrors)) {
        // Updates the currenta artist in the database with the form inputs
        $artist->updateArtist([":artist_name" => $artistName, ":artist_id" => $artistId]);

        // Redirects the user to the discs list view
        header("Location: ../../views/artists/list.php");
    }
}