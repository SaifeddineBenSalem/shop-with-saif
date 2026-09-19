<?php
require_once "controlers/HomePageControler.php";
require_once "controlers/LoginControler.php";
require_once "controlers/ResetPasswordControler.php";
require_once "controlers/RegistrationControler.php";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'login':
            $loginControler = new LoginControler();
            $loginControler->displayLogin();
            break;
        case 'register':
            $registrationControler = new RegistrationControler();
            $registrationControler->displayRegistration();
            break;
        case 'resetpassword':
            $registrationControler = new ResetPasswordControler();
            $registrationControler->displayResetPasswordRequest();
            break;
        case 'changepassword':
            $registrationControler = new ResetPasswordControler();
            $registrationControler->displayChangePassword();
        default :
            $homePageControler = new HomePageControler();
            $homePageControler->displayHomePage();
            break;   
    }
} else {
    $homePageControler = new HomePageControler();
    $homePageControler->displayHomePage();
}

?>