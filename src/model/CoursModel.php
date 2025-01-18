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
}