<?php
namespace App\model;

use App\class\Category;
use App\config\Database;
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
        $res = $stmt->fetchAll();
        $categories = [];
        foreach($res as $obj) {
            $categories[] = new Category($obj["category_id"], $obj["category_name"], $obj["image"]);
        }
        return $categories;
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

    public function updateCategory(Category $category, $category_id) {
        $sql = "UPDATE categories SET category_name = :category_name, image = :image 
            WHERE category_id = :category_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":category_name" => $category->__get("category_name"),
                ":image" => $category->__get("image"),
                ":category_id" => $category_id,
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed update category: " . $e->getMessage());
        }
    }

    public function getCategoryByID($category_id) {
        $sql = "SELECT * FROM categories WHERE category_id = :category_id";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":category_id" =>$category_id]);
            $res = $stmt->fetch();
            $category = new Category($res["category_id"], $res["category_name"], $res["image"]);
            return $category;
        } catch (Exception $e) {
            throw new Exception("Failed to get category by id: " . $e->getMessage());
        }
    }

    public function deleteCategory($category_id) {
        $sql = "DELETE FROM categories WHERE category_id = :category_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":category_id" => $category_id,
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Failed delete a category: " . $e->getMessage());
        }
    }
}