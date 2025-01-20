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

    // functions to activate, ban or delete users
    public function activateUser($user_id) {
        $sql = "UPDATE users SET isActive = 1 WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function banUser($user_id) {
        $sql = "UPDATE users SET isActive = 0 WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
    }

    public function deleteUser($user_id) {
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        try {
            $stmt = $this->connection->prepare($sql);
            if($stmt->execute([":user_id" => $user_id])) return true;
        } catch (Exception $e) {
            throw new Exception("Request failed: " . $e->getMessage());
        }
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
}