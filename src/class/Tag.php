<?php

class Tag {
    private string $tag_name;

    public function __construct($tag_name){
        $this->tag_name = $tag_name;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}