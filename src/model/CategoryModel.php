<?php
namespace App\model;

use App\config\Database;
use Category;
use Exception;
use PDO;

class CategoryModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getAllCategories() {
        $stmt = $this->connection->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}