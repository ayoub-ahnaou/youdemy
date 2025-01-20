<?php

use App\model\RequestModel;

require_once '../../../vendor/autoload.php';

$user_id = $_GET["user_id"];
$requestModel = new RequestModel();
$requestModel->declineEnseignantRequest($user_id);
$requestModel->deleteEnseignantRequest($user_id);
header("location: ../../app/pages/list-requests.php");