<?php
class Resource_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
                $this->_model=new Resource_Model("users"); 
                //$this->_model=new Finance_Model("voucher_header");  
    }
    
    public function portal(){
        $data = "This is the CKE Portal!";
        $this->dispatch("",$data);

    }
    
    public function listing(){
        $data = "Resource Listing!";
        $this->dispatch("",$data);
    }
    
    public function guides(){
        $data = "Userguides!";
        $this->dispatch("",$data);
    }   
        
    public function faqs(){
        $rec ="Faqs";
        $this->dispatch("",$rec);
    }

    public function materials(){
        //$data = "List of Training Materials";
        $this->dispatch();
    }
    public function addMaterial(){
        $this->dispatch();
    }
	public function testChoice(){
		//print($this->choice[1]);	
	}
    
}