<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class StatistiquesModel {
    private PDO $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    // get the total of students enrolled in the courses of an instractor
    public function getCountStudentsInCourseByInstructor($user_id) {
        $sql = "SELECT SUM(total_students) AS total_students
            FROM (
                SELECT COUNT(enrollements.enroll_id) AS total_students
                FROM courses
                LEFT JOIN enrollements ON courses.cours_id = enrollements.cours_id
                WHERE courses.user_id = :user_id
                GROUP BY courses.cours_id
            ) AS subquery";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":user_id" => $user_id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("Failed to get stats: " . $e->getMessage());
        }
    }
}