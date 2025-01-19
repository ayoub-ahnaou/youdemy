<?php

use App\model\AdminModel;

require_once "../../../vendor/autoload.php";
$user_id = $_GET["user_id"];
$adminModel = new AdminModel();
$adminModel->deleteUser($user_id);

header("location: ../../app/pages/list-students.php");