<?php
include '../../../actions/database.php';
include 'categories.php';
session_start();
$database = new Database();
$db = $database->connect();
$category =  new Categories($db,$_POST["categoryName"],$_SESSION["login"]);
$id = $_POST["categoryId"];
if ($category->updateCategory($id)){
	header("Location: ../viewcategory.php?id=".$id);
} else {
	header("Location: ../viewcategory.php?id=".$id);
}
?>