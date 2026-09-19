<?php
session_start();
include '../../actions/database.php';
include 'order.php';
$database = new Database();
$db = $database->connect();
$order = new Order($db,$_POST["product"],$_POST["size"],$_POST["color"],$_SESSION["login"],$_POST["quantity"]);
if ($order->addOrder())
	header("Location: ../cart.php");
else
	header("Location: ../cart.php");
?>