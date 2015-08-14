<?php
class Business_Controller extends E_Controller{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Business_Model("helpdesk");
    }

    public function showAll($render=1,$path='',$tags=array("All")){
            $data = "Welcome to Business Services";
			return $data;
    }
    public function facilities($render=1,$path='',$tags=array("All")){
            $data = "Facilities Manager";
            return $data;
    }
    public function helpdesk($render=1,$path='',$tags=array("All")){
            $data = $this->_model->getAllRecords("","helpdesk");
			return $data;
    }
    public function inventory($render=1,$path='',$tags=array("All")){
            $data = "Inventory Manager";
            return $data;
    }
    public function letters($render=1,$path='',$tags=array("All")){
            $data = "Letter Tracker";
            return $data; 
    }
    public function library($render=1,$path='',$tags=array("All")){
            $data = "Library Manager";
			return $data;
    }
    public function rooms($render=1,$path='',$tags=array("All")){
            $data = "Rooms Manager";
            return $data;
    } 
    public function vendors($render=1,$path='',$tags=array("All")){
            $data = "Vendors Information";
			return $data;
    } 
    public function vehicles($render=1,$path='',$tags=array("All")){
            $data = "Vehicle Request Manager";
			return $data;
    }   
    public function newHelpRequest($render=1,$path='',$tags=array("All")){
    }    
    public function getHelpDetails($render=1,$path='',$tags=array("All")){
            $cond = $this->_model->where(array("where"=>array("reqID",$this->choice[1],"=")));
            $data['original'] = $this->_model->getAllRecords($cond,"helpdesk");
            $data['feedback'] = $this->_model->getAllRecords($cond,"helpdeskchat");
			return $data;
    }   
    public function postHelpFeedback(){
        print_r(filter_input_array(INPUT_POST));
    }
	public function room($render=1,$path='',$tags=array("All")){
		$dt =date("Y-m-d H:i:s");
		
		$cond_booked_rooms = $this->_model->where(array(array("where","bookedFrom",$dt,"<="),array("AND","bookedTo",$dt,">="),array("AND","force_expire",0,"=")));
		$arr_booked_rooms = $this->_model->getAllRecords($cond_booked_rooms,"roomsbooking");
		
		$data=array();
		
		$data['booked']=$arr_booked_rooms;
		
		return $data;
		
	}
	
	public function roomsBooking($render=1,$path='',$tags=array("All")){
		$roomID = $this->choice[1];
		
		$dt =date("Y-m-d H:i:s");
		
		$cond_booked_rooms = $this->_model->where(array(array("where","bookedFrom",$dt,"<="),array("AND","bookedTo",$dt,">="),array("AND","roomID",$roomID,"="),array("AND","force_expire",0,"=")));
		$arr_booked_rooms = $this->_model->getAllRecords($cond_booked_rooms,"roomsbooking");
		
		$cond_upcoming_bookings = $this->_model->where(array(array("where","bookedFrom",$dt,">"),array("AND","roomID",$roomID,"="),array("AND","force_expire",0,"=")));
		$upcoming_bookings_arr = $this->_model->getAllRecords("$cond_upcoming_bookings","roomsbooking");
		
		
		$room_cond = $this->_model->where(array(array("where","roomID",$roomID,"=")));
		$room_qry = $this->_model->getAllRecords($room_cond,"rooms");
		
		$data=array();
		$data['rooms']=$room_qry;
		$data['booked']=$arr_booked_rooms;
		$data['upcoming']=$upcoming_bookings_arr;
		
		return $data;
	}
	public function submitRoomBooking(){
		$dt =date("Y-m-d H:i:s");
		
		$arr_post = array();
		$arr_post['roomID']=$_POST['roomID'];
		$arr_post['bookedByID']=Resources::session()->ID;
		$arr_post['bookedFrom']=$_POST['bookedFromDate']." ".$_POST['bookedFromHrs'].":".$_POST['bookedFromMins'].":00";
		$arr_post['bookedTo']=$_POST['bookedToDate']." ".$_POST['bookedToHrs'].":".$_POST['bookedToMins'].":00";
		
		$chk_upcomimg_cond = $this->_model->where(array(array("where","bookedFrom",$dt,">"),array("AND","bookedFrom",$arr_post['bookedFrom'],"<"),array("AND","bookedTo",$arr_post['bookedFrom'],">"),array("AND","roomID",$arr_post['roomID'],"=")));
		$chk_upcomimg_arr = $this->_model->getAllRecords($chk_upcomimg_cond,"roomsbooking");
		
		if(count($chk_upcomimg_arr)>0){
			echo "You booking conflicts with another Upcoming Meeting";
		}else{
			echo $this->_model->insertRecord($arr_post,"roomsbooking");
		}
			
		
	}
public function expireRoomBooking(){
	$bookingID=$this->choice[1];
	$sets = array("force_expire"=>1);
	$exp_cond = $this->_model->where(array(array("where","bookingID",$bookingID,"=")));
	$rst = $this->_model->updateQuery($sets,$exp_cond,"roomsbooking");
	
	if($rst===1){
		echo "Booking #{$bookingID} cancelled successfully!";
	}else{
		echo "Error occured, booking not cancelled!";
	}

}

}