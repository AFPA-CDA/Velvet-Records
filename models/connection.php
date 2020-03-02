<?php

// Creates a Singleton class that helps retrieving the Database connection
class Database
{
    protected static $PDOInstance;

    /**
     * @return PDO The database instance
     */
    public static function getInstance(): PDO
    {
        // If the instance does not exist yet it creates it
        if (!isset(self::$PDOInstance)) {
            // The try catch block is used to run code and catch the errors uf there are any
            try {
                // Array of the used options for the PDO instance
                $options = [
                    // Leave column names as returned by the database driver
                    PDO::ATTR_CASE => PDO::CASE_NATURAL,
                    // Throws exception when an error occurs
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    // Empty string are converted to NULL
                    PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
                    // Sets the default fetch mode to FETCH_OBJ
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ];

                // Creates an instance of the PDO object
                self::$PDOInstance = new PDO("mysql:host=localhost;dbname=record;charset=utf8", "root", "root", $options);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }

        // Otherwise it returns the already created instance
        return self::$PDOInstance;
    }
}