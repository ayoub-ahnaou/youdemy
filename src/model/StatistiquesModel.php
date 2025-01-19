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

    // get the number of courses created by in instractor
    public function getCountCoursesByInstarctor($user_id) {
        $sql = "SELECT COUNT(*) AS total_courses
            FROM courses WHERE user_id = :user_id";
        try {    
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":user_id" => $user_id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("Failed to get stats: " . $e->getMessage());
        }
    }

    // get the top three instractor who have the most enrollements courses
    public function getTopThreeInstarctors() {
        $sql = "SELECT users.user_id, firstname, lastname, specialite, academic_level, gender, COUNT(enrollements.enroll_id) AS total_enrollments
                FROM users
                JOIN courses ON users.user_id = courses.user_id
                JOIN enrollements ON courses.cours_id = enrollements.cours_id
                WHERE users.role_id = 2
                GROUP BY users.user_id, firstname
                ORDER BY total_enrollments DESC
                LIMIT 3";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get the top course from the enrollement status
    public function getTopPerformingCourse() {
        $sql = "SELECT e.cours_id, count(e.user_id) AS 'number_student', c.*
            FROM enrollements e
            JOIN courses c ON c.cours_id = e.cours_id
            GROUP BY e.user_id 
            ORDER by number_student 
            DESC LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // get total of courses
    public function getTotalCourses() {
        $sql = "SELECT COUNT(*) as 'total_courses' FROM courses";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // get total of students
    public function getTotalStudents() {
        $sql = "SELECT COUNT(*) as 'total_students' FROM users WHERE role_id = 3";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // get total of instractors
    public function getTotalInstractors() {
        $sql = "SELECT COUNT(*) as 'total_instractors' FROM users WHERE role_id = 2";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    // get number of course in each category
    public function getNumberCoursesInCategory() {
        $sql = "SELECT COUNT(cours_id) AS 'nbre_courses', ca.category_name
                FROM courses co
                JOIN categories ca
                ON ca.category_id = co.category_id
                GROUP BY co.category_id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get number of course in each category
    public function getTotalEnrollements() {
        $sql = "SELECT COUNT(*) AS 'nbre_enrollements'
            FROM enrollements";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}