<?php
require_once __DIR__ . "/../../models/ProductsModel.php";
class ProductsControler {
	private $productsModel;

    public function __construct() {
        $this->productsModel = new ProductsModel();
    }
    public function getProductsByCategoryIdAndNotArchived($id){
    	return $this->productsModel->getProductsByCategoryIdAndNotArchived($id);
    }
    public function getProductById($id){
    return $this->productsModel->getProductById($id);
    }
    public function getAllProducts(){
        return $this->productsModel->getAllProducts();
    }
    public function archiveProduct($id){
        return $this->productsModel->archiveProduct($id);
    }
    public function restoreProduct($id){
        return $this->productsModel->restoreProduct($id);
    }
    public function updateProduct($id,$productName, $categoryId, $productPrice, $updatedBy, $productDescription, $productPromo, $allSizes, $allColors) {
        return $this->productsModel->updateProduct($id,$productName, $categoryId, $productPrice, $updatedBy, $productDescription, $productPromo, $allSizes, $allColors);
    }
    public function addProduct($productName, $categoryId, $productPrice, $createdBy, $productDescription, $productPromo, $allSizes, $allColors,$fileName) {
        return $this->productsModel->addProduct($productName, $categoryId, $productPrice, $createdBy, $productDescription, $productPromo, $allSizes, $allColors,$fileName);
    }
    public function getProductsByPoster($email){
        return $this->productsModel->getProductsByPoster($email);
    }
    
}
?>