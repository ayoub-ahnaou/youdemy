<?php
namespace App\class;

class Enrollement {
    private ?int $enroll_id;
    private ?string $created_at;
    private int $cours_id;
    private int $user_id;
    private ?string $firstname;
    private ?string $lastname;
    private ?string $email;
    private ?string $title;
    private ?string $subtitle;
    private ?string $image;

    public function __construct($enroll_id = null, $created_at = null, $user_id, $cours_id, $firstname = null, $lastname = null, $email = null, $title = null, $subtitle = null, $image = null){
        $this->enroll_id = intval($enroll_id);
        $this->created_at = $created_at;
        $this->user_id = intval($user_id);
        $this->cours_id = intval($cours_id);
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}