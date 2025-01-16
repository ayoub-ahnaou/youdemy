<?php
namespace App\model;
use App\config\Database, PDO;
use Exception;

class EtudiantModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }
}