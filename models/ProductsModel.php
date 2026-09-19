<?php
require_once "Database1.php";

class ProductsModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getProductsByCategoryIdAndNotArchived($id) {
        $query = "SELECT * FROM products WHERE category = :category AND status = :status";
        $stmt = $this->pdo->prepare($query);
        $statusNow = "Active";
        $stmt->bindParam(":category", $id);
        $stmt->bindParam(":status", $statusNow);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProductsByPoster($email) {
        $query = "SELECT * FROM products WHERE poster = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function archiveProduct($id) {
        $query = "UPDATE products SET status = 'Archived' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function restoreProduct($id) {
        $query = "UPDATE products SET status = 'Active' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function updateProduct($id,$productName, $categoryId, $productPrice, $updatedBy, $productDescription, $productPromo, $allSizes, $allColors) {
        try {
            $pdo = $this->model->pdo;
            $query = "UPDATE products 
                      SET name = :name, 
                          category = :category, 
                          price = :price, 
                          modified_by_name = :updatedBy, 
                          description = :description, 
                          promo = :promo, 
                          sizes = :sizes, 
                          colors = :colors, 
                          modified_by_time = NOW() 
                      WHERE id = :id";

            $stmt = $this->pdo->prepare($query);

            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':price', $productPrice);
            $stmt->bindParam(':updatedBy', $updatedBy);
            $stmt->bindParam(':description', $productDescription);
            $stmt->bindParam(':promo', $productPromo);
            $stmt->bindParam(':sizes', $allSizes);
            $stmt->bindParam(':colors', $allColors);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Assuming 'productId' is passed in POST data

            if ($stmt->execute()) {
                return ["success" => true, "message" => "Product updated successfully"];
            } else {
                return ["success" => false, "message" => "Failed to update product"];
            }
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Error: " . $e->getMessage()];
        }
    }
    public function addProduct($productName, $categoryId, $productPrice, $createdBy, $productDescription, $productPromo, $allSizes, $allColors,$fileName) {
        try {
            if ($productPromo === null || $productPromo === ""){
                $query = "INSERT INTO products 
                      (name, category, price, poster, description, sizes, colors,photo) 
                      VALUES 
                      (:name, :category, :price, :createdBy, :description, :sizes, :colors,:photo)";
            } else {
            $query = "INSERT INTO products 
                      (name, category, price, poster, description, promo, sizes, colors,photo) 
                      VALUES 
                      (:name, :category, :price, :createdBy, :description, :promo, :sizes, :colors,:photo)";
            }
    
            $stmt = $this->pdo->prepare($query);
    
            $stmt->bindParam(':name', $productName);
            $stmt->bindParam(':category', $categoryId, PDO::PARAM_INT);
            $stmt->bindParam(':price', $productPrice);
            $stmt->bindParam(':createdBy', $createdBy);
            $stmt->bindParam(':description', $productDescription);
            if ($productPromo != null)
            $stmt->bindParam(':promo', $productPromo);
            $stmt->bindParam(':sizes', $allSizes);
            $stmt->bindParam(':colors', $allColors);
            $stmt->bindParam(':photo', $fileName);
            if ($stmt->execute()) {
                return ["success" => true, "message" => "Product added successfully"];
            } else {
                return ["success" => false, "message" => "Failed to add product"];
            }
        } catch (PDOException $e) {
            return ["success" => false, "message" => "Error: " . $e->getMessage()];
        }
    }
    
}
?>
