<?php

class Role {
    
    private int $role_id;
    private string $name;

    public function setRole_id(int $role_id) {
        $this->role_id = $role_id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getId() {
        return $this->role_id;
    }

    public function getName() {
        return $this->name;
    }
}