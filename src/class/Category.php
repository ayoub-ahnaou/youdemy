<?php
namespace App\class;

class Category {
    private ?int $category_id;
    private string $category_name;
    private $image;

    public function __construct($category_id = null, $category_name, $image){
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->image = $image;
    }
    
    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}