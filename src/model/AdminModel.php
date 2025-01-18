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

}