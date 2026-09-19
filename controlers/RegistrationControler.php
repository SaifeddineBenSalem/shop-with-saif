<?php
require_once "models/UserModel.php";

class RegistrationControler {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function displayRegistration() {
        require_once('views/RegistrationView.php');
    }

    public function registerUser($first_name, $last_name, $email, $password, $gender, $birthday, $security_question, $security_answer) {
        if ($this->userModel->checkEmailExistance($email)) {
            session_start();
            $_SESSION["error"] = "This email is already registered. Please use a different one.";
            header("Location: index.php?action=register");
            exit();
        }

        $result = $this->userModel->register($first_name, $last_name, $email, $password, $gender, $birthday, $security_question, $security_answer);
        session_start();

        if ($result) {
            $_SESSION["success"] = "You have successfully registered. Please log in.";
            header("Location: index.php?action=login");
        } else {
            $_SESSION["error"] = "Data may be missing! Please retry.";
            header("Location: index.php?action=register"); 
        }
    }
}
?>
