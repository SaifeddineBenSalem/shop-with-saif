<?php

include '../../actions/database.php';
include 'order.php';
session_start();
$database = new Database();
$db = $database->connect();

if (Order::confirmOrder($_SESSION["login"],$db))
	header("Location: ../cart.php");
else
	header("Location: ../cart.php");
?>