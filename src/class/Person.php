<?php
namespace App\class;

class Person {
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $phone;
    private string $password;

    public function __construct($firstname, $lastname, $email, $phone, $password){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}