<?php
namespace App\model;

use App\class\Enrollement;
use App\config\Database;
use Exception;
use PDO;

class EnrollementModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function enrollNow(Enrollement $enrollement) {
        var_dump($enrollement);
        $sql = "INSERT INTO enrollements (cours_id, user_id) VALUES (:cours_id, :user_id)";
        try {
            $stmt = $this->connection->prepare($sql);
            $res = $stmt->execute([
                ":cours_id" => $enrollement->__get("cours_id"), 
                ":user_id" => $enrollement->__get("user_id")
            ]);
            return $res;
        } catch (Exception $e) {
            throw new Exception("failed to enroll in cours: " . $e->getMessage());
        }
    }
}