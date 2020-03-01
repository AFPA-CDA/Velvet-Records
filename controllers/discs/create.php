<?php
require_once "../../models/connection.php";
require_once "../../models/disc.php";

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Ajout d'un disque";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// Get all artists ordered by their name
$artists = getArtistsOrderByName($db);

/* -------------------------------------------------------------------------------- */


/* Form Handling Section */

// Here lies all the forms variables
$artistId = $errMessage = $genre = $label = $price = $year = $title = "";

// List of allowed mime types
$allowedMimeTypes = ["image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png"];

// Returns true is the file exists
$fileExists = isset($_FILES) ? count($_FILES) : 0;

// List of error messages
$fileMessages = array(
    UPLOAD_ERR_OK => "Il n'y a pas d'erreur, le fichier a été téléchargé avec succès",
    UPLOAD_ERR_INI_SIZE => 'Le fichier téléchargé dépasse la directive upload_max_filesize de php.ini',
    UPLOAD_ERR_FORM_SIZE => 'Le fichier téléchargé dépasse la directive MAX_FILE_SIZE qui a été spécifiée dans le formulaire HTML',
    UPLOAD_ERR_PARTIAL => 'Le fichier choisi n\'a été que partiellement téléchargé',
    UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été choisi',
    UPLOAD_ERR_NO_TMP_DIR => 'Il manque un dossier temporaire',
    UPLOAD_ERR_CANT_WRITE => 'Impossible d\'écrire le fichier sur le disque',
    UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté le téléchargement du fichier'
);

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the value is set
    if (isset($_POST["artists"])) {
        // It filters the input in order to prevent XSS Attacks
        $artistId = filter_input(INPUT_POST, "artists", FILTER_SANITIZE_NUMBER_INT);
    }

    if (isset($_POST["genre"])) {
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_STRING);
    }

    if (isset($_POST["label"])) {
        $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_STRING);
    }

    if (isset($_POST["price"])) {
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    if (isset($_POST["year"])) {
        $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
    }

    if (isset($_POST["title"])) {
        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
    }

    // Reads the file informations if the file exists
    if ($fileExists && $_FILES["image"]["size"] > 0) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES["image"]["tmp_name"]);
    } else {
        $mimeType = null;
    }

    // Checks that there is no error and that the mime type is allowed
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK && in_array($mimeType, $allowedMimeTypes)) {
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $path = realpath("../../assets/img/");
        $name = basename($title);

        // Moves the new uploaded file to the right img folder
        move_uploaded_file($_FILES["image"]["tmp_name"], "$path/$name.$extension");

        // Creates and inserts a disc in the database with the form inputs
        createDisc($db, [
            ":name" => $name,
            ":year" => $year,
            ":picture" => "$name.$extension",
            ":label" => $label,
            ":genre" => $genre,
            ":price" => $price,
            ":artist_id" => $artistId
        ]);

        // Redirects the user to the discs list view
        header("Location: ../../views/discs/list.php");
    }

    // If the file don't have an allowed mime type and there's no error
    if (!in_array($mimeType, $allowedMimeTypes) && empty($_FILES["image"]["error"])) {
        // Prints an error message to the user
        echo "Le format " . basename($mimeType) . "est pas supporté.";
    }

    // If there is any errors
    if (!empty($_FILES["image"]["error"])) {
        // Prints the error message to the user
        echo $fileMessages[$_FILES["image"]["error"]];
    }
}