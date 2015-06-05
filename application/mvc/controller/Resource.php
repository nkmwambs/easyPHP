<?php
class Resource_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
                $this->_model=new Resource_Model("voucher_header"); 
                //$this->_model=new Finance_Model("voucher_header");  
    }
    
    public function portal(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $xdata = $this->model->getAllRecords("","ext_links");
        foreach($xdata as $xval):
            $link_arr = explode(",",$xval->link_display); //Array ( [0] => 1-block [1] => 2-block [2] => 9-block )
            foreach ($link_arr as $value):
                $link_arr_inner = explode("-",$value);//Array ( [0] => 1 [1] => block ) Array ( [0] => 2 [1] => block ) Array ( [0] => 9 [1] => block )
       
            if($link_arr_inner[0]===$_SESSION['userlevel']){
                $data[] = array("href"=>$xval->link_detail,"target"=>$xval->link_target,"style"=>"display:".$link_arr_inner[1],"text"=>$xval->link_title);
            }
        
            endforeach;
        endforeach;
        //$data = "This is the CKE Portal!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent); 
    }
    
    public function listing(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "Resource Listing!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent); 
    }
    
    public function guides(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $data = "Userguides!";
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent); 
    }   
        
    public function faqs(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        
        
        $rec ="Faqs";
        $this->template->view("",$rec);
        
        
        $this->template->view("welcome/footer",$recent); 
    }

    public function materials(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        //$data = "List of Training Materials";
        $this->template->view();
        $this->template->view("welcome/footer",$recent); 
    }
    public function addMaterial(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent); 
    }
    
}