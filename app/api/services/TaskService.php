<?php
require __DIR__ . '/../repositories/TaskRepository.php';

class TaskService {

    private $taskRepository;

    function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    public function index() {
        return $this->taskRepository->index();
    }

    public function detail(string $id) {
        return $this->taskRepository->detail($id);
    }

    public function create(array $data) {
        return $this->taskRepository->create($data);
    }

    public function update(string $id, array $data) {
        return $this->taskRepository->update($id, $data);
    }

    public function delete(string $id) {
        return $this->taskRepository->delete($id);
    }
}