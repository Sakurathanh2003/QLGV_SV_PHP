<?php
class Teacher {
    public $id;
    public $name;
    public $email;
    public $gender;
    public $address;
    public $phoneNumber;
    public $birthDay;

    public function __construct($id, $name, $email, $gender, $address, $phoneNumber, $birthDay) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->gender = $gender;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->birthDay = $birthDay;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_gender() {
        return $this->gender;
    }

    public function get_address() {
        return $this->address;
    }

    public function get_phoneNumber() {
        return $this->phoneNumber;
    }

    public function get_birthDay() {
        return $this->birthDay;
    }
}
?>