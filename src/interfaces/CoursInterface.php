<?php
namespace App\interfaces;

use App\class\Cours;

interface CoursInterface {
    public function createCours(Cours $cours);
    public function displayCours($cours_id);
    public function updateCours(Cours $cours, $cours_id);
}