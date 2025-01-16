<?php
namespace App\model;
use App\config\Database, PDO;
use Exception;

class EtudiantModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function upgradeUserInfos($user_id, $age, $gender, $address, $cin, $specialite, $acad_level, $avatar) {
        $sql = "UPDATE users 
        SET age = :age, gender = :gender, address = :address, cin = :cin, specialite = :specialite, academic_level = :academic_level, avatar = :avatar
        WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":age" => $age,
                ":gender" => $gender,
                ":address" => $address,
                ":cin" => $cin,
                ":specialite" => $specialite,
                ":academic_level" => $acad_level,
                ":avatar" => $avatar,
                ":user_id" => $user_id,
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function getAllStudents() {
        $sql = "SELECT * FROM users WHERE role_id = 3";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            throw new Exception("failed to retrieve students: " . $e->getMessage());
        }
    }
}