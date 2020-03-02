<?php
require_once "../../models/connection.php";
require_once "../../models/disc.php";

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Modification du disque";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// Gets all the artists orderd by their names
$artists = getArtistsOrderByName($db);

// Grabs the GET input and filters it
$discId = filter_input(INPUT_GET, 'disc_id', FILTER_SANITIZE_NUMBER_INT);

// Returns the disc details
$disc = getDiscDetails($db, $discId);

/* -------------------------------------------------------------------------------- */


/* Form Handling Section */

// Here lies all the forms variables
$artistId = $genre = $label = $price = $year = $title = "";

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

        // Deletes the old disc picture from the server
        unlink(realpath("../../assets/img/{$disc->disc_picture}"));

        // Updates the disc with the form data given by the user
        updateDisc($db, [
            ":year" => $year,
            ":picture" => "$name.$extension",
            ":label" => $label,
            ":title" => $title,
            ":genre" => $genre,
            ":price" => $price,
            ":artist_id" => $artistId,
            ":disc_id" => $discId
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
        // If the user don't give an image we keep the old one
        if ($_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE) {
            // Updates the disc with the form data given by the user
            updateDisc($db, [
                ":year" => $year,
                ":picture" => $disc->disc_picture,
                ":label" => $label,
                ":title" => $title,
                ":genre" => $genre,
                ":price" => $price,
                ":artist_id" => $artistId,
                ":disc_id" => $discId
            ]);

            // Redirects the user to the discs list view
            header("Location: ../../views/discs/list.php");
        }

        // Prints the error message to the user
        echo $fileMessages[$_FILES["image"]["error"]];
    }

    // If the file has an allowed mime type and the file size exceeds 2MB
    if (in_array($mimeType, $allowedMimeTypes) && ($_FILES["image"]["size"] / 1024 / 1024) > 2) {
        // Prints the error message to the user
        echo "Le fichier ne peut pas dépasser 2MB !";
    }
}

