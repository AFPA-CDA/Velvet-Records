<?php
require_once "models/artist.php";
require_once "models/disc.php";

/* Session Section */

// Starts the session
session_start();

/* Database Section */

// Creates a new Artist model instance
$artist = new Artist();

// Creates a new Disc model instance
$disc = new Disc();

// Gets the newest artists
$artists = $artist->getNewestArtists();

// Gets the newest discs
$discs = $disc->getNewestDiscs();