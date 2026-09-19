<?php
include '../../../actions/database.php';
include 'categories.php';
include 'products.php';
session_start();
$database = new Database();
$db = $database->connect();
$category = new Categories($db,$_POST["categoryName"],null);
$category_final = $category->getCategoryByName();
$allsizes= "";
$allcolors="";
if (isset($_POST["shoesSizes"])) {
    foreach ($_POST["shoesSizes"] as $size) {
    	if ($allsizes === "")
    		$allsizes =  $size;
    	else
    		$allsizes =  $allsizes.",".$size;
    }
}
if (isset($_POST["colors"])) {
    foreach ($_POST["colors"] as $size) {
    	if ($allcolors === "")
    		$allcolors =  $size;
    	else
    		$allcolors =  $allcolors.",".$size;
    }
}
$products = new Products($db,$_POST["productName"],$category_final["id"],$_POST["productPrice"],$_SESSION["login"],$_POST["productDescription"],$_POST["productPromo"],$allsizes,$allcolors);
$id = $_POST["product_id"];
if ($products->updateProduct($id)) {
	header("Location: ../viewproduct.php?id=".$id);
} else {
	header("Location: ../viewproduct.php?id=".$id);
}
?>
