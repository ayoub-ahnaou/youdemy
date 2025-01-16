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
}