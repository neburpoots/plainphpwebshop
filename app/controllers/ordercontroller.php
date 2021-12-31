<?php
require __DIR__ . '/../autoload.php';

class OrderController
{
    private OrderService $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }

    public function myOrders()
    {


        $model = $this->orderService->getOrdersForPerson();

        
        require __DIR__ . '/../views/users/myorders.php';
    }
}
