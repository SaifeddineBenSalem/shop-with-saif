<?php
require_once "../models/UserModel.php";
class HomePageControler {
	private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }
public function displayHomePage(){
		require_once('../views/logged/HomePageView.php');
	}
public function getCurrentUser($email) {
	return $this->userModel->currentUser($email);
	}
public function DisplayProductsById() {
	require_once('../views/logged/ProductsView.php');
	}
public function displayProductDetails() {
	require_once('../views/logged/ProductView.php');
	}
public function displayCart() {
	require_once('../views/logged/CartView.php');
	}
	public function displayCartList() {
		require_once('../views/logged/CartListView.php');
		}
	public function displayOrderDetail() {
		require_once('../views/logged/OrderDetailView.php');
	}
	public function displayProfile() {
		require_once('../views/logged/ProfileView.php');
	}
	public function displayEditProfile() {
		require_once('../views/logged/EditProfileView.php');
	}
	
}
?>