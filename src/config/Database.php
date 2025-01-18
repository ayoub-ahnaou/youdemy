<?php
namespace App\config;
use PDO, Exception, PDOException;

class Database {
    
    private static $instance;
    private $pdo;

    private function __construct() {
        try {
            $username = 'root'; $password = '';
            $this->pdo = new PDO('mysql:host=localhost;dbname=youdemy_db', $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->pdo->setAttribute(PDO::FETCH_ASSOC, PDO::ATTR_DEFAULT_FETCH_MODE); 
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    // override the clone magic function to not copy the instance of database connection
    public function __clone(){}
}