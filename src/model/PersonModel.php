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

    public function register(Person $person) {
        $sql = "INSERT INTO users (firstname, lastname, phone, email, password) 
        VALUES (:firstname, :lastname, :phone, :email, :password)";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([
                ":firstname" => $person->__get("firstname"),
                ":lastname" => $person->__get("lastname"),
                ":phone" => $person->__get("phone"),
                ":email" => $person->__get("email"),
                ":password" => $person->__get("password")
            ])) return true;
        } catch (Exception $e) {
            throw new Exception("Error while registring: " . $e->getMessage());
        }
    }

    public function isEmailExist($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([":email" => $email]);
            return $stmt->rowCount();
        } catch (Exception $e) {
            throw new Exception("Error while searching for user by email: " . $e->getMessage());
        }
    }
}