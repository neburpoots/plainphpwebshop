<?php


class ShoppingCart {
    private $cartProducts;

    public function __construct()
    {
        $this->cartProducts = array();
    }

    public function getCartProducts() {
        return $this->cartProducts;
    }

    public function getTotal() {
        $total = 0;
        foreach($this->cartProducts as $cartProduct) {
            $total += ($cartProduct->getProduct()->getPrice() * $cartProduct->getAmount());
        }
        return $total;
    }

    public function addToCart(CartProduct $newCartProduct) {
        foreach($this->cartProducts as $cartProduct) {
            if($cartProduct->getProduct()->getId() == $newCartProduct->getProduct()->getId()) {
                $cartProduct->addOne();
                return;
            }
        }
        $this->cartProducts[] = $newCartProduct;
    }

    public function increaseAmount(int $id) {
        foreach($this->cartProducts as $cartProduct) {
            if($cartProduct->getProduct()->getId() == $id) {
                $cartProduct->addOne();
            }
        }
    }

    public function decreaseAmount(int $id) {
        foreach($this->cartProducts as $cartProduct) {
            if($cartProduct->getProduct()->getId() == $id) {
                if($cartProduct->getAmount() <= 1) {
                    $this->deleteFromCart($id);
                } else {
                    $cartProduct->deleteOne();
                }
            }
        }
    }


    public function deleteFromCart(int $id) {
        foreach($this->cartProducts as $cartProduct) {
            if($cartProduct->getProduct()->getId() == $id) {
                $key = array_search($cartProduct, $this->cartProducts);
                unset($this->cartProducts[$key]);
            }
        }
    }
}