<?php
require_once "../../models/disc.php";

/* Session Section */

// Starts the session
session_start();

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Liste des disques";

/* Database Section */

// Creates a new Disc model instace
$disc = new Disc();

// Gets the list of all discs
$discs = $disc->getDiscsList();