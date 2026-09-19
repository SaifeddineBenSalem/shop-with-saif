<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
include '../../actions/user.php';
include '../../actions/database.php';
$database = new Database();
$db = $database->connect();
$user = new User($db,null,null,$_SESSION["login"],null,null,null,null,null);
$role = $user->getRole();
if ($role != "admin")
    header("Location: ../index.php");
include 'actions/products.php';
$categories = Products::getAllProductsStatic($db);
 foreach($categories as $category) {
	echo $category->getId();
	}
?>