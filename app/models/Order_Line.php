<?php

class Order_Line {
    
    private int $order_line_id;
    private int $order_id;
    private Product $product;
    private int $quantity;

    public function setOrder_Line_Id(int $order_line_id) {
        $this->order_line_id = $order_line_id;
    }

    public function setOrder_id(int $order_id) {
        $this->order_id = $order_id;
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;
    }

    public function getId() {
        return $this->order_line_id;
    }

    public function getOrder_id() {
        return $this->order_id;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getQuantity() {
        return $this->quantity;
    }
}