<?php

use App\model\AdminModel;

require_once "../../../vendor/autoload.php";
$user_id = $_GET["user_id"];
$adminModel = new AdminModel();
$adminModel->activateUser($user_id);

header("location: " . $_SERVER["HTTP_REFERER"]);