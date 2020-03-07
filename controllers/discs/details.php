<?php
require_once "../../models/disc.php";

/* Session Section */

// Starts the session
session_start();

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Détails";

/* Database Section */

// Creates a new Disc model instance
$disc = new Disc();

// Grabs the GET input and filters it
$discId = filter_input(INPUT_GET, 'disc_id', FILTER_SANITIZE_NUMBER_INT);

// Returns the disc details
$discDetails = $disc->getDiscDetails($discId);

