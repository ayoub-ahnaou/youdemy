<?php
namespace App\model;
use App\config\Database;
use Exception;
use PDO;

class RequestModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function createRequest($user_id) {
        $sql = "INSERT INTO requests (user_id) VALUES (:user_id)";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }
}