<?php
class Notes_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Notes_Model("helpdesk");
    }

    public function getAllNotes($render=1,$path="",$tags=array("All")){
        $data = "All Notes";
		return $data;
    }
    public function sentNotes($render=1,$path="",$tags=array("All")){
        $data = "Sent Notes";
		return $data;
    }
    public function receivedNotes($render=1,$path="",$tags=array("All")){
        $data = "Received Notes";
		return $data;
    }
}