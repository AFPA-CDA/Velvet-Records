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