<?php
require __DIR__ . '/../services/productservice.php';

class ProductController
{

    private $productService;

    function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $model = $this->productService->index();

        require __DIR__ . '/../views/products/index.php';
    }

    public function single()
    {
        //$model = $this->productService->detail();

        require __DIR__ . '/../views/article/single.php';
    }
}
