<?php
class Resource_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
                $this->_model=new Resource_Model("users"); 
                //$this->_model=new Finance_Model("voucher_header");  
    }
    
    public function portal($render=1){
        return $data = "This is the CKE Portal!";
    }
    
    public function listing($render=1){
        return $data = "Resource Listing!";
    }
    
    public function guides($render=1){
        return $data = "Userguides!";
    }   
        
    public function faqs($render=1){
        return $rec ="Faqs";
    }

    public function materials($render=1){
    	
    }
    public function addMaterial($render=1){

    }
	public function testChoice(){
		//print($this->choice[1]);	
	}
    
}