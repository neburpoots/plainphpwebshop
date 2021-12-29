<?php

class Task {

    private int $id;
    private string $name;
    private ?int $priority;
    private bool $is_Completed;


    function __construct()
    {
        $this->taskService = new TaskService();
    }



    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function getIs_Completed() {
        return $this->is_Completed;
    }
}
?>