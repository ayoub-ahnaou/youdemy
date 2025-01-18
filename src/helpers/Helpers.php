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
}