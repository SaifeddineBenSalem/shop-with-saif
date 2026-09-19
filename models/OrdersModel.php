<?php
require_once "Database1.php";

class OrdersModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function addOrderToDatabase($product, $size, $color, $poster, $quantity) {
        $query = "INSERT INTO orders (product, size, color, poster, quantity) 
                  VALUES (:product, :size, :color, :poster, :quantity)";
        
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":product", $product);
        $stmt->bindParam(":size", $size);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":poster", $poster);
        $stmt->bindParam(":quantity", $quantity);

        return $stmt->execute();
    }

    public function getOrdersByPosterAndPending($email) {
        $query = "SELECT * FROM orders WHERE poster = :poster AND status = 'pending'";
        
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":poster", $email);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function confirmOrder($email) {
        $query = "UPDATE orders SET status = 'confirmed' WHERE poster = :email AND status = 'pending'";
    
          $stmt = $this->pdo->prepare($query);

        // Bind the parameter with the correct placeholder
         $stmt->bindParam(":email", $email);

         return $stmt->execute();
    }
    public function cancelSingleOrder($id, $email) {
        $query = "UPDATE orders SET status = 'cancelled' WHERE poster = :email AND status = 'pending' AND id = :id";
        
        $stmt = $this->pdo->prepare($query);
    
        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
    
        // Execute the statement and return the result
        return $stmt->execute();
    }
    
    public function confirmSingleOrder($id, $login) {
        try {
            $stmt = $this->pdo->prepare("UPDATE orders SET status = 'confirmed' WHERE id = :id AND poster = :poster");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':poster', $login, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    
    public function getOrderById($id) {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllOrders() {
        $query = "SELECT * FROM orders";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function acceptOrder($id) {
        $query = "UPDATE orders SET status = 'Accepted' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function refuseOrder($id) {
        $query = "UPDATE orders SET status = 'Refused' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getOrdersByPoster($email){
        $query = "SELECT * FROM orders WHERE poster = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
