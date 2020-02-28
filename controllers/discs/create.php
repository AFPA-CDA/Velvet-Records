<?php
require_once "../../models/connection.php";


/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Ajout d'un disque";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// Prepares the statement for execution and returns the statement object
$stmt = $db->prepare("SELECT * FROM artist ORDER BY artist_name");

// Executes the prepared statement
$stmt->execute();

// Fetches all the artists
$artists = $stmt->fetchAll();

// Closes the cursor
$stmt->closeCursor();

/* -------------------------------------------------------------------------------- */


/* Form Handling Section */

// Here lies all the forms variables
$artistSelect = $filePath = $genre = $label = $price = $year = $title = "";

// List of allowed mime types
$allowedMimeTypes = ["image/jpg", "image/jpeg", "image/pjpeg", "image/png", "image/x-png"];

// Returns true is the file exists
$fileExists = isset($_FILES) ? count($_FILES) : 0;

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the value is set
    if (isset($_POST["artists"])) {
        // It filters the input in order to prevent XSS Attacks
        $artistSelect = filter_input(INPUT_POST, "artists", FILTER_SANITIZE_NUMBER_INT);
    }

    if (isset($_POST["filePath"])) {
        $filePath = filter_input(INPUT_POST, "filePath", FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if (isset($_POST["genre"])) {
        $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_STRING);
    }

    if (isset($_POST["label"])) {
        $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_STRING);
    }

    if (isset($_POST["price"])) {
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT);
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
}

/* -------------------------------------------------------------------------------- */