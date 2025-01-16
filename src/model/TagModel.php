<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;
use Tag;

class TagModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }
}