<?php
require_once "../../models/connection.php";

// Sets the page's title
$title = "Velvet Records - Détails";

// Gets the database instance
$db = Database::getInstance();

// Prepares the statement for execution and returns the statement object
$stmt = $db->prepare("SELECT disc.*, artist_name FROM disc INNER JOIN artist a on disc.artist_id = a.artist_id WHERE disc_id = :disc_id");

// Grabs the GET input and filters it
$disc_id = filter_input(INPUT_GET, 'disc_id', FILTER_SANITIZE_NUMBER_INT);

// Binds the disc_id parameter to the disc_id variable
$stmt->bindParam(":disc_id", $disc_id, PDO::PARAM_INT);

// Executes the prepared statement
$stmt->execute();

// Fetches the disc with the given ID
$disc = $stmt->fetch();

// Closes the cursor
$stmt->closeCursor();