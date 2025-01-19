<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class AdminModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function acceptEnseignantRequest($user_id) {
        $sql = "UPDATE users SET role_id = 2, isRequested = 1 WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function declineEnseignantRequest($user_id) {
        $sql = "UPDATE users SET isRequested = 0, gender = null, cin = null, address = null, age = null, specialite = null, academic_level = null, avatar = null
        WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function deleteEnseignantRequest($user_id) {
        $sql = "DELETE FROM requests WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    // functions to activate, banne or delete users
    public function activateUser($user_id) {
        $sql = "UPDATE users SET isActive = 1 WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function banUser($user_id) {
        $sql = "UPDATE users SET isActive = 0 WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

}