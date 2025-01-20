<?php

use App\class\Enrollement;
use App\model\EnrollementModel;

require_once "../../../vendor/autoload.php";

$user_id = $_GET["user_id"];
$cours_id = $_GET["cours_id"];

$enrollModel = new EnrollementModel();
$enroll = new Enrollement(null, null, $user_id, $cours_id);

$enrollModel->enrollNow($enroll);
header("location: ../../app/pages/details-cours.php?cours_id=$cours_id");