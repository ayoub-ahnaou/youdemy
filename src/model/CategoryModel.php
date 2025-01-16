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

    public function createCategory(Category $category) {
        $sql = "INSERT INTO categories (category_name, image) VALUES (:category_name, :image)";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":category_name" => $category->__get("category_name"),
                ":image" => $category->__get("image"),
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed create category: " . $e->getMessage());
        }
    }
}