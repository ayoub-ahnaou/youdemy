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
}