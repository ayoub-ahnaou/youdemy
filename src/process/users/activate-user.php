<?php

use App\model\PersonModel;

require_once "../../../vendor/autoload.php";
$user_id = $_GET["user_id"];
$personModel = new PersonModel();
$personModel->activateUser($user_id);

header("location: " . $_SERVER["HTTP_REFERER"]);