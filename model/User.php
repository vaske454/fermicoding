<?php

class User {

    public $db;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public function login($username, $password)
    {
        try {
            // Define query to insert values into the users table
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

            // Prepare the statement
            $query = $this->db->prepare($sql);

            // Bind parameters
            $query->bindParam(":username", $username);
            //$query->bindParam(":password", $password);

            // Execute the query
            $query->execute();


            // Return row as an array indexed by both column name
            $returned_row = $query->fetch(PDO::FETCH_ASSOC);
            // Check if row is actually returned
            if ($query->rowCount() > 0) {
                // Verify hashed password against entered password
                // Define session on successful login
                $_SESSION['session'] = $returned_row['id'];
                $_SESSION['username'] = $returned_row['username'];
                return true;
            }
            else {
                return false;
            }

        } catch (PDOException $e) {
            $errors = [];
            return array_push($errors, $e->getMessage());
        }
    }

    // Check if the user is already logged in
    public function is_logged_in()
    {
        // Check if user session has been set
        if (isset($_SESSION['session'])) {
            return true;
        } else {
            return false;
        }
    }

    // Redirect user
    public function redirect($url)
    {
        header("Location: $url");
    }

    // Log out user
    public function log_out()
    {
        // Destroy and unset active session
        session_destroy();
        unset($_SESSION['session']);
        return true;
    }
}