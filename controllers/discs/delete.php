<?php
require_once "../../models/disc.php";

/* Session Section */

// Starts the session
session_start();

// If the user is connected and the crsf token isn't empty
if ($_SESSION["connected"] && !empty($_SESSION["crsf_token"])) {
    // If the CRSF tokens are equal
    if (hash_equals($_SESSION["crsf_token"], $_GET["crsf_token"])) {
        // Creates a new Disc model instance
        $disc = new Disc();

        // Filters the input to make sure it is safe to use
        $discId = filter_input(INPUT_GET, "disc_id", FILTER_SANITIZE_NUMBER_INT);

        // Get disc details
        $discDetails = $disc->getDiscDetails($discId);

        // Deletes the disc picture from the server
        unlink(realpath("../../assets/img/{$discDetails->disc_picture}"));

        // Deletes the disc with the given discId
        $disc->deleteDisc($discId);

        // Redirects the user to the discs list page
        header("Location: ../../views/discs/list.php");
    }
} else {
    // He gets redirected to the login page
    header("Location: ../../views/auth/login.php");
}

