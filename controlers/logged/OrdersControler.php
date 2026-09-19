<?php
require_once __DIR__ . "/../../models/OrdersModel.php";

class OrdersControler {
    private $ordersModel;

    public function __construct() {
        $this->ordersModel = new OrdersModel();
    }

    public function addOrder($product, $size, $color, $user, $quantity) {
        if (empty($product) || empty($size) || empty($color) || empty($user) || empty($quantity)) {
            return false; 
        }
        return $this->ordersModel->addOrderToDatabase($product, $size, $color, $user, $quantity);
    }
    public function getOrdersByPosterAndPending($email) {
        return $this->ordersModel->getOrdersByPosterAndPending($email);
    }
    public function confirmOrder($email) {
        return $this->ordersModel->confirmOrder($email);
    }
    public function getAllOrders() {
        return $this->ordersModel->getAllOrders();
    }
    public function getOrderById($id) {
        return $this->ordersModel->getOrderById($id);
    }
    public function acceptOrder($id){
        return $this->ordersModel->acceptOrder($id);
    }
    public function refuseOrder($id){
        return $this->ordersModel->refuseOrder($id);
    }
    public function getOrdersByPoster($email) {
        return $this->ordersModel->getOrdersByPoster($email);

    }
    public function confirmSingleOrder($id,$email){
        return $this->ordersModel->confirmSingleOrder($id,$email);
    }
    public function cancelSingleOrder($id,$email){
        return $this->ordersModel->cancelSingleOrder($id,$email);
    }
    
    
    
}
?>
