<?php

/**
 * @param PDO $pdo The database connection to use
 * @param array $items The array with the SQL INSERT parameters
 */
function createDisc(PDO $pdo, array $items): void
{
    try {
        // Begins the SQL TRANSACTION
        $pdo->beginTransaction();

        // The INSERT request
        $request = "INSERT INTO disc 
                    (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) 
                    VALUE (:name, :year, :picture, :label, :genre, :price, :artist_id)";

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

/**
 * @param PDO $pdo The database connection to use
 * @param int $discId The disc id
 */
function deleteDisc(PDO $pdo, int $discId): void
{
    try {
        // Begins the SQL TRANSACTION
        $pdo->beginTransaction();

        // The DELETE request
        $request = "DELETE FROM disc WHERE disc_id = :disc_id";

        // Prepares the statement for execution and returns the statement object
        $delete = $pdo->prepare($request);

        // Binds the disc_id parameter to the disc_id variable
        $delete->bindParam(":disc_id", $discId, PDO::PARAM_INT);

        // Execute the prepared statement
        $delete->execute();

        // Closes the cursor
        $delete->closeCursor();

        // Nothing went wrong so it commits the changes to the DB
        $pdo->commit();
    } catch (Exception $e) {
        // Something went wrong so it rollbaks the changes
        $pdo->rollBack();

        // Stops the script after giving the error message
        die($e->getMessage());
    }
}

/**
 * @param PDO $pdo The database connection to use
 * @return array The artists array
 */
function getArtistsOrderByName(PDO $pdo): array
{
    try {
        // The SELECT query
        $request = "SELECT * FROM artist ORDER BY artist_name";

        // Prepares the statement for execution and returns the statement object
        $stmt = $pdo->prepare($request);

        // Executes the prepared statement
        $stmt->execute();

        // Fetches all the artists
        $artists = $stmt->fetchAll();

        // Closes the cursor
        $stmt->closeCursor();

        // Returns the result of the fetchAll
        return $artists;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * @param PDO $pdo The database connection to use
 * @param int $discId The disc id
 * @return object The disc details
 */
function getDiscDetails(PDO $pdo, int $discId): object
{
    try {
        // The SELECT query
        $request = "SELECT disc.*, artist_name 
                    FROM disc 
                    INNER JOIN artist a 
                    ON disc.artist_id = a.artist_id 
                    WHERE disc_id = :disc_id";

        // Prepares the statement for execution and returns the statement object
        $stmt = $pdo->prepare($request);

        // Binds the disc_id parameter to the disc_id variable
        $stmt->bindParam(":disc_id", $discId, PDO::PARAM_INT);

        // Executes the prepared statement
        $stmt->execute();

        // Fetches the disc with the given ID
        $disc = $stmt->fetch();

        // Closes the cursor
        $stmt->closeCursor();

        // Returns the disc details
        return $disc;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * @param PDO $pdo The database connection to use
 * @return array The list of discs
 */
function getDiscsList(PDO $pdo): array
{
    try {
        // The SELECT query
        $request = "SELECT disc.*, artist_name 
                    FROM disc 
                    INNER JOIN artist a 
                    ON disc.artist_id = a.artist_id 
                    ORDER BY disc_id DESC";

        // Prepares the statement for execution and returns the statement object
        $stmt = $pdo->prepare($request);

        // Executes the prepared statement
        $stmt->execute();

        // Fetches all the discs from the prepared statement as an Object
        $discs = $stmt->fetchAll();

        // Closes the cursor
        $stmt->closeCursor();

        // Returns discs list
        return $discs;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/**
 * @param PDO $pdo The database connection to use
 * @param array $items The array with the SQL UPDATE items
 */
function updateDisc(PDO $pdo, array $items): void
{
    try {
        $pdo->beginTransaction();

        // The UPDATE query
        $request = "UPDATE disc
                    INNER JOIN artist a 
                    ON disc.artist_id = a.artist_id
                    SET disc_genre = :genre,
                        disc_label = :label, 
                        disc_picture = :picture,
                        disc_price = :price, 
                        disc_title = :title, 
                        disc_year = :year,
                        a.artist_id = :artist_id
                    WHERE disc_id = :disc_id";

        // Prepares the statement for execution and returns the statement object
        $stmt = $pdo->prepare($request);

        // Executes the prepared statement
        $stmt->execute($items);

        // Closes the cursor
        $stmt->closeCursor();

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        die($e->getMessage());
    }
}