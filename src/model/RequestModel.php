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

    // check if the user already sent a request to be enseignant
    public function checkIfRequestSent($user_id) {
        $sql = "SELECT * FROM requests WHERE user_id = (:user_id)";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":user_id" => $user_id]);
            if($stmt->rowCount() > 0) return true;
            else return false;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    // retrieve all users requests
    public function getAllRequests() {
        $sql = "SELECT u.*, created_at FROM users u JOIN requests r ON r.user_id = u.user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }
}