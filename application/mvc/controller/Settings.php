<?php
class Settings_Controller extends E_Controller
{
    public $_model;
    public function __construct() {
        parent::__construct();
        $this->_model=new Settings_Model("recent");
            
    }
    
    public function viewSettings($render=1,$path="welcome/views",$tags=array("All")){
		
    }
    
   // Users Methods
    
   public function userslist(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        if(empty($this->choice)){
            $cond = $this->model->where(array("where"=>array("userlevel",filter_input(INPUT_POST,"userlevel"),"="),
                "AND"=>array("cname",'%'.filter_input(INPUT_POST,"cname").'%',"LIKE")));
        }else{
            $cond = $this->model->where(array("where"=>array("userlevel",  $this->choice[1],"="),
                "AND"=>array("cname",'%'.$this->choice[3].'%',"LIKE")));
        }
        $data = $this->model->getAllRecords($cond,"Users");
        //Set menu Top Menu Items
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        
        //Call views
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    public function newUser(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);  
    }
    
    public function addUser(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $data = $this->model->insertRecord(filter_input_array(INPUT_POST),"Users");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    //Positions Methods
    
    public function lists(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $data = $this->_model->getAllRecords("","Positions");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);      
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);          
    }
    
    public function newPosition() {
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);        
    }
    
    public function getEntry(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $data = $this->model->insertRecord(filter_input_array(INPUT_POST),"Positions");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu); 
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);         
        
    }
    
    public function deletePosition(){
        $cond = $this->model->where(array("where"=> array("dsgn",$this->choice[1],"=")));
        $data = $this->model->deleteQuery($cond);
        //$menu = $this->model->getAllRecords("","menu");
        //$this->load_menu->menu($menu); 
        $this->template->view("",$data);
        //$this->template->view("welcome/footer");  
    }
    
    // Menu Settings
    public function addMenu(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view();
         $this->template->view("welcome/footer",$recent);
         
     }
     
     public function getMenu(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
         
         $data = $this->model->insertRecord(filter_input_array(INPUT_POST));
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view("",$data);
         $this->template->view("welcome/footer",$recent);
     }
     
     public function showAll(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
         
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view("",$menu);
         $this->template->view("welcome/footer",$recent);
     }
     public function editMenu(){
        $cond = $this->model->where(array("where"=> array("mnID",$this->choice[3],"=")));
        $sets = array($this->choice[0]=>$this->choice[1]);
        $data = $this->model->updateQuery($sets,$cond);
        //$menu = $this->model->getAllRecords();
        //$view_arr = array($data,$menu);
        //$this->load_menu->menu($menu); 
        $this->template->view("",$data);
        //$this->template->view("welcome/footer");  
     }
     public function profile($render=1,$path="",$tags=array("All")){

     }
     
     public function confirmUserExist(){
         
     }
}