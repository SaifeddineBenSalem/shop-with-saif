<?php
class SponsorsModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAllSponsors() {
        try {
            $query = "SELECT * FROM sponsors";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getAllSponsorsActive() {
        try {
            $query = "SELECT * FROM sponsors where status = 'Active'";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function addSponsor($image, $poster, $sponsorName) {
        try {
            $query = "INSERT INTO sponsors (photo, poster, name) VALUES (:image, :poster, :sponsorName)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':poster', $poster);
            $stmt->bindParam(':sponsorName', $sponsorName);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function getSponsorById($id) {
        $query = "SELECT * FROM sponsors WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function archiveSponsor($id) {
        $query = "UPDATE sponsors SET status = 'Archived' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function restoreSponsor($id) {
        $query = "UPDATE sponsors SET status = 'Active' WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function updateSponsor($id, $name) {
        try {
            $query = "UPDATE sponsors SET name = :name WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>