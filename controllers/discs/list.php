<?php
require_once "../../models/connection.php";
require_once "../../models/disc.php";

/* Page Variables Section */

// Sets the page's title
$title = "Velvet Records - Liste des disques";

/* -------------------------------------------------------------------------------- */


/* Database Section */

// Gets the database instance
$db = Database::getInstance();

$discs = getDiscsList($db);