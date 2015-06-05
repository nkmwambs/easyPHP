<?php
class Events_Controller extends E_Controller
{
 private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Events_Model("events");
    }
    public function calendar(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        if (!isset($this->choice[1])){ $this->choice[1] = date("n");}
    if (!isset($this->choice[3])){ $this->choice[3] = date("Y");}

        $cMonth = $this->choice[1];
        $cYear = $this->choice[3];
        
        $events_cond=  $this->_model->where(array("where"=>array("Month(`eventDate`)",$cMonth,"="),"AND"=>array("Year(`eventDate`)",$cYear,"=")));
        $events_dates=$this->_model->getAllRecords($events_cond,"events");
        

            
            $data = array($cMonth,$cYear,$events_dates);  
        
        
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("",$data);
		$this->template->view("Basic/footer",$recent); 
                
    }
    
    public function newEvent(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);
    }
    public function postEvent(){
        //print_r($_POST);
        
        $eventOwner = $_SESSION['ID'];
        $eventOwnerName=$_SESSION['fname']." ".$_SESSION['lname'];
        $_POST['eventOwner']=$eventOwner;
        $_POST['eventOwnerName']=$eventOwnerName;
        //print_r($_POST);
        echo $this->_model->insertRecord($_POST,"events");
    }
    public function showEvents(){
        $date = $this->choice[3];
        $month=  $this->choice[5];
        $year=  $this->choice[7];
        $now=$year."-".$month."-".$date;
        //echo $now;
        $show_cond=  $this->_model->where(array("where"=>array("eventDate",$now,"=")));
        $rst = $this->_model->getAllRecords($show_cond,"events");
        print_r(json_encode($rst));
    }
    
    public function showEventDetails(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $rec = $this->choice[7];
                $rec_cond=  $this->_model->where(array("where"=>array("eventID",$rec,"=")));
                $event_rst = $this->_model->getAllRecords($rec_cond,"events");
                
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("",$event_rst);
		$this->template->view("Basic/footer",$recent); 
    }
    public function editEvent(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
                $edit_cond = $this->_model->where(array("where"=>array("eventID",  $this->choice[1],"=")));
                $edit_rst = $this->_model->getAllRecords($edit_cond,"events");
                
                $data = array($this->choice[1],$edit_rst);
		$this->template->view("",  $data);
		$this->template->view("Basic/footer",$recent);        
    }
    public function searchUsers(){
        $all_users = $this->_model->getAllRecords("","users");
        print_r(json_encode($all_users));
            //$this->template->view("",$all_users);
    }
    
}
?>