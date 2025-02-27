<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class CoursModel {
    private PDO $connection;
    public static $coursParPage = 4;

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

    public function nbreCourses() {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as total FROM courses");
        $stmt->execute();
        $res = $stmt->fetch();
        return $res["total"];
    }

    public function searchForCourses($value) {
        $search = "%$value%";
        $sql = "SELECT c.*, firstname, lastname, email, gender, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                WHERE title LIKE :value OR subtitle LIKE :value OR description LIKE :value
                OR firstname LIKE :value OR lastname = :value
                ORDER BY c.created_at DESC LIMIT 4";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":value" => $search]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed te search for cours: " . $e->getMessage());
        }
    }

    public function getCoursesFiltered($page, $category_id = 0) {
        $offset = self::$coursParPage * ( $page - 1 );
        if($category_id > 0) {
            $sql = "SELECT c.*, firstname, lastname, email, gender, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                AND c.category_id = :category_id 
                ORDER BY c.created_at DESC LIMIT :offset, :limit";
                try {
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindValue(":category_id", $category_id);
                    $stmt->bindValue(":offset", $offset, \PDO::PARAM_INT);
                    $stmt->bindValue(":limit", self::$coursParPage, \PDO::PARAM_INT);
                    $stmt->execute();
                    return $stmt->fetchAll();
                } catch (Exception $e) {
                    throw new Exception("failed to filter courses: " . $e->getMessage());
                }
        } else {
            $sql = "SELECT c.*, firstname, lastname, email, gender, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                ORDER BY c.created_at DESC LIMIT :offset, :limit";
                try {
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bindValue(":offset", $offset, \PDO::PARAM_INT);
                    $stmt->bindValue(":limit", self::$coursParPage, \PDO::PARAM_INT);
                    $stmt->execute();
                    return $stmt->fetchAll();
                } catch (Exception $e) {
                    throw new Exception("failed to filter courses: " . $e->getMessage());
                }
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

    public function getLastCoursAdded() {
        try {
            $stmt = $this->connection->prepare("SELECT c.*, firstname, lastname, email, gender, category_name 
                FROM courses c
                JOIN users u ON u.user_id = c.user_id
                JOIN categories ca ON ca.category_id = c.category_id
                ORDER BY c.created_at DESC LIMIT 5");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed to retrieve courses: " . $e->getMessage());
        }
    }

    public function getCoursesEnrolledOfUser($user_id) {
        $sql = "SELECT c.*, firstname, lastname, gender
            FROM courses c
            JOIN enrollements e ON e.cours_id = c.cours_id
            JOIN users u ON u.user_id = c.user_id
            AND e.user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":user_id" => $user_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed to get courses: " . $e->getMessage());
        }
    }
}