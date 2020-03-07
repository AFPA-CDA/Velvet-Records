<?php

// Creates a Singleton class that helps retrieving the Database connection
class Database
{
    const DB_HOST = "localhost";
    const DB_NAME = "record";
    const DB_USER = "root";
    const DB_PASSWORD = "10495";
    const DB_OPTIONS = [
        // Leave column names as returned by the database driver
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        // Throws exception when an error occurs
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Empty string are converted to NULL
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
        // Sets the default fetch mode to FETCH_OBJ
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

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
                // The PDO connection string
                $connectionStr = sprintf("mysql:host=%s;dbname=%s;charset=utf8", self::DB_HOST, self::DB_NAME);
                // Creates an instance of the PDO object
                self::$PDOInstance = new PDO($connectionStr, self::DB_USER, self::DB_PASSWORD, self::DB_OPTIONS);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        // Otherwise it returns the already created instance
        return self::$PDOInstance;
    }
}