<?php

/**
 * @param PDO $pdo The database connection to use
 * @param array $items The array with the SQL INSERT parameters
 */
function createDisc(PDO $pdo, array $items)
{
    try {
        // Begins the SQL TRANSACTION
        $pdo->beginTransaction();

        // The INSERT request
        $request = "INSERT INTO disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) VALUE (:name, :year, :picture, :label, :genre, :price, :artist_id)";

        // Prepares the statement for execution and returns the statement object
        $insert = $pdo->prepare($request);

        // Executes the prepared statement with the given parameters
        $insert->execute($items);

        // Closes the cursor
        $insert->closeCursor();

        // Nothing went wrong so it commits the changes to the DB
        $pdo->commit();
    } catch (Exception $e) {
        // Something went wrong so it rollbaks the changes
        $pdo->rollBack();

        // Stops the script after giving the error message
        die($e->getMessage());
    }
}