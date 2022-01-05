<?php
class CartProduct {

private Product $product;
private int $amount;

public function __construct(Product $product, int $amount) {
    $this->product = $product;
    $this->amount = $amount;
}

public function getProduct() {
    return $this->product;
}

public function getAmount() {
    return $this->amount;
}


public function addOne() {
    $this->amount++;
}

public function deleteOne() {
    if($this->amount > 1) {
        $this->amount--;
    }
}


}