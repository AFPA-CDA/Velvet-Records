<?php
require_once "connection.php";

class Auth
{
    private $pdo = null;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    /**
     * @param array $items The items to be used for the SQL INSERT
     */
    public function createUser(array $items): void
    {
        try {
            // The INSERT request
            $request = "INSERT INTO `user` (user_firstname, user_lastname, user_email, user_password) 
                        VALUE (:user_firstname, :user_lastname, :user_email, :user_password)";

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
     * @return array The users email
     */
    public function getUsersEmail(): array
    {
        try {
            // The SELECT request
            $request = "SELECT user_email from user";

            // Executes the query
            $query = $this->pdo->query($request);

            // Fetches all the users email
            $usersEmail = $query->fetchAll();

            // Close the cursor
            $query->closeCursor();

            // Return the users email
            return $usersEmail;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}