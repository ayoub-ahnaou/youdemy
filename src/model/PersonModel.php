<?php
namespace App\model;

use App\class\Person;
use App\helpers\Helpers;
use Exception;
use PDO, App\config\Database;

class PersonModel {
    protected PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":email" => $email]);
            $user = $stmt->fetch();
            if(!Helpers::verifyPassword($password ,$user["password"])) return false;
            else return $user;
        } catch (Exception $e) {
            throw new Exception("error while logging in: " . $e->getMessage());
        }
    }
}