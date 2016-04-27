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
		
		//Get Grade Levels
		$lvls = $this->_model->getAllRecords("","gradelevels");
		
		//Academic Years
		$acYr = $this->_model->getAllRecords("","feestructureheader","",array("DISTINCT academicyear:academicyear"));
		
		//Fees Structures
		$fee_cond = $this->_model->where(array(array("WHERE","academicyear",date("Y"),"=")));
		$fee_qry = $this->_model->getAllRecords($fee_cond,"feestructureheader","",array("fID","academicyear","feestructurename"));
		
		$data=array();
		$data['grades'] = $lvls;
		$data['acYr'] = $acYr;	
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
		
		$data =  array(array("LEFT JOIN","feestructureheader"=>"fID","feestructure"=>"fID"),array("LEFT JOIN","feestructureheader"=>"fID","feestructuregrades"=>"fID"),array("LEFT JOIN","feestructuregrades"=>"gradelevelid","gradelevels"=>"lvlID"));
		
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
		//Get all categories
		$all_cats = $this->_model->getAllRecords("","revenucategories");
		
		$data=array();
		
		$data['cat'] = $all_cats;
		
		return $data;
	}
	public function addcategory(){
		$categoryname =  $_POST['categoryname'];
		$desc = $_POST['desc'];
		
		$arr = array();
		
		$arr['categoryname']=$categoryname;
		$arr['desc'] = $desc;
		
		//Check if Category already exists
		$cat_exists_cond = $this->_model->where(array(array("WHERE","categoryname",$categoryname,"=")));
		$cat_exists_qry = $this->_model->getAllRecords($cat_exists_cond,"revenucategories","",array("categoryname"));
		
		if(count($cat_exists_qry)>0){
			echo "Category already exists";
		}else{
			//echo "Add a new category";
			echo $this->_model->insertRecord($arr,"revenucategories");
		}
		
	}
	
	public function getfeesstructure($render=2,$path='',$tags=array('All')){
		$lvlID = $_POST['lvlID'];
		$academicyear = $_POST['academicyear'];
		
		$str_cond = $this->_model->where(array(array("WHERE","gradelevels.lvlID",$lvlID,"="),array("AND","feestructureheader.academicyear",$academicyear,"=")));
		$str_qry = $this->_model->getAllRecords($str_cond,"feestructure","",array("dsc","amount","period","categoryname"),array(array("LEFT JOIN","feestructure"=>"fID","feestructureheader"=>"fID"),array("LEFT JOIN","feestructure"=>"category","revenucategories"=>"catID"),array("LEFT JOIN","feestructureheader"=>"fID","feestructuregrades"=>"fID"),array("LEFT JOIN","feestructuregrades"=>"gradelevelid","gradelevels"=>"lvlID")));
		
		$fees = array();

		foreach ($str_qry as $value) {
			$amt=$value->amount;
			$arr="";
			if(isset($fees[$value->categoryname])&&array_key_exists($value->period, $fees[$value->categoryname])){
				$amt+=$fees[$value->categoryname][$value->period];
			}
			
			$fees[$value->categoryname][$value->period]= $amt;
			
		}
		
		//print_r($str_qry);
		$data=array();
		
		$data['structure'] = $fees;
		$data['grade'] = $_POST['grade'];
		$data['acYr'] =$academicyear;
		$data['test']=$str_qry;
		
		return $data;
	}
	
}
?>