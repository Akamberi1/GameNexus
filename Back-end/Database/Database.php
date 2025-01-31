<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'gamenexus'; // Your database name
    private $username = 'root'; // Default XAMPP username
    private $password = ''; // Default XAMPP password
    private $conn;

    // Constructor to establish the connection
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to return the connection object
    public function getConnection() {
        return $this->conn;
    }
}
