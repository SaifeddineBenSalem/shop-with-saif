<?php
require_once __DIR__ . "/../../models/CategoriesModel.php";
class CategoriesControler {
	private $categoriesModel;

    public function __construct() {
        $this->categoriesModel = new CategoriesModel();
    }
    public function getAllCategories(){
    	return $this->categoriesModel->getAllCategories();
    }
    public function getCategoryById($id){
    	return $this->categoriesModel->getCategoryById($id);
    }
    public function getCategoryByName($name){
    	return $this->categoriesModel->getCategoryByName($name);
    }
    public function addCategory($name,$poster){
    	return $this->categoriesModel->addCategory($name,$poster);
    }
    public function archiveCategory($id){
        return $this->categoriesModel->archiveCategory($id);
    }
    public function restoreCategory($id){
        return $this->categoriesModel->restoreCategory($id);
    }
    public function updateCategory($id,$name,$email){
        return $this->categoriesModel->updateCategory($id,$name,$email);
    }
}
?>