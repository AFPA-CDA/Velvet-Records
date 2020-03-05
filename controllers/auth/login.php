<?php

/* Page Variables Section */

// TODO: mettre tout dans config php
session_start();

// Sets the page's title
$title = "Velvet Records - Connexion";

/* -------------------------------------------------------------------------------- */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["email"] === "broyard.dev@gmail.com") {
        $_SESSION["email"] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    }

    if ($_POST["password"] === "123456") {
        $_SESSION["password"] = $_POST["password"];
    }

    if (isset($_SESSION["password"]) && isset($_SESSION["email"])) {
        $_SESSION["connected"] = true;
    } else {
        $_SESSION["connected"] = false;
    }

    // Regenerates the session ID for security purposes
    session_regenerate_id(true);

    header("Location: ../../index.php");
}

