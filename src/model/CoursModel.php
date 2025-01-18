<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class CoursModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllCourses() {
        try {
            $stmt = $this->connection->prepare("SELECT c.*, firstname, lastname, email, gender, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed to retrieve courses: " . $e->getMessage());
        }
    }

    public function getCourseById($cours_id) {
        if($cours_id == "") return null;
        $sql = "SELECT c.*, firstname, lastname, email, gender, specialite, academic_level, category_name, c.category_id
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                AND cours_id = :cours_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":cours_id" => $cours_id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("failed to get cours: " . $e->getMessage());
        }
    }

    public function deleteCours($cours_id) {
        $sql = "DELETE FROM courses WHERE cours_id = :cours_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":cours_id" => $cours_id])) return true;
            return false;
        } catch (Exception $e) {
            throw new Exception("failed to delete cours: " . $e->getMessage());
        }
    }

    public function getAllInstractorsCourses($user_id) {
        $sql = "SELECT c.*, firstname, lastname, email, gender, specialite, academic_level, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                AND c.user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":user_id" => $user_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("Failed to retieve courses students: " . $e->getMessage());
        }
    }
}