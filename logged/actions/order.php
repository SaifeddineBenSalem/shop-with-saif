<?php
class Order {
	private $id;
	private $db;
	private $product;
	private $posting_date;
	private $size;
	private $color;
	private $poster;
	private $status;
	private $quantity;
	public function getProduct(){
		return $this->product;
	}
	public function getId(){
		return $this->id;
	}
	public function getPostingDate(){
		return $this->posting_date;
	}
	public function getStatus(){
		return $this->status;
	}
	public function getPoster(){
		return $this->poster;
	}
	public function getQuantity(){
		return $this->quantity;
	}
	public function __construct($db,$product,$size,$color,$poster,$quantity ){
		$this->db=$db;
		$this->product=$product;
		$this->size=$size;
		$this->color=$color;
		$this->poster=$poster;
		$this->quantity=$quantity;
	}
	public function addOrder(){
		$query="INSERT into orders (product,size,color,poster,quantity) values (:product,:size,:color,:poster,:quantity)";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(":product",$this->product);
		$stmt->bindParam(":size",$this->size);
		$stmt->bindParam(":color",$this->color);
		$stmt->bindParam(":poster",$this->poster);
		$stmt->bindParam(":quantity",$this->quantity);
		if ($stmt->execute())
			return true;
		return false;
	}
	public function getPendingOrdersByPoster(){
		$query ="SELECT * from orders where poster= :poster and status = :status";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(":poster",$this->poster);
		$statusOrder="pending";
		$stmt->bindParam(":status",$statusOrder);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$orders = [];
		foreach ($results as $result){
			$order = new Order($this->db,$result["product"],$result["size"],$result["color"],$result["poster"],$result["quantity"]);
			$order->id= $result["id"];
			$order->posting_date= $result["posting_date"];
			$orders[] = $order;
		}
		return $orders;
	}
	public static function confirmOrder($email,$db1){
		$query ="UPDATE orders set status=:newStatus where poster=:poster and status=:oldStatus";
		$stmt = $db1->prepare($query);
		$statusOrder="pending";
		$stmt->bindParam(":oldStatus",$statusOrder);
		$stmt->bindParam(":poster",$email);
		$newStatus="confirmed";
		$stmt->bindParam(":newStatus",$newStatus);
		if ($stmt->execute())
			return true;
		return false;
	}
	public static function getAllOrders($db) {
        $query = "SELECT * FROM orders";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $orders = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $order = new Order($db, $row['product'], $row['size'], $row['color'], $row['poster'], $row['quantity']);
            $order->status =  $row['status'];
            $order->id = $row['id']; // Set the id property
            $order->posting_date = $row['posting_date']; // Set the posting_date property
            $orders[] = $order;
        }
        return $orders; // Return an array of Order objects
    }

}
?>