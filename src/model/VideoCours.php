<?php
namespace App\model;

use App\class\Cours;
use App\config\Database;
use App\interfaces\CoursInterface;
use Exception;
use PDO;

class VideoCours extends CoursModel implements CoursInterface {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getInstance()->getConnection();
    }

}