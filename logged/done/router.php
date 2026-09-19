<?php
require_once "../controlers/logged/HomePageControler.php";
$homePageControler = new HomePageControler();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {  
        case 'products':
            $homePageControler->DisplayProductsById();
            break;
        case 'productview':
            $homePageControler->displayProductDetails();
            break;
        case 'currentcart':
            $homePageControler->displayCart();
            break;
        case 'orderlist':
            $homePageControler->displayCartList();
            break;
        case 'profile':
            $homePageControler->displayProfile();
            break;
        case 'editprofile':
            $homePageControler->displayEditProfile();
            break;
        default: 
            $homePageControler->displayHomePage();
            break;
    }
} else {
    $homePageControler->displayHomePage();
}