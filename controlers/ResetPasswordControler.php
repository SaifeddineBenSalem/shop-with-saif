<?php
require_once "models/UserModel.php";

class ResetPasswordControler {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function displayResetPasswordRequest() {
        require_once('views/ResetPasswordRequestView.php');
    }
    public function displayChangePassword() {
        require_once('views/ChangePasswordView.php');
    }
    public function changePassword($email,$password){
        if ($this->userModel->changePassword($email,$password)) {
                unset($_SESSION["changing"]);
                header("Location: login.php");
        } else {
            header("Location: index.php?changepassword");
        }
    }
    public function verifyUserResetPassword($email,$security_question,$security_answer){
        session_start();

        if ($this->userModel->verifyUserResetPassword($email,$security_question,$security_answer) ) {
             $_SESSION["success"] = 1;
        $_SESSION["changing"] = $email;
        session_write_close();
                header("Location: index.php?action=changepassword");
        } else {

            $_SESSION["error"] = "Incorrect data! Please retry.";
        header("Location: reset_password.php");
        exit;
        }
    }

}
?>
