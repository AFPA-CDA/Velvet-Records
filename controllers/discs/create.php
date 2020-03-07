<?php
require_once "../../models/disc.php";
require_once "../../models/artist.php";

/* Session Section */

// Starts the session
session_start();

// If the user is not connected
if (!$_SESSION["connected"]) {
    // Redirects the user to the disc lists page
    header("Location: ../../views/discs/list.php");
}

/* Page Variables Section */

// Here lies the regexes used for this form
const IS_ALLOWED_EXTENSION = "/(\.jpg|\.jpeg|\.png)$/i";
const IS_CORRECT_PRICE = "/^(\d{0,4}[.]?)\d{0,2}$/";
const IS_NOT_DANGEROUS = "/^[^<>&]+$/i";
const IS_YEAR = "/^(19|20)\d{2}$/";

// Sets the page's title
$title = "Velvet Records - Ajout d'un disque";

/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

// Creates a new Disc model instance
$disc = new Disc();

// Get all artists ordered by their name
$artists = $artist->getArtistsOrderByName();

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
    UPLOAD_ERR_INI_SIZE => 'Le fichier téléchargé dépasse 5MB',
    UPLOAD_ERR_FORM_SIZE => 'Le fichier téléchargé dépasse 5MB',
    UPLOAD_ERR_PARTIAL => 'Le fichier choisi n\'a été que partiellement téléchargé',
    UPLOAD_ERR_NO_FILE => 'Aucun fichier n\'a été choisi',
    UPLOAD_ERR_NO_TMP_DIR => 'Il manque un dossier temporaire',
    UPLOAD_ERR_CANT_WRITE => 'Impossible d\'écrire le fichier sur le disque',
    UPLOAD_ERR_EXTENSION => 'Une extension PHP a arrêté le téléchargement du fichier'
);

// An array filled the with the form input errors
$formErrors = [];

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the value is set
    if (!empty($_POST["artists"])) {
        // It filters the input in order to prevent XSS Attacks
        $artistId = filter_input(INPUT_POST, "artists", FILTER_SANITIZE_NUMBER_INT);
    } else {
        $formErrors["artists"] = "Vous devez choisir un artiste.";
    }

    // If the value is not empty
    if (!empty($_POST["genre"])) {
        // If the value is valid
        if (preg_match(IS_NOT_DANGEROUS, $_POST["genre"])) {
            // It filters the input and makes it safe to insert into the database
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            // If it's not valid it asks the user to give a valid genre
            $formErrors["genre"] = "Le genre n'est pas valide.";
        }
    } else {
        // If it's empty it asks the user to give a genre
        $formErrors["genre"] = "Le genre est requis.";
    }

    if (!empty($_POST["filePath"])) {
        if (!preg_match(IS_ALLOWED_EXTENSION, $_POST["filePath"])) {
            $formErrors["filePath"] = "Seuls les extensions [jpg|jpeg|png] sont autorisées.";
        }
    }

    if (!empty($_POST["label"])) {
        if (preg_match(IS_NOT_DANGEROUS, $_POST["label"])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $formErrors["label"] = "Le label n'est pas valide.";
        }
    } else {
        $formErrors["label"] = "Le label est requis.";
    }

    if (!empty($_POST["price"])) {
        if (preg_match(IS_CORRECT_PRICE, $_POST["price"])) {
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } else {
            $formErrors["price"] = "Le prix n'est pas valide.";
        }
    } else {
        $formErrors["price"] = "Le prix est requis.";
    }

    if (!empty($_POST["year"])) {
        if (preg_match(IS_YEAR, $_POST["year"])) {
            $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
        } else {
            $formErrors["year"] = "L'année n'est pas valide.";
        }
    } else {
        $formErrors["year"] = "L'année est requise.";
    }

    if (!empty($_POST["title"])) {
        if (preg_match(IS_NOT_DANGEROUS, $_POST["title"])) {
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $formErrors["title"] = "Le titre n'est pas valide.";
        }
    } else {
        $formErrors["title"] = "Le titre est requis.";
    }

    // Reads the file informations if the file exists
    if ($fileExists && $_FILES["image"]["size"] > 0) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES["image"]["tmp_name"]);
    } else {
        $mimeType = null;
        $formErrors["image"] = "L'image est requise.";
    }

    // If there is any errors
    if (!empty($_FILES["image"]["error"])) {
        // Stores the error message in the formErrors array
        $formErrors["image"] = $fileMessages[$_FILES["image"]["error"]];
    }

    // If the file don't have an allowed mime type and there's no error
    if (!in_array($mimeType, $allowedMimeTypes) && empty($_FILES["image"]["error"])) {
        // Stores the error message in the formErrors array
        $formErrors["filePath"] = "Le format ." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION) . " n'est pas supporté.";
    }

    // Checks that there is no error and that the mime type is allowed
    if ($_FILES["image"]["error"] == UPLOAD_ERR_OK && in_array($mimeType, $allowedMimeTypes) && empty($formErrors)) {
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $path = realpath("../../assets/img/");
        $name = basename($title);

        // Moves the new uploaded file to the right img folder
        move_uploaded_file($_FILES["image"]["tmp_name"], "$path/$name.$extension");

        // Creates and inserts a disc in the database with the form inputs
        $disc->createDisc([
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
}