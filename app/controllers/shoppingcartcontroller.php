<?php
require __DIR__ . '/../autoload.php';

class ShoppingCartController {
    
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

	public function index() {
        if (!isset($_SESSION['shoppingcart'])) {
            $shoppingCart = new ShoppingCart();
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
        }
        
		require __DIR__ . '/../views/shoppingcart/index.php';
	}

    public function addToCart() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);
            $product = $this->productService->detail($id);
            $cartItem = new CartProduct($product, 1);
            
            if (!isset($_SESSION['shoppingcart'])) {
                $shoppingCart = new ShoppingCart();
                $_SESSION["shoppingcart"] = serialize($shoppingCart);
            }

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->addToCart($cartItem);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function increaseAmount() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->increaseAmount($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function decreaseAmount() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->decreaseAmount($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }

    public function removeItem() {
        try {
            $id = (int)htmlspecialchars($_GET["id"]);

            $shoppingCart = unserialize($_SESSION["shoppingcart"]);
            $shoppingCart->deleteFromCart($id);
            $_SESSION["shoppingcart"] = serialize($shoppingCart);
            header('Location: /shoppingcart');
        } catch(Exception $e) {
            http_response_code(404);
        }
    }
}
