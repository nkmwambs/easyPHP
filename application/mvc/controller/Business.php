<?php
class Business_Controller extends E_Controller{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Business_Model("helpdesk");
    }

    public function showAll($render=1,$path='',$tags=array("All")){
            //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
    
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Welcome to Business Services";
			return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function facilities($render=1,$path='',$tags=array("All")){
            //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");

            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Facilities Manager";
            return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function helpdesk($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
       // $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = $this->_model->getAllRecords("","helpdesk");
			return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function inventory($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Inventory Manager";
            return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function letters($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Letter Tracker";
            return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function library($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
           // $menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Library Manager";
			return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }
    public function rooms($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Rooms Manager";
            return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    } 
    public function vendors($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Vendors Information";
			return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    } 
    public function vehicles($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $data = "Vehicle Request Manager";
			return $data;
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }   
    public function newHelpRequest($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            //$data = "Create a Help Ticket";
            //$this->template->view();
            //$this->template->view("welcome/footer",$recent); 
    }    
    public function getHelpDetails($render=1,$path='',$tags=array("All")){
        //$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
            //$menu = $this->model->getAllRecords();
            //$this->load_menu->menu($menu);
            $cond = $this->_model->where(array("where"=>array("reqID",$this->choice[1],"=")));
            $data['original'] = $this->_model->getAllRecords($cond,"helpdesk");
            $data['feedback'] = $this->_model->getAllRecords($cond,"helpdeskchat");
			return $data;
            //$data = "Create a Help Ticket";
            //$this->template->view("",$data);
            //$this->template->view("welcome/footer",$recent); 
    }   
    public function postHelpFeedback(){
        print_r(filter_input_array(INPUT_POST));
    }
}