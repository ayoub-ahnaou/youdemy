<?php
namespace App\model;

use App\class\Cours;
use App\config\Database;
use App\interfaces\CoursInterface;
use Exception;
use PDO;

class DocumentCours extends CoursModel implements CoursInterface {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function createCours(Cours $cours) {
        $sql = "INSERT INTO courses (title, subtitle, description, image, langues, type, category_id, content, user_id) 
        VALUES (:title, :subtitle, :description, :image, :langues, :type, :category_id, :content, :user_id)";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":title" => $cours->__get("title"),
                ":subtitle" => $cours->__get("subtitle"),
                ":description" => $cours->__get("description"),
                ":image" => $cours->__get("image"),
                ":langues" => $cours->__get("langues"),
                ":type" => $cours->__get("type"),
                ":category_id" => $cours->__get("category"),
                ":content" => $cours->__get("document"),
                ":user_id" => $cours->__get("user_id")
            ]))
            return $this->connection->lastInsertId();
            else return false;
        } catch (Exception $e) {
            throw new Exception("Cours creation failed: " . $e->getMessage());
        }
    }

}