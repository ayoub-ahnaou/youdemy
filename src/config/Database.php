<?php

class Database {
    
    private $connection;
    private static $instance = NULL;

    private function __construct(){
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=youdemy_db", 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::FETCH_ASSOC, PDO::ATTR_DEFAULT_FETCH_MODE);

            echo "Database connected";
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    // function for getting the connection
    public static function getConnection() {
        if(self::$instance == NULL) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // override the clone magic function to not copy the instance of database connection
    public function __clone(){}
}