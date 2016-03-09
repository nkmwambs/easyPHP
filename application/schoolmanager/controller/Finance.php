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
		
		//Fees Structures
		$fee_cond = $this->_model->where(array(array("WHERE","academicyear",date("Y"),"=")));
		$fee_qry = $this->_model->getAllRecords($fee_cond,"feestructureheader","",array("fID","academicyear","feestructurename"));
		
		$data=array();
		
		$data['grade'] = $arr['gradelevels'];
		$data['fees'] = $fee_qry;
		
		return $data;	
	}
	public function accounts($render=1,$path='',$tags=array("All")){
		
	}
	public function reports($render=1,$path='',$tags=array("All")){
		
	}		
	
	public function createnewstructure(){
		$sArr = $_POST;
		
		$fID = array_shift($sArr);
		
		$grades = array_shift($sArr);
		
		
		//Gradelevel Arr
		$final_grade_arr = array();		
		
		for($i=0;$i<count($grades);$i++){
			$final_grade_arr['fID'][]=$fID;
			$final_grade_arr['gradelevelid'][]=$grades[$i];
		}
		
		//fees structure details arr
		
		//$details = array();
		
		for ($j=0; $j < count($sArr['dsc']); $j++) { 
			$sArr['fID'][]=$fID;
		}
		
		
		//Insert
		$this->_model->insertArray($final_grade_arr,"feestructuregrades");
		echo " (Step 1 of 2)<br>";
		$this->_model->insertArray($sArr,"feestructure");
		echo " (Step 2 of 2)";
	}
	
	public function getfeestructurefields(){
		//get all
		$qry = $this->_model->getAllRecords("","feestructureperiod");
		
		$rev = $this->_model->getAllRecords("","revenucategories");
		
		$data =array();
		
		$data['cat'] = $rev;
		$data['period']=$qry;
		
		print_r(json_encode($data));
	}
	public function newfeestructure(){
		$arr = $_POST;
		
		echo $this->_model->insertRecord($arr,"feestructureheader");
	}
	public function feestructurejoin(){
		$data = array();
		
		$data =  array(array("LEFT JOIN","feestructureheader"=>"fID","feestructure"=>"fID"),array("LEFT JOIN","feestructureheader"=>"fID","feestructuregrades"=>"fID"));
		
		return $data;
	}
	public function deletefeestructure(){
		$fID=$_POST['fID'];
		
		$del_cond = $this->_model->where(array(array("WHERE","fID",$fID,"=")));
		
		$this->_model->deleteQuery($del_cond,"feestructureheader");
		$this->_model->deleteQuery($del_cond,"feestructure");
		$this->_model->deleteQuery($del_cond,"feestructuregrades");
		
		echo "Fee Structure deleted successfully";
	}
	
	public function movefeestructure(){
		$del_cond = $this->_model->where(array(array("WHERE","fID",$fID,"=")));
		
	}
	public function categories($render=1,$path='',$tags=array("All")){

	}
}
?>