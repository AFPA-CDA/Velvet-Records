<?php
function sanitize_input() {

}

// Sets the page's title
$title = "Velvet Records - Ajout d'un disque";

// Gets the database instance
$db = Database::getInstance();

// Prepares the statement for execution and returns the statement object
$stmt = $db->prepare("SELECT * FROM artist ORDER BY artist_name");

// Executes the prepared statement
$stmt->execute();

// Fetches all the artists
$artists = $stmt->fetchAll();

// If the request method used is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

}