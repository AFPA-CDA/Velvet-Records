<?php
require_once "../../models/artist.php";

/* Session Section */

// Starts the session
session_start();

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Liste des disques de l'artiste";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Creates a new Artist model instace
$artist = new Artist();

// Filters the input to makes sure it is safe to use for the database delete
$artistId = filter_input(INPUT_GET, "artist_id", FILTER_SANITIZE_NUMBER_INT);

// Gets the list of all discs
$artistDiscsList = $artist->getArtistDiscsList($artistId);