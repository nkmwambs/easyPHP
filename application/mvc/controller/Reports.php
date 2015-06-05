<?php
class Reports_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Reports_Model("recent");
    }
    public function viewAll(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "All Reports!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    public function csp(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "CSP Report!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    public function health(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "Health Report!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
   
    public function hvcQtrly(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "HVC Report!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    public function pds(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "Monthly PD's Report!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
        
    public function hvcIndexing(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "Annual HVC Indexing Form!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
}