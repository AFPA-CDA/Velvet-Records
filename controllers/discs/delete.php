<?php
require_once "../../models/connection.php";
require_once "../../models/disc.php";

/* Database Section */

// Gets the database instance
$db = Database::getInstance();

// Filters the input to make sure it is safe to use
$discId = filter_input(INPUT_GET, "disc_id", FILTER_SANITIZE_NUMBER_INT);

// Get disc details
$disc = getDiscDetails($db, $discId);

// Deletes the disc picture from the server
unlink(realpath("../../assets/img/{$disc->disc_picture}"));

// Deletes the disc with the given discId
deleteDisc($db, $discId);

// Redirects the user to the discs list page
header("Location: ../../views/discs/list.php");
