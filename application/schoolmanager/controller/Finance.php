<?php
class Finance_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Finance_Model("recent");
    }    
    public function showAll($render=1,$path='',$tags=array("All")){

    }
}
?>