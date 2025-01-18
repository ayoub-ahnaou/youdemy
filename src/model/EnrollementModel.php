<?php
namespace App\model;

use App\class\Enrollement;
use App\config\Database;
use Exception;
use PDO;

class EnrollementModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }
}