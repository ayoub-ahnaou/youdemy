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

    public function isUserEnrolledInCours($cours_id, $user_id) {
        $sql = "SELECT * FROM enrollements WHERE cours_id = :cours_id AND user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ":cours_id" => $cours_id, 
                ":user_id" => $user_id
            ]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new Exception("failed to enroll in cours: " . $e->getMessage());
        }
    }

    public function getAllEnrollements() {
        $sql = "SELECT e.*, firstname, lastname, email, title, subtitle, e.created_at, image
            FROM enrollements e
            JOIN courses c ON c.cours_id = e.cours_id
            JOIN users u ON u.user_id = e.user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed to get enrollemnts: " . $e->getMessage());
        }
    }

    public function deleteEnrollement($enroll_id) {
        $sql = "DELETE FROM enrollements WHERE enroll_id = :enroll_id";
        try {
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute([":enroll_id" => $enroll_id]);
        } catch (Exception $e) {
            throw new Exception("Failed to delete enrollement: " . $e->getMessage());
        }
    }
}