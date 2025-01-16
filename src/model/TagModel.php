<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;
use Tag;

class TagModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    // get all tags from database
    public function getAllTags() {
        $stmt = $this->connection->prepare("SELECT * FROM tags");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function createTag(Tag $tag) {
        $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":tag_name" => $tag->__get("tag_name"),
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed create tag: " . $e->getMessage());
        }
    }
}