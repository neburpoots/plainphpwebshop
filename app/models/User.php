<?php
class User {

    private int $user_id;
    private Role $role;
    private string $name;
    private string $email;
    private string $password;
    private string $hash;

    public function getId() {
        return $this->user_id;
    }

    public function getRole() {
        return $this->role;
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

    public function getHash() {
        return $this->hash;
    }

    public function setId(int $user_id) {
        $this->user_id = $user_id;
    }

    public function setRole(Role $role) {
        $this->role = $role;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setPassword(string $password) {
        $this->password = $password;
        $this->setHash();
    }

    public function setHash() {
        $this->hash = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

}
?>