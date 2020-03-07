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
            $request = "INSERT INTO user (user_firstname, user_lastname, user_email, user_password) 
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
     * @param string $userEmail The user email
     * @return The user with the given email or false if an error occured
     */
    public function getUser(string $userEmail)
    {
        try {
            // The SELECT request
            $request = "SELECT * FROM user WHERE user_email = :user_email";

            // Executes the query
            $stmt = $this->pdo->prepare($request);

            // Binds the param to the request
            $stmt->bindParam(':user_email', $userEmail, PDO::PARAM_STR);

            // Executes the statement
            $stmt->execute();

            // Fetches the user email if there is any
            $user = $stmt->fetch();

            // Close the cursor
            $stmt->closeCursor();

            // Returns true if the email has been found otherwise it returns false
            return $user;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param string $userEmail The user email
     * @return bool True if the email has been found otherwise it returns false
     */
    public function hasSameEmail(string $userEmail): bool
    {
        try {
            // The SELECT request
            $request = "SELECT user_email FROM user WHERE user_email = :user_email";

            // Executes the query
            $stmt = $this->pdo->prepare($request);

            // Binds the param to the request
            $stmt->bindParam(':user_email', $userEmail, PDO::PARAM_STR);

            // Executes the statement
            $stmt->execute();

            // Fetches the user email if there is any
            $userEmail = $stmt->fetch();

            // Close the cursor
            $stmt->closeCursor();

            // Returns true if the email has been found otherwise it returns false
            return boolval($userEmail);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}