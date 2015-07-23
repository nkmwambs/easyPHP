<?php
class Reports_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Reports_Model("users");
    }
    public function viewAll($render=1,$path="",$tags=array("3","9")){
        //$data = "All Reports!";
		//return $data;
		return $this->_model->getAllRecords("","queries");
    }
	public function queryView($render=2,$path='',$tags=array("3","9")){
		$sql = "SELECT ".$_POST['query'];
		return $this->_model->queryTables($sql);
		//print($sql);
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