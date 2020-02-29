<?php
require_once "../../models/connection.php";

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Liste des disques";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// The SELECT query
$request = "SELECT disc.*, artist_name FROM disc INNER JOIN artist a on disc.artist_id = a.artist_id ORDER BY disc_id DESC";

// Prepares the statement for execution and returns the statement object
$stmt = $db->prepare($request);

// Executes the prepared statement
$stmt->execute();

// Fetches all the discs from the prepared statement as an Object
$discs = $stmt->fetchAll();

// Closes the cursor
$stmt->closeCursor();

/* -------------------------------------------------------------------------------- */