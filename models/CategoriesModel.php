<?php
require_once "Database1.php";

class CategoriesModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getCategoryByName($name) {
        $query = "SELECT * FROM categories WHERE name = :name";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addCategory($name, $poster) {
        $query = "INSERT INTO categories (name, poster) VALUES (:name, :poster)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':poster', $poster);
        if ($stmt->execute()) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }
    public function archiveCategory($id) {
        $query = "UPDATE categories SET status = 'Archived' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function restoreCategory($id) {
        $query = "UPDATE categories SET status = 'Active' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function updateCategory($id, $name,$email) {
       
        try {
            $query = "UPDATE categories 
            SET name = :name,
            modified_by_name = :email,
            modified_by_time = NOW()
            
             WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
