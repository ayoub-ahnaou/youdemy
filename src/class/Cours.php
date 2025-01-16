<?php
namespace App\class;

class Cours {
    private string $title;
    private string $subtitle;
    private string $langues;
    private string $description;
    private string $type;
    private int $category;
    private string $image;
    private ?string $document;
    private ?string $video;
    private int $user_id;

    public function __construct($title, $subtitle, $langues, $description, $type, $category, $image, $user_id, $document = null, $video = null){
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->langues = $langues;
        $this->description = $description;
        $this->type = $type;
        $this->category = $category;
        $this->image = $image;
        $this->user_id = $user_id;
        $this->document = $document;
        $this->video = $video;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}