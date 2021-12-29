<?php
class Product {

    private int $product_id;
    private string $name;
    private float $price;
    private int $stock;
    private string $img;
    private string $description;

    public function getId() {
        return $this->product_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getImg() {
        return $this->img;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId(int $id) {
        $this->product_id = $id;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setPrice(float $price) {
        $this->price = $price;
    }

    public function setStock(int $stock) {
        $this->stock = $stock;
    }

    public function setImg(string $img) {
        $this->img = $img;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }
    
}
?>