<?php
include_once 'config.php';
class Database {

    public function __construct() {}

    public function connect() {
        $this->conn = null;
        global $dbHost, $dbName, $dbUser, $dbPassword;
        try {
            $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
            $this->conn = new PDO($dsn, $dbUser, $dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully!";
        } catch(PDOException $e) {
            //echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
    public function close() {
        $this->conn = null;
        //echo "Connection closed successfully!";
    }
}




?>
