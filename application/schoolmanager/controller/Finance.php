<?php
class Finance_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Finance_Model("recent");
    }    
	public function schoolmanager(){
   		//Populate Tutors
   		$teacher_cond = $this->_model->where(array(array("where","userlevel",4,"=")));
		$teacher_qry = $this->_model->getAllRecords($teacher_cond,"users","",array("ID","fname","lname"));
		
		//Populate Classes
		$class_cond = $this->_model->where(array(array("WHERE","academicyear",date("Y"),"=")));
		$class_qry = $this->_model->getAllRecords($class_cond,"classes","",array("classID","classname"));
	
   		//Populate Grades
   		$grade_qry = $this->_model->getAllRecords("","gradelevels","",array("lvlID","levelName"));
		
		$data = array();
		
		$data['gradelevels'] = $grade_qry;
		$data['tutors'] = $teacher_qry;
		$data['classes']=$class_qry;
		
		return $data;
   }
    public function showAll($render=1,$path='',$tags=array("All")){

    }
	public function feeStructure($render=1,$path='',$tags=array("All")){
		$arr = $this->schoolmanager();
		$data=array();
		
		$data['grade'] = $arr['gradelevels'];
		
		return $data;	
	}
	public function accounts($render=1,$path='',$tags=array("All")){
		
	}
	public function reports($render=1,$path='',$tags=array("All")){
		
	}		
	
	public function createnewstructure(){
		print_r($_POST);
	}
}
?>