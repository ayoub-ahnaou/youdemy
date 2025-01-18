<?php
namespace App\class;

class Enrollement {
    private int $cours_id;
    private int $user_id;

    public function __construct($user_id, $cours_id){
        $this->user_id = intval($user_id);
        $this->cours_id = intval($cours_id);
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}