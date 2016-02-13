<?php
class Events_Controller extends E_Controller
{
 private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Events_Model("events");
    }
    public function calendar($render=1,$path='',$tags=array("All")){
        
        if (!isset($this->choice[1])){ $this->choice[1] = date("n");}
    	if (!isset($this->choice[3])){ $this->choice[3] = date("Y");}

        $cMonth = $this->choice[1];
        $cYear = $this->choice[3];
        
        $events_cond=  $this->_model->where(array(array("where","Month(`eventDate`)",$cMonth,"="),array("AND","Year(`eventDate`)",$cYear,"=")));
      	$events_dates=$this->_model->getAllRecords($events_cond,"events");
     
       	$data = array($cMonth,$cYear,$events_dates);  
		
		return $data;                
    }
    
    public function newEvent($render=1,$path='',$tags=array("All")){

    }
    public function postEvent(){
        $eventOwner = $_SESSION['ID'];
        $eventOwnerName=$_SESSION['fname']." ".$_SESSION['lname'];
        $_POST['eventOwner']=$eventOwner;
        $_POST['eventOwnerName']=$eventOwnerName;
        echo $this->_model->insertRecord($_POST,"events");
    }
    public function showEvents(){
        $date = $this->choice[3];
        $month=  $this->choice[5];
        $year=  $this->choice[7];
        $now=$year."-".$month."-".$date;
        $show_cond=  $this->_model->where(array(array("where","eventDate",$now,"=")));
        $rst = $this->_model->getAllRecords($show_cond,"events");
        print_r(json_encode($rst));
    }
    
    public function showEventDetails($render=1,$path='',$tags=array("All")){
          $rec = $this->choice[7];
          $rec_cond=  $this->_model->where(array(array("where","eventID",$rec,"=")));
          $event_rst = $this->_model->getAllRecords($rec_cond,"events");
		  
		  return $event_rst;		
    }
    public function editEvent(){
        $edit_cond = $this->_model->where(array("where"=>array("eventID",  $this->choice[1],"=")));
        $edit_rst = $this->_model->getAllRecords($edit_cond,"events");
        $data = array($this->choice[1],$edit_rst);
       
    }
    public function searchUsers(){
        $all_users = $this->_model->getAllRecords("","users");
        print_r(json_encode($all_users));
            //$this->template->view("",$all_users);
    }
    
}
?>