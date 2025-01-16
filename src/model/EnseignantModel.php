<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class EnseignantModel {
    private PDO $connecion;

    public function __construct(){
        $this->connecion = Database::getInstance()->getConnection();
    }

    public function getAllInstructors() {
        try {
            $stmt = $this->connecion->prepare("SELECT * FROM users WHERE role_id = 2");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed get all instractors: " . $e->getMessage());
        }
    }
}