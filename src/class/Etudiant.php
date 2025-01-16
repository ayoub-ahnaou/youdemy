<?php

use App\class\Person;

class Etudiant extends Person {

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}