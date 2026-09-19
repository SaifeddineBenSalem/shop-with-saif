<?php
require_once __DIR__ . "/../../models/CategoriesModel.php";
class UserControler {
	private $userModel;
    public function __construct() {
        $this->userModel = new UserModel();
    }
	public function getCurrentUser($email) {
			return $this->userModel->currentUser($email);
	}
	public function updateUser($id, $email, $birthday, $gender, $security_question, $security_answer) {
		return $this->userModel->updateUser($id, $email, $birthday, $gender, $security_question, $security_answer);
	}
	public function updateProfilePhoto($id, $photo) {
		$targetDir = "../inc/logged/img/profilephotos/";
		if (!file_exists($targetDir)) {
			mkdir($targetDir, 0777, true); 
		}
	
		$fileName = basename($photo["name"]);
		$targetFilePath = $targetDir . $id . "_" . $fileName;
		$fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
	
		$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
		if (in_array($fileType, $allowedTypes)) {
			if (move_uploaded_file($photo["tmp_name"], $targetFilePath)) {
				return $this->userModel->updatePhoto($id, $id . "_" . $fileName);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	
}
?>