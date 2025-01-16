<?php
namespace App\model;

use App\config\Database;
use Exception;
use PDO;

class EnseignantModel {
    private PDO $connecion;

    public function __construct(){
        $this->connecion = Database::getInstance()->getConnection();
    }
}