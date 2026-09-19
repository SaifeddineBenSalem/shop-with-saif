<?php
include '../../../actions/database.php';
include 'sponsor.php';
session_start();
$database = new Database();
$db = $database->connect();
 if (isset($_POST['sponsorName'], $_FILES['sponsorPhoto'])) {
        $sponsorName = htmlspecialchars($_POST['sponsorName']);
         $uploadDir = '../../img/sponsors/';
                 $uploadFile = $uploadDir . basename($_FILES['sponsorPhoto']['name']);

        $photoPath = 'img/sponsors/' . basename($_FILES['sponsorPhoto']['name']); 
 if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }
        if (move_uploaded_file($_FILES['sponsorPhoto']['tmp_name'], $uploadFile)) {
            try {
                // Assuming $db is your PDO database connection
                $poster = $_SESSION["login"]; // Replace this with the appropriate value if required
                $sponsor = new sponsor($db, basename($_FILES['sponsorPhoto']['name']), $poster, $sponsorName);

                if ($sponsor->addSponsor()) {
				header("Location: ../addsponsor.php");
                } else {
				header("Location: ../addsponsor.php");
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
				header("Location: ../addsponsor.php");
        }
    }

?>