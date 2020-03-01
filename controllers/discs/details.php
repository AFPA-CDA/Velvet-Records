<?php
require_once "../../models/connection.php";
require_once "../../models/disc.php";

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Détails";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// Grabs the GET input and filters it
$discId = filter_input(INPUT_GET, 'disc_id', FILTER_SANITIZE_NUMBER_INT);

// Returns the disc details
$disc = getDiscDetails($db, $discId);

