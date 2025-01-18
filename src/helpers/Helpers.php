<?php
namespace App\helpers;

use App\class\Person;
use App\config\Database;
use DateTime;
use Exception;
use PDO;

class Helpers {
    private PDO $connection;
    
    public function __construct(){ $this->connection = Database::getInstance()->getConnection(); }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $passwordHashed) {
        return password_verify($password, $passwordHashed);
    }

    public static function comparePasswords($password, $password_repeat) {
        return $password != $password_repeat ? false : true;
    }

    public static function filterInput($value) {
        $value = trim($value); 
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); 
        return $value;
    }

    public static function validateAge($age) {
        if($age < 18 || $age > 65) return "age must be between 18 and 35";
    }
}