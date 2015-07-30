<?php
class Resource_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
                $this->_model=new Resource_Model("users"); 
                //$this->_model=new Finance_Model("voucher_header");  
    }
    
    public function portal($render=1,$path="",$tags=array("0")){
        return $data = "This is the CKE Portal!";
    }
    
    public function listing($render=1,$path="",$tags=array("0")){
        return $data = "Resource Listing!";
    }
    
    public function guides($render=1,$path="",$tags=array("0")){
        return $data = "Userguides!";
    }   
        
    public function faqs($render=1,$path="",$tags=array("0")){
    	if(isset($this->choice[1])){
        	if ($this->choice[1]== "chatheartbeat") { $this->_model->chatHeartbeat(); } 
			if ($this->choice[1] == "sendchat") { $this->_model->sendChat(); } 
			if ($this->choice[1] == "closechat") { $this->_model->closeChat(); } 
			if ($this->choice[1] == "startchatsession") { $this->_model->startChatSession(); } 
			}
			
			if (!isset($_SESSION['chatHistory'])) {
				$_SESSION['chatHistory'] = array();	
			}
			
			if (!isset($_SESSION['openChatBoxes'])) {
				$_SESSION['openChatBoxes'] = array();	
			}
    }

    public function materials($render=1,$path="",$tags=array("0")){
    	
    }
    public function addMaterial($render=1,$path="",$tags=array("0")){

    }
	public function testChoice(){
		//print($this->choice[1]);	
	}
    
}