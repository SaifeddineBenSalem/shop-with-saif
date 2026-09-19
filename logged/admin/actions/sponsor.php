<?php
class sponsor {
    private $id;
    private $db;
    private $photo;
    private $poster;
    private $status;
    private $posting_date;
    private $name;

    public function __construct($db, $photo, $poster,$name) {
        $this->db = $db;
        $this->photo = $photo;
        $this->poster = $poster;
        $this->name=  $name;
    }
    public function getPhoto() {
    	return $this->photo;
    }
    public function getName() {
    	return $this->name;
    }
    public function addSponsor() {
        try {
            $query = "INSERT INTO sponsors (photo, poster,name) VALUES (:photo, :poster,:name)";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':photo', $this->photo);
            $stmt->bindParam(':poster', $this->poster);
            $stmt->bindParam(':name', $this->name);

            if ($stmt->execute()) {
               return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
     public static function getAllSponsors($db) {
        try {
            // SQL query to fetch all sponsors
            $query = "SELECT * FROM sponsors";
            $stmt = $db->prepare($query);
            $stmt->execute();

            // Fetch all rows and convert them to sponsor objects
            $sponsors = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sponsor = new sponsor($db, $row['photo'], $row['poster'],$row['name']);
                $sponsor->id = $row['id']; // Assign id directly since it's private
                $sponsor->status = $row['status'];
                $sponsor->posting_date = $row['posting_date'];
                $sponsors[] = $sponsor;
            }
            return $sponsors;
        } catch (PDOException $e) {
            // Handle exceptions
            echo "Error: " . $e->getMessage();
            return [];
        }
    }



}
?>
