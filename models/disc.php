<?php
require_once "connection.php";

class Disc
{
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * @param array $items The array with the SQL INSERT parameters
     */
    public function createDisc(array $items): void
    {
        try {
            // The INSERT request
            $request = "INSERT INTO disc 
                    (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) 
                    VALUE (:name, :year, :picture, :label, :genre, :price, :artist_id)";

            // Prepares the statement for execution and returns the statement object
            $insert = $this->pdo->prepare($request);

            // Executes the prepared statement with the given parameters
            $insert->execute($items);

            // Closes the cursor
            $insert->closeCursor();
        } catch (Exception $e) {
            // Stops the script after giving the error message
            die($e->getMessage());
        }
    }

    /**
     * @param int $discId The disc id
     */
    public function deleteDisc(int $discId): void
    {
        try {
            // The DELETE request
            $request = "DELETE FROM disc WHERE disc_id = :disc_id";

            // Prepares the statement for execution and returns the statement object
            $delete = $this->pdo->prepare($request);

            // Binds the disc_id parameter to the disc_id variable
            $delete->bindParam(":disc_id", $discId, PDO::PARAM_INT);

            // Execute the prepared statement
            $delete->execute();

            // Closes the cursor
            $delete->closeCursor();
        } catch (Exception $e) {
            // Stops the script after giving the error message
            die($e->getMessage());
        }
    }

    /**
     * @param int $discId The disc id
     * @return object The disc details
     */
    public function getDiscDetails(int $discId): object
    {
        try {
            // The SELECT query
            $request = "SELECT disc.*, artist_name 
                    FROM disc 
                    INNER JOIN artist a 
                    ON disc.artist_id = a.artist_id 
                    WHERE disc_id = :disc_id";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

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
     * @return array The list of discs
     */
    public function getDiscsList(): array
    {
        try {
            // The SELECT query
            $request = "SELECT disc.*, artist_name 
                    FROM disc 
                    INNER JOIN artist a 
                    ON disc.artist_id = a.artist_id 
                    ORDER BY disc_id DESC";

            // Prepares the statement for execution and returns the statement object
            $query = $this->pdo->query($request);

            // Fetches all the discs from the query as an Object
            $discs = $query->fetchAll();

            // Closes the cursor
            $query->closeCursor();

            // Returns discs list
            return $discs;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return array The 3 newest discs
     */
    public function getNewestDiscs(): array
    {
        try {
            // The SELECT query
            $request = "SELECT * 
                        FROM disc 
                        INNER JOIN artist a on disc.artist_id = a.artist_id
                        ORDER BY disc_id DESC 
                        LIMIT 3";

            // Executes the query
            $query = $this->pdo->query($request);

            // Fetches all the newest discs
            $newestDiscs = $query->fetchAll();

            // Closes the cursor
            $query->closeCursor();

            // Returns the 3 newest discs
            return $newestDiscs;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param array $items The array with the SQL UPDATE items
     */
    function updateDisc(array $items): void
    {
        try {
            // The UPDATE query
            $request = "UPDATE disc
                    SET artist_id = :artist_id,
                        disc_genre = :genre,
                        disc_label = :label, 
                        disc_picture = :picture,
                        disc_price = :price, 
                        disc_title = :title, 
                        disc_year = :year
                    WHERE disc_id = :disc_id";

            // Prepares the statement for execution and returns the statement object
            $stmt = $this->pdo->prepare($request);

            // Executes the prepared statement
            $stmt->execute($items);

            // Closes the cursor
            $stmt->closeCursor();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}