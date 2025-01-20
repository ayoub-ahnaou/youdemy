<?php
namespace App\class;

class Tag {
    private ?int $tag_id;
    private string $tag_name;

    public function __construct($tag_id = null, $tag_name){
        $this->tag_id = $tag_id;
        $this->tag_name = $tag_name;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}