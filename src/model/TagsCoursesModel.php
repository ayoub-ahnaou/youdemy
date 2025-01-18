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
}