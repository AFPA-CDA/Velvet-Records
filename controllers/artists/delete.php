<?php
require_once "../../models/artist.php";

/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

// Filters the input to makes sure it is safe to use for the database delete
$artistId = filter_input(INPUT_GET, "artist_id", FILTER_SANITIZE_NUMBER_INT);

// Deletes the artist
$artist->deleteArtist($artistId);

// TODO: Delete pictures from php server

// Redirects the user to the artists list page
header("Location: ../../views/artists/list.php");