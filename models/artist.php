<?php
require_once "connection.php";

class Artist
{
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * @param array $items The array with the SQL INSERT parameters
     */
    public function createArtist(array $items): void
    {
        try {
            // The INSERT request
            $request = "INSERT INTO artist (artist_name) VALUE (:artist_name)";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

            // Executes the prepared statement with the given items
            $stmt->execute($items);

            // Closes the cursor
            $stmt->closeCursor();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param int $artistId The artist id
     */
    public function deleteArtist(int $artistId): void
    {
        try {
            // Starts the SQL TRANSACTION
            $this->pdo->beginTransaction();

            /* Deletion of the DISC first */

            // The DELETE request
            $request = "DELETE FROM disc WHERE artist_id = :artist_id";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

            // Binds the disc_id parameter to the disc_id variable
            $stmt->bindParam(":artist_id", $artistId, PDO::PARAM_INT);

            // Executes the prepared statement
            $stmt->execute();

            // Closes the cursor
            $stmt->closeCursor();

            /* Deletion of the ARTIST last */

            // The DELETE request
            $request = "DELETE FROM artist WHERE artist_id = :artist_id";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

            // Binds the disc_id parameter to the disc_id variable
            $stmt->bindParam(":artist_id", $artistId, PDO::PARAM_INT);

            // Executes the prepared statement
            $stmt->execute();

            // Closes the cursor
            $stmt->closeCursor();

            // Nothing went wrong so it commits the changes
            $this->pdo->commit();
        } catch (Exception $e) {
            // Something went wrong so it rollbacks the changes
            $this->pdo->rollBack();
            die($e->getMessage());
        }
    }

    public function getArtistDiscsList(int $artistId): array
    {
        try {
            // The DELETE request
            $request = "SELECT * 
                        FROM disc 
                        INNER JOIN artist a on disc.artist_id = a.artist_id
                        WHERE disc.artist_id = :artist_id";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

            // Binds the disc_id parameter to the disc_id variable
            $stmt->bindParam(":artist_id", $artistId, PDO::PARAM_INT);

            // Executes the prepared statement
            $stmt->execute();

            // Fetches all the current artist discs lsit
            $artistDiscsList = $stmt->fetchAll();

            // Closes the cursor
            $stmt->closeCursor();

            // Returns the artist discs list
            return $artistDiscsList;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return array The artists array
     */
    public function getArtistsOrderByName(): array
    {
        try {
            // The SELECT query
            $request = "SELECT * FROM artist ORDER BY artist_name";

            // Executes the query
            $query = $this->pdo->query($request);

            // Returns all the artist
            return $query->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}