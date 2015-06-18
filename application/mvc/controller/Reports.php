<?php
class Reports_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Reports_Model("recent");
    }
    public function viewAll($render=1,$path="",$tags=array("All")){
        $data = "All Reports!";
		return $data;
    }
    public function csp($render=1,$path="",$tags=array("All")){
        $data = "CSP Report!";
		return $data;
    }
    
    public function health($render=1,$path="",$tags=array("All")){
        $data = "Health Report!";
		return $data;
    }
   
    public function hvcQtrly($render=1,$path="",$tags=array("All")){
        $data = "HVC Report!";
		return $data;
    }
    
    public function pds($render=1,$path="",$tags=array("All")){
        $data = "Monthly PD's Report!";
		return $data;
    }
    
        
    public function hvcIndexing($render=1,$path="",$tags=array("All")){
        $data = "Annual HVC Indexing Form!";
		return $data;
    }
}