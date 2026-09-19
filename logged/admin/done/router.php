<?php
require_once "../../controlers/logged/admin/AdminControler.php";
$adminControler = new AdminControler();
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {  
        case 'addproduct':
            $adminControler->displayProductAddition();
            break;
        case 'addcategory':
            $adminControler->displayCategoryAddition();
            break;
        case 'addsponsor':
            $adminControler->displaySponsorsAddition();
            break;
        case 'categories':
            $adminControler->displayCategoriesList();
            break;
        case 'modifycategory':
            $adminControler->displayModifyCategory();
            break;
        case 'modifyproduct':
            $adminControler->displayModifyProduct();
            break;
        case 'modifysponsor':
            $adminControler->displayModifySponsor();
            break;
        case 'orders':
            $adminControler->displayOrdersList();
            break;
        case 'products':
            $adminControler->displayProductsList();
            break;
        case 'sponsors':
            $adminControler->displaySponsorsList();
            break;
        case 'viewcategory':
            $adminControler->displayCategoryInfo();
            break;
        case 'vieworder':
            $adminControler->displayOrderInfo();
            break;
        case 'viewproduct':
            $adminControler->displayProductInfo();
            break;
        case 'viewsponsor':
            $adminControler->displaySponsorInfo();
            break;
        default: 
            $adminControler->displayHomePage();
            break;
    }
} else {
    $adminControler->displayHomePage();
}