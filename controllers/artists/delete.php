<?php
require_once "../../models/artist.php";

/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

// Filters the input to makes sure it is safe to use for the database delete
$artistId = filter_input(INPUT_GET, "artist_id", FILTER_SANITIZE_NUMBER_INT);

// Gets the current artist discs list
$artistDiscsList = $artist->getArtistDiscsList($artistId);

// For each discs of the current artist
foreach ($artistDiscsList as $disc) {
    // It deletes the disc photo from the server
    unlink(realpath("../../assets/img/{$disc->disc_picture}"));
}

// Deletes the artist
$artist->deleteArtist($artistId);

// Redirects the user to the artists list page
header("Location: ../../views/artists/list.php");