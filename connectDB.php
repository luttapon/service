<?php
class ConnectDB{
    private $connDB;
    private $host = "82.25.121.181";
    private $username = "u231198616_dti268";
    private $password = "Dti028074500";
    private $dbName = "u231198616_dti268_db";

    // Connect to the database
    public function getConnection() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
        try {
            $this->connDB = new PDO($dsn, $this->username, $this->password);
            $this->connDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connDB;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }   
    }
}