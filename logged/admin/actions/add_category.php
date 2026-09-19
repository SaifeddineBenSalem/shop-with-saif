<?php
include '../../../actions/database.php';
include 'categories.php';
session_start();
$database = new Database();
$db = $database->connect();
$category =  new Categories($db,$_POST["categoryName"],$_SESSION["login"]);
if ($category->addCategory()){
	header("Location: ../addcategory.php");
} else {
	header("Location: ../addcategory.php");
}
?>