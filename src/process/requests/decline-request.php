<?php

use App\model\AdminModel;

require_once '../../../vendor/autoload.php';

$user_id = $_GET["user_id"];
$admin = new AdminModel();
$admin->declineEnseignantRequest($user_id);
$admin->deleteEnseignantRequest($user_id);
header("location: ../../app/pages/requests.php");