<?php
require __DIR__ . '/../repositories/productrepository.php';

class ProductService {
    private $repository;

    function __construct()
    {
		$this->repository = new ProductRepository();
    }
    
    public function index() {
        return $this->repository->index();
    }

    public function detail(int $id) {
        return $this->repository->detail($id);
    }
}