<?php
class Staff_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Staff_Model("recent");
    }    
    public function showAll($render=1,$path='',$tags=array("All")){

    }
	public function myprofile($render=1,$path='',$tags=array("All")){

    }
}
?>