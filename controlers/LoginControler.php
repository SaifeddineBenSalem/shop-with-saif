<?php
require_once "models/UserModel.php";

class LoginControler {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function displayLogin() {
        require_once('views/LoginView.php');
    }
    public function login($email,$password){
        session_start();
        if ($this->userModel->login($email,$password)) {
            $_SESSION["login"] = $email;
        header("Location: logged/index.php");
        exit;
     } else {
        $_SESSION["error"] = "Incorrect email or password. Please retry.";
        header("Location: index.php?action=login");
        exit;
     }
    }
}
?>
