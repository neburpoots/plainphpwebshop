<?php

class Order {
    
    private int $order_id;
    private int $user_id;
    private DateTime $orderDate;
    private $order_lines;

    public function __construct()
    {
        $this->order_lines = array();
    }

    public function setOrder_id(int $order_id) {
        $this->order_id = $order_id;
    }

    public function setUser_id(int $user_id) {
        $this->user_id = $user_id;
    }

    public function setOrderDate(DateTime $orderDate) {
        $this->orderDate = $orderDate;
    }

    public function getId() {
        return $this->order_id;
    }

    public function getUser_Id() {
        return $this->user_id;
    }

    public function getOrderdate() {
        return $this->orderDate;
    }

    public function getOrder_Lines() {
        return $this->order_lines;
    }

    public function addOrder_Line(Order_Line $order_line) {
        $this->order_lines[] = $order_line;
    }

    public function setOrder_Lines(array $order_lines) {
        $this->order_lines[] = $order_lines;
    }

    public function getTotal() {
        $total = 0;
        foreach($this->order_lines as $order_line) {
            $total += ($order_line->getProduct()->getPrice() * $order_line->getQuantity());
        }
        return $total;
    }
}