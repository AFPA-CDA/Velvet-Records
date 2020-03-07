<?php
require_once "../../models/artist.php";

/* Session Section */

// Starts the session
session_start();

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Liste des artistes";

/* Database Section */

// Creates a new Artist model instace
$artist = new Artist();

// Gets the list of all discs
$artists = $artist->getArtistsOrderByName();