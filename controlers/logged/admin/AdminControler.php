<?php
require_once "../../models/UserModel.php";
class AdminControler {
	private $userModel;
    public function __construct() {
        $this->userModel = new UserModel();
    }
	public function displayHomePage(){
		require_once('../../views/logged/admin/HomePageView.php');
	}
	//---------------------------------------Categories-----------------------------------------//

	public function displayCategoriesList(){
		require_once('../../views/logged/admin/CategoriesListView.php');
	}
	public function displayCategoryInfo(){
		require_once('../../views/logged/admin/ViewCategoryInfoView.php');
	}
	public function displayCategoryAddition(){
		require_once('../../views/logged/admin/AddCategoryView.php');
	}
	public function displayModifyCategory(){
		require_once('../../views/logged/admin/ModifyCategoryView.php');
	}
	//---------------------------------------Products-----------------------------------------//
	public function displayProductsList(){
		require_once('../../views/logged/admin/ProductsListView.php');
	}
	public function displayProductInfo(){
		require_once('../../views/logged/admin/ViewProductInfoView.php');
	}
	public function displayModifyProduct(){
		require_once('../../views/logged/admin/ModifyProductView.php');
	}
	public function displayProductAddition(){
		require_once('../../views/logged/admin/AddProductView.php');
	}
	//---------------------------------------Orders-----------------------------------------//
	public function displayOrdersList(){
		require_once('../../views/logged/admin/OrdersListView.php');
	}
	public function displayOrderInfo(){
		require_once('../../views/logged/admin/ViewOrderInfoView.php');
	}
	//---------------------------------------Sponsors-----------------------------------------//
	public function displaySponsorsList(){
		require_once('../../views/logged/admin/SponsorsListView.php');
	}
	public function displaySponsorsAddition(){
		require_once('../../views/logged/admin/AddSponsorView.php');
	}
	public function displaySponsorInfo(){
		require_once('../../views/logged/admin/ViewSponsorInfoView.php');
	}
	public function displayModifySponsor(){
		require_once('../../views/logged/admin/ModifySponsorView.php');
	}
	
	
	
	
	
}
?>