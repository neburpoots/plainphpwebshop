<?php
require __DIR__ . '/../autoload.php';

class UserService {

    private $repository;

    function __construct()
    {
		$this->repository = new UserRepository();
    }

    public function login(User $user) {
        return $this->repository->login($user);
    }

    public function register(User $user) {
        return $this->repository->register($user);
    }

    public function checkEmail(string $email) {
        return $this->repository->checkEmail($email);
    }
}