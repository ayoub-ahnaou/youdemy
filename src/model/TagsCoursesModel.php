<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class TagsCoursesModel {
    private PDO $connection;
    
    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function assignTagToCourse($tag_id, $cours_id) {
        $sql = "INSERT INTO courses_tags (tag_id, cours_id) VALUES (:tag_id, :cours_id)";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':tag_id' => $tag_id,
                ':cours_id' => $cours_id,
            ]);
        } catch (Exception $e) {
            throw new Exception("failed to add tag to cours: " . $e->getMessage());
        }
    }

    public function removeTagFromCours($cours_id, $tag_id) {
        $sql = "DELETE FROM courses_tags WHERE cours_id = :cours_id AND tag_id = :tag_id";
        try {
            $stm = $this->connection->prepare($sql);
            $stm->execute([
                ':cours_id' => $cours_id,
                ':tag_id' => $tag_id,
            ]);
        } catch (Exception $e) {
            throw new Exception("Error removing tag from cours: " . $e->getMessage());
        }
    }
}