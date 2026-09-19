<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
include '../../../actions/user.php';
include '../../../actions/database.php';
$database = new Database();
$db = $database->connect();
$user = new User($db,null,null,$_SESSION["login"],null,null,null,null,null);
$role = $user->getRole();
if ($role != "admin")
    header("Location: ../index.php");
if (!isset($_GET["id"]) || trim($_GET["id"]) === '') 
     header("Location: index.php");
$id = $_GET["id"];
include 'products.php';
if (Products::archiveProduct($db,$id)) {
    header("Location: ../viewproduct.php?id=".$id);
}else{
    header("Location: ../viewproduct.php?id=".$id);

}
?>
