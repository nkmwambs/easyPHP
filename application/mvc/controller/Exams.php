<?php
class Exams_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Exams_Model("recent");    
        
    }
    
    public function view(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("welcome/views");
        $this->template->view("welcome/footer",$recent);        
    }
    
    public function viewKcpe(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        if($_SESSION['usrlvl']==='1'){
            $_cond = $this->_model->where(array("where"=>  array("pNo",$_SESSION['username'],"=")));
            $data = $this->_model->getAllRecords($_cond,"Kcpe");
        }elseif ($_SESSION['usrlvl']==='2') {
            $_cond = $this->_model->where(array("where"=>  array("cstName",$_SESSION['cst'],"=")));
            $data = $this->_model->getAllRecords($_cond,"Kcpe");
        }  else {
            $data = $this->_model->getAllRecords("","Kcpe");
        }
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    public function viewKcse(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        //$data = $this->model->getAllRecords("","Kcpe");
        $data ="No data available!";
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
}