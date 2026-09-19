<?php
require_once __DIR__ . "/../../models/SponsorsModel.php";

class SponsorsControler {
	private $sponsorsModel;

    public function __construct() {
        $this->sponsorsModel = new SponsorsModel();
    }
    public function getAllSponsors(){
    	return $this->sponsorsModel->getAllSponsors();
    }
    public function getAllSponsorsActive(){
    	return $this->sponsorsModel->getAllSponsorsActive();
    }
    public function addSponsor($image,$poster,$sponsorName){
    	return $this->sponsorsModel->addSponsor($image,$poster,$sponsorName);
    }
    public function getSponsorById($id){
    	return $this->sponsorsModel->getSponsorById($id);
    }
    public function archiveSponsor($id){
        return $this->sponsorsModel->archiveSponsor($id);
    }
    public function restoreSponsor($id){
        return $this->sponsorsModel->restoreSponsor($id);
    }
    public function updateSponsor($id,$name){
    	return $this->sponsorsModel->updateSponsor($id,$name);
    }
    
    
}
?>