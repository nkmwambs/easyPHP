<?php
class Training_Controller extends E_Controller
{
public $_model;
public function __construct(){
        parent::__construct();
        $this->_model=new Training_Model("trainingsprofile");
    }
public function view($render=1,$path="",$tags=array("All")){
	
}
public function training($render=1,$path='',$tags=array("All")){
	$data=array();
	
	//Get All Active Trainings
	$curdate = date("Y-m-d");
	$training_cond = $this->_model->where(array(array("WHERE","trainingsprofile.status",1,"="),array("AND","trainingsprofile.enddate",$curdate,">="),array("AND","trainingparticipants.userID",Resources::session()->ID,"=")));
	$training_arr = $this->_model->getAllRecords($training_cond,"trainingsprofile","",array("trainingsprofile.tID:tID","trainingsprofile.tdesc:tdesc"),array("RIGHT JOIN"=>array("trainingsprofile"=>"tID","trainingparticipants"=>"trainingID")));
	
	//Get LEM One Questions
	$state = 1;
	if(isset($this->choice[1])){
		$state=$this->choice[1];
	}
	$qstn_cond = $this->_model->where(array(array("WHERE","status",$state,"=")));
	$qstn_arr = $this->_model->getAllRecords($qstn_cond,"lemquestions");
	
	
	$data['trainings']=$training_arr;
	$data['qstns']=$qstn_arr;
	$data['test']="";
	return $data;
}

public function loadlem($render=1,$path='',$tags=array("All")){
	$data=array();
	$tID = $_POST['tID'];
	$usertoken = $_POST['usertoken'];
	$form = array();
	
	//Form Header
	$training_cond = $this->_model->where(array(array("WHERE","tID",$tID,"=")));
	$training_arr = $this->_model->getAllRecords($training_cond,"trainingsprofile");
	
	$form['header']=(array)$training_arr[0];
	
	//Form Session
	$session_cond = $this->_model->where(array(array("WHERE","tID",$tID,"=")));
	$session_arr = $this->_model->getAllRecords($session_cond,"trainingsessions");
	
	foreach ($session_arr as $value) {
		$form['sess'][]=(array)$value;
	}
	
	//Questions
	
	$query_cond = $this->_model->where(array(array("WHERE","status",1,"=")));
	$query_arr = $this->_model->getAllRecords($query_cond,"lemquestions");
	
	foreach ($query_arr as $value) {
		$form['qstns'][]=(array)$value;
	}
	
	//$msg_arr = $this->_model->getAllRecords("","lemmsg");
	//$form['msg']=(array)$msg_arr[0];
	
	//Check if an evaluation exist for the training by the current user
	$check_cond = $this->_model->where(array(array("WHERE","trainingID",$tID,"="),array("AND","usertoken",$usertoken,"=")));
	$check_arr = $this->_model->getAllRecords($check_cond,"lem","LIMIT 0,1",array("usertoken"));
	$form_arr=array();
	$count_sessions=count($form['sess']);
	$count_questions=count($form['qstns']);
	$count_records = $count_sessions*$count_questions;
	if(empty($check_arr)){
		$lem_fields = array("trainingID","sessionID","questionID","score","comment","usertoken");
		for($i=0;$i<count($lem_fields);$i++){
			for ($j=0; $j < $count_records; $j++) {
				if($lem_fields[$i]==='trainingID'){
					$form_arr[$lem_fields[$i]][]=$tID;
				}elseif($lem_fields[$i]==='usertoken'){
					$form_arr[$lem_fields[$i]][]=$usertoken;
				}elseif($lem_fields[$i]==='comment'){
					$form_arr[$lem_fields[$i]][]="None";
				}else{
					$form_arr[$lem_fields[$i]][]=0;
				}
			}
		}
		$this->_model->insertArray($form_arr,"lem");
	}
	
	//Get existing Records data
	$exist_arr=array();
	$exist_cond = $this->_model->where(array(array("WHERE","trainingID",$tID,"="),array("AND","usertoken",$usertoken,"=")));
	$exist_rw = $this->_model->getAllRecords($exist_cond,"lem","",array("sessionID","questionID","score","comment"));
	
	foreach ($exist_rw as $value) {
		$exist_arr[]=(array)$value;
	}
	
	$data['test']="";
	$data['rec']=$form;
	$data['info']=$exist_arr;
	return $data;
}
public function savelemone()
{
	$rw=$_POST;
	$final_arr = array();
	
	
	//Refine POST to a database post array
	foreach ($rw as $key => $value) {
		foreach ($value as $val) {
			foreach ($val as $v) {	
					$final_arr[$key][]=$v;
			}
		}
	}
	//Add Zeroes to missing score
	$dif = 0;
	$count_score=0;
	if(isset($final_arr['score'])){
		$count_score = count($final_arr['score']);
	}
		
	$count_id = count($final_arr['sessionID']);
	if(count($count_score!==$count_id)){
		$dif= $count_id-$count_score;
		for($x=$count_score;$x<$count_id;$x++){
			$final_arr['score'][$x]=0;
		}
	}

	//print_r($final_arr);
	//Check if usertoken exists
	$token_cond = $this->_model->where(array(array("WHERE","usertoken",$final_arr['usertoken'][0],"="),array("AND","trainingID",$final_arr['trainingID'][0],"=")));
	$token_arr = $this->_model->getAllRecords($token_cond,"lem","LIMIT 0,1",array("usertoken"));
	
	if(!empty($token_arr)){
		//Delete previous Evaluation
		$this->_model->deleteQuery($token_cond,"lem");	
	}
		//Add to database
		echo $this->_model->insertArray($final_arr,"lem");
	 
}
public function settings($render=1,$path="",$tags=array("All")){
	
}
public function register($render=1,$path="",$tags=array("All")){
	$data=array();
	//Get all active trainings
	$curdate = date("Y-m-d");
	$training_cond = $this->_model->where(array(array("WHERE","status",1,"="),array("AND","enddate",$curdate,">=")));
	$training_arr = $this->_model->getAllRecords($training_cond,"trainingsprofile","",array("tID","tdesc"));
	
	//Populate all ICPs
	$icps_cond = $this->_model->where(array(array("WHERE","userlevel",1,"="),array("AND","department",0,"=")));
	$icps_rw = $this->_model->getAllRecords($icps_cond,"users","",array("fname"));
	$icps_arr = array();
	foreach ($icps_rw as $value) {
		$icps_arr[]=$value->fname;
	}
	
	$data['rec']=$training_arr;
	$data['icps']=$icps_arr;
	return $data;	
}
public function newtraining($render=1,$path="",$tags=array("All")){
	
}
public function calender($render=1,$path="",$tags=array("All")){
	
}
public function posttraining(){
	//print_r($_POST);
	$rec = $_POST;
	$facilitators=array_pop($rec);
	$sessdesc=array_pop($rec);
	
	//Check if the training title exists
	$validate_cond = $this->_model->where(array(array("WHERE","tdesc",$rec['tdesc'],"="),array("AND","startdate",$rec['startdate'],"="),array("AND","enddate",$rec['enddate'],"=")));
	$validate_arr = $this->_model->getAllRecords($validate_cond,"trainingsprofile");
	if(empty($validate_arr)){
		$this->_model->insertRecord($rec,"trainingsprofile");
		//Get the id of the newly created record
		$getid_arr=$this->_model->getAllRecords($validate_cond,"trainingsprofile","",array("tID"));
		$tID = $getid_arr[0]->tID;
		//$tID=2;
		
		//Create Training Sessions Records
		$sess_arr =array();
		for ($i=0; $i < count($sessdesc); $i++) { 
			$sess_arr['tID'][]=$tID;
		}
		
		$sess_arr['sessdesc']=$sessdesc;
		$sess_arr['facilitator']=$facilitators;
		echo $this->_model->insertArray($sess_arr,"trainingsessions");

	}else{
		echo "The training being posted already exists!";
	}
}
public function addlemquestion($render=1,$path="",$tags=array("All")){
	
}
public function postlemquestion(){
	//print_r($_POST);
	echo $this->_model->insertArray($_POST,"lemquestions");
}
public function updatelemqstnstate(){
	//print_r($_POST);
	$update_set = array("status"=>$_POST['status']);
	$update_cond = $this->_model->where(array(array("WHERE","qID",$_POST['qID'],"=")));
	$this->_model->updateQuery($update_set,$update_cond,"lemquestions");
	
	echo "Record Updated successfully";
}
public function retrievestaff(){
	//Get Staff for ICP
	$keno = $_POST['keno'];
	
	$staff_cond=$this->_model->where(array(array("WHERE","fname",$keno,"="),array("AND","department",0,"<>")));
	$staff_rw = $this->_model->getAllRecords($staff_cond,"users","",array("ID","userfirstname","userlastname"));
	$staff_arr=array();
	foreach ($staff_rw as $value) {
		$staff_arr[]=(array)$value;
	}
	
	print_r(json_encode($staff_arr));
}
public function checkregister(){
	//print_r($_POST);
	$detail = $_POST;
	
	//Check if Staff already marked attended for this training
	$chk_attend_cond = $this->_model->where(array(array("WHERE","userID",$detail['userID'],"="),array("AND","trainingID",$detail['trainingID'],"=")));
	$chk_attend_arr  = $this->_model->getAllRecords($chk_attend_cond,"trainingparticipants");
	if(empty($chk_attend_arr)){
		echo $this->_model->insertRecord($detail,"trainingparticipants");
	}else{
		echo "The user has already been marked attended for this training";
	}
}
public function viewparticipants($render=1,$path="",$tags=array("All")){
	
}
}
?>