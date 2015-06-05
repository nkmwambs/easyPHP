<?php
class Staff_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Staff_Model("recent");
    }    
    public function showAll(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu=$this->model->getAllRecords("","menu");
	$this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("Basic/footer",$recent);
    }
}
?>