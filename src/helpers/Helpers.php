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
}