<?php
namespace App\class;
use App\class\Person;

class Enseignant extends Person {
    private int $age;
    private string $address;
    private string $cin;
    private string $specialite;
    private string $niveau_academique;
    private string $photo;

    public function __construct($firstname, $lastname, $email, $phone, $password, $age, $address, $cin, $specialite, $niveau_academique, $photo) {
        parent::__construct($firstname, $lastname, $email, $phone, $password);
        $this->age = $age;
        $this->address = $address;
        $this->cin = $cin;
        $this->specialite = $specialite;
        $this->niveau_academique = $niveau_academique;
        $this->photo = $photo;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}