<?php
class Account {
    public $name;
    public $email;
    public $password;
    public $role;
    public function __construct($name, $email, $password, $role) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }
    public function getRole() {
        return $this->role;
    }
}
?>