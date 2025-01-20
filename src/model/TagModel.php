<?php
namespace App\model;

use App\class\Tag;
use App\config\Database;
use Exception;
use PDO;

class TagModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    // get all tags from database
    public function getAllTags() {
        $stmt = $this->connection->prepare("SELECT * FROM tags");
        $stmt->execute();
        $res = $stmt->fetchAll();
        $tags = [];
        foreach($res as $tag) {
            $tags[] = new Tag($tag["tag_id"], $tag["tag_name"]);
        }
        return $tags;
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

    public function updateTag(Tag $tag, $tag_id) {
        $sql = "UPDATE tags SET tag_name = :tag_name WHERE tag_id = :tag_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":tag_name" => $tag->__get("tag_name"),
                ":tag_id" => $tag_id,
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed update tag: " . $e->getMessage());
        }
    }

    public function deleteTag($tag_id) {
        $sql = "DELETE FROM tags WHERE tag_id = :tag_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":tag_id" => $tag_id,
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed delete a tag: " . $e->getMessage());
        }
    }
}