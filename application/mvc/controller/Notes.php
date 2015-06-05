<?php
class Notes_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Notes_Model("helpdesk");
    }

    public function getAllNotes(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $data = "All Notes";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    public function sentNotes(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $data = "Sent Notes";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    public function receivedNotes(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $data = "Received Notes";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
}