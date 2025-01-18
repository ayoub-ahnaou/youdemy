<?php
namespace App\model;

use App\class\Cours;
use App\config\Database;
use App\interfaces\CoursInterface;
use Exception;
use PDO;

class DocumentCours extends CoursModel {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

}