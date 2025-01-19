<?php

use App\model\CoursModel;

require_once "../../../vendor/autoload.php";

$cours_id = $_GET["cours_id"];
var_dump($cours_id);

$coursModel = new CoursModel();
$res = $coursModel->deleteCours($cours_id);
var_dump($cours_id);

header("location: ../../app/pages/list-courses.php");