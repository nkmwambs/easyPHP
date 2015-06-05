<?php
class Business_Controller extends E_Controller{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Business_Model("helpdesk");
    }

    public function showAll(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
    
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Welcome to Business Services";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function facilities(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");

            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Facilities Manager";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function helpdesk(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = $this->_model->getAllRecords("","helpdesk");
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function inventory(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Inventory Manager";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function letters(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Letter Tracker";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function library(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Library Manager";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    public function rooms(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Rooms Manager";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    } 
    public function vendors(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Vendors Information";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    } 
    public function vehicles(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "Vehicle Request Manager";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }   
    public function newHelpRequest(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            //$data = "Create a Help Ticket";
            $this->template->view();
            $this->template->view("welcome/footer",$recent); 
    }    
    public function getHelpDetails(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $cond = $this->_model->where(array("where"=>array("reqID",$this->choice[1],"=")));
            $data['original'] = $this->_model->getAllRecords($cond,"helpdesk");
            $data['feedback'] = $this->_model->getAllRecords($cond,"helpdeskchat");
            //$data = "Create a Help Ticket";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }   
    public function postHelpFeedback(){
        print_r(filter_input_array(INPUT_POST));
    }
}