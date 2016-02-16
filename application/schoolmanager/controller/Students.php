<?php
class Students_Controller extends E_Controller{
     private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Students_Model("students");
    }
	public function newStudent($render=1,$path='',$tags=array("All")){

    }
    public function searchStudent($render=1,$path='',$tags=array("All")){
    	  
    }
	public function viewprintprofile($render=2,$path='',$tags=array("All")){
		$studentKey = $this->choice[1];
		
		$student_cond =  $this->_model->where(array(array("WHERE","studentKey",$studentKey,"=")));
		$student_arr = $this->_model->getAllRecords($student_cond,"students");
		
		$data['student'] = $student_arr[0];
		
		return $data;
	}
	public function editstudentfromprofile($render=2,$path='newStudent',$tags=array("All")){
		
	}
    public function searchResults($render=1,$path='',$tags=array("All")){
         $data = $this->_model->searchResultsQuery($_POST);
         if(is_array($data)){
         	$rst = $data;
         }  else {
            $rst = "The search could not be completed!";
         }
		return $rst;
    }
    
    public function getFlds(){
        $flds = $this->_model->getStudentsTableFields();
        print_r(json_encode($flds));
    }

    public function addStudentRecord(){
        $rec = $_POST;
        $found_cond=  $this->_model->where(array(array("where","admNo",$rec['admNo'],"="),array("AND","fname",$rec['fname'],"!="),array("AND","lname",$rec['lname'],"!=")));
        $found = $this->_model->getAllRecords($found_cond,"students");
        
        if(is_array($found)&&!empty($found)){
            echo "The admission number (".$rec['admNo'].") provided to this Student was already assigned to ".$found[0]->fname." ".$found[0]->lname." Please reassign this student another number!";
        }else{
       
       if(isset($_POST['talents'])||isset($_POST['medical'])){
       $talents = $_POST['talents'];
       $medical=$_POST['medical'];
       $str_talents="";
       foreach($talents as $val):
           $str_talents.=$val.",";
       endforeach;
       $final_talents = substr_replace($str_talents,"",-1);
       
        $str_medical="";
       foreach($medical as $value):
           $str_medical.=$value.",";
       endforeach;
       $final_medical = substr_replace($str_medical,"",-1);
       
       $new['talents']=$final_talents;
       $new['medical']=$final_medical;
       
       $final_arr=array_replace($rec,$new);
       }else {
           $final_arr=$rec; 
        }
       //$image  = $_FILES;
       //$final_arr['studentImage']=$_POST['fname']." ".$_POST['lname'];
       $final_arr['regBy']=$_SESSION['fname'].' '.$_SESSION['lname'];
       
       $student_cond=  $this->_model->where(array(array("where","admNo",$final_arr['admNo'],"=")));
       $cnt_recs = $this->_model->getAllRecords($student_cond,"students");
       
       if(count($cnt_recs)>0){
           if($cnt_recs[0]->draft==='0'){
               $final_arr['draft']=0;
           }
            $update_flag= $this->_model->updateQuery($final_arr,$student_cond,"students");
           
            if($update_flag===1){
                echo "Record updated successfully!";
            }  else {
                echo $update_flag;
            }
       }  else {
           echo $this->_model->insertRecord($final_arr,"students");
       }
    }
              
    }
    public function completeDraftStudent(){
        $draft_cond = $this->_model->where(array(array("where","studentKey",$this->choice[1],"=")));
        $rs = $this->_model->getAllRecords($draft_cond,"students");
        print_r(json_encode($rs));
    }

    public function draftStudentRecords($render=1,$path='',$tags=array("All")){
		$draft_cond = $this->_model->where(array(array("where","draft",1,"=")));
        $rs = $this->_model->getAllRecords($draft_cond,"students");
		
		return $rs;
    }
   public function findstudent(){
	//$cond_users =  Resources::create_condition($_POST);
	//$qry = $this->_model->getAllRecords($cond_users,"fundsschedule");
	//print_r(json_encode($qry));
	
	$this->create_grid($_POST,"students",array("admNo:Admission Number","fname:First Name","lname:Last Name","sex:Gender","dob:Date Of Birth","active:Active?"));
}
	public function manageStudents($render=1,$path='',$tags=array("All")){
		
	}   
   public function finance($render=1,$path='',$tags=array("All")){

    }
   public function academic($render=1,$path='',$tags=array("All")){

    }
   public function classmanager($render=1,$path='',$tags=array("All")){
   	
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
   public function createclass($render=1,$path='',$tags=array("All")){
   		//Populate Tutors
   		$teacher_cond = $this->_model->where(array(array("where","userlevel",4,"=")));
		$teacher_qry = $this->_model->getAllRecords($teacher_cond,"users","",array("ID","fname","lname"));
		
		//Populate Classes
		$class_cond = $this->_model->where(array(array("WHERE","academicyear",date("Y"),"=")));
		$class_qry = $this->_model->getAllRecords($class_cond,"classes","",array("classID","classname"));
	
   		//Populate Grades
   		$grade_qry = $this->_model->getAllRecords("","gradelevels");
		
		$data = array();
		
		$data['rst'] = $grade_qry;
		$data['tutor'] = $teacher_qry;
		$data['class']=$class_qry;
		
		return $data;
   }
  public function viewclass($render=1,$path='',$tags=array("All")){
   	return $this->schoolmanager();
   }   
  public function newclass(){
  	//print_r($_POST);
  	$arr = $_POST;
	
	$tutor = $arr['tutorid'];
	$grade = $arr['gradelevelid'];
	$academicyear = $arr['academicyear'];
	$classname = $arr['classname'];
	
	//Check if record exist
	$rec_cond = $this->_model->where(array(array("where","tutorid",$tutor,"="),array("AND","gradelevelid",$grade,"="),array("AND","academicyear",$academicyear,"=")));
	$rec_qry = $this->_model->getAllRecords($rec_cond,"classes");
	
	if(count($rec_qry)===0){	
		echo $this->_model->insertRecord($arr,"classes");
	}else{
		echo "There is already a class created for the same tutor and grade with a class name ".$classname." in year ".$academicyear;
	}
  }
  
  public function enrollclass(){
  	$ctrl = array_shift($_POST);
  	$arr_fin  = $_POST;
	$msg ="No record added or deleted. Student not found!";//implode(",", array_keys($arr_fin));
	$skey = "";
	$enrolled = 0;
	$flag=0;
	$enrollID = "";
	
	//Find if child record is available and active
	$available_cond = $this->_model->where(array(array("WHERE","admNo",$arr_fin['admissionnum'],"="),array("AND","active","Yes","=")));
	$available_qry = $this->_model->getAllRecords($available_cond,"students","",array("studentKey"));
	if(count($available_qry)>0){
		$skey = $available_qry[0]->studentKey;
		$arr_fin['studentkey'] = $skey;
		$admNo = array_shift($arr_fin);
		$flag=1;
	}
	

	//Find if child record is already in the class
	if($flag===1){
		$in_class_cond = $this->_model->where(array(array("WHERE","classenroll.studentkey",$skey,"="),array("AND","classes.academicyear",date("Y"),"=")));//array("AND","classenroll.classid",$arr_fin['classid'],"="),
		$in_class_qry = $this->_model->getAllRecords($in_class_cond,"classenroll","",array("classenroll.enrollID:enrollID","classes.classname:classname"),array("LEFT JOIN"=>array("classenroll"=>"classid","classes"=>"classID")));
		
		if(count($in_class_qry)>0&&$ctrl==="1"){
			$msg = "The student number ".$admNo." is already enrolled in {$in_class_qry[0]->classname} in the academic year ".date("Y");
		}else if(count($in_class_qry)>0&&$ctrl==="0"){
			$enrollID = $in_class_qry[0]->enrollID;
			$enrolled = 2;
		}else if(count($in_class_qry)===0&&$ctrl==="1"){
			$enrolled = 1;		
		}
	}

	if($enrolled===1){
			//$msg = implode(",",array_keys($arr_fin));
			$msg = $this->_model->insertRecord($arr_fin,"classenroll");
	}else if($enrolled===2){
			$del_cond = $this->_model->where(array(array("WHERE","enrollID",$enrollID,"=")));
			$msg = $this->_model->deleteQuery($del_cond,"classenroll");
	}

	echo $msg;
	
  }
public function studentinclasssearch(){
		$admNo = $_POST['admissionnum'];
		$msg = "No record found";
		$flag=0;
		
		//Find if child record is available and active
		$available_cond = $this->_model->where(array(array("WHERE","admNo",$admNo,"="),array("AND","active","Yes","=")));
		$available_qry = $this->_model->getAllRecords($available_cond,"students","",array("studentKey"));
			if(count($available_qry)>0){
				$skey = $available_qry[0]->studentKey;
				$msg ="<b>Student's Summary for student number: ".$admNo."</b><br>";
				$msg .="Student is Registered and Active<br>";
				$flag=1;
			}
		
		if($flag===1){
			$in_class_cond = $this->_model->where(array(array("WHERE","classenroll.studentkey",$skey,"="),array("AND","classes.academicyear",date("Y"),"=")));
			$in_class_qry = $this->_model->getAllRecords($in_class_cond,"classenroll","",array("classes.classname:classname","gradelevels.levelName:gradelevel"),array("LEFT JOIN"=>array("classenroll"=>"classid","classes"=>"classID"),"RIGHT JOIN"=>array("classes"=>"gradelevelid","gradelevels"=>"lvlID")));
			if(count($in_class_qry)>0){
				$msg .="Student is enrolled in class ".$in_class_qry[0]->classname." grade level ".$in_class_qry[0]->gradelevel;
			}
		}
		
		echo $msg;
	}
	public function classesjoin(){
		//$data = array("LEFT JOIN"=>array("classes"=>"classID","classenroll"=>"classid"));
		$data = array(array("LEFT JOIN","classes"=>"classID","classenroll"=>"classid"),array("LEFT JOIN","classes"=>"gradelevelid","gradelevels"=>"lvlID"),array("LEFT JOIN","classes"=>"tutorid","users"=>"ID"));
		return $data;
	}
	public function classenrolljoin(){
		//$data = array("LEFT JOIN"=>array("classes"=>"classID","classenroll"=>"classid"));
		$data = array(array("LEFT JOIN","classenroll"=>"classid","classes"=>"classID"),array("LEFT JOIN","classes"=>"gradelevelid","gradelevels"=>"lvlID"),array("LEFT JOIN","classes"=>"tutorid","users"=>"ID"),array("LEFT JOIN","classenroll"=>"studentkey","students"=>"studentKey"));
		return $data;
	}
	public function searchclass($render=2,$path='',$tags=array("All")){
		$inp_arr = $_POST;
		
		$classname = $inp_arr['classname'];
		$gradelevelid = $inp_arr['gradelevelid'];
		$academicyear = $inp_arr['academicyear'];
		
		$search_cond="";
		
		if(empty($classname)&&!empty($gradelevelid)&&!empty($academicyear)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.gradelevelid",$gradelevelid,"="),array("AND","classes.academicyear",$academicyear,"=")));
		}elseif(empty($gradelevelid)&&!empty($classname)&&!empty($academicyear)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.classname",$classname,"LIKE"),array("AND","classes.academicyear",$academicyear,"=")));	
		}elseif(empty($academicyear)&&!empty($classname)&&!empty($gradelevelid)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.classname",$classname,"LIKE"),array("AND","classes.gradelevelid",$gradelevelid,"=")));
		}elseif(empty($classname) && empty($gradelevelid)&& !empty($academicyear)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.academicyear",$academicyear,"=")));
		}elseif(empty($classname)&& empty($academicyear)&& !empty($gradelevelid)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.gradelevelid",$gradelevelid,"=")));
		}elseif(empty($gradelevelid)&& empty($academicyear)&& !empty($classname)){
			$search_cond = $this->_model->where(array(array("WHERE","classes.classname",$classname,"LIKE")));
		}else{
			$search_cond="";
		}
		
		$search_qry = $this->_model->getAllRecords($search_cond,"classes","GROUP BY classenroll.classid",array("classes.classID:Class ID","classes.classname:Class Name","gradelevels.levelName:Grade","users.fname:Class Teacher","classes.academicyear:Academic Year","COUNT(classenroll.studentkey):Count Of Students"),$this->classesjoin());
		
		
		$data=array();
		
		$data['rec'] = $search_qry;

		//echo $search_cond;
		
		return $data;
	}
	public function showStudents($render=2,$path='',$tags=array("All")){
		$classid = $_POST['classid'];
		
		$enrol_cond = $this->_model->where(array(array("WHERE","classenroll.classid",$classid,"=")));
		$enrol_qry = $this->_model->getAllRecords($enrol_cond,"classenroll","",array("students.studentKey:System ID","students.admNo:Admission Number","students.fname:First Name","students.lname:Last Name","gradelevels.levelName:Grade","students.sex:Gender"),$this->classenrolljoin());
		
		$dropdwns = $this->schoolmanager();	
		$data=array();
		
		$data['rec'] = $enrol_qry;
		$data['dropdwns'] = $dropdwns;		
		return $data;
	
	}
	public function viewfullstudentprofile($render=2,$path='',$tags=array("All")){
		$admNo = $_POST['admNo'];
		
		$s_cond = $this->_model->where(array(array("WHERE","admNo",$admNo,"=")));
		$bio_qry = $this->_model->getAllRecords($s_cond,"students","",array("studentKey:System ID","AdmNo:Admission Number","fname:First Name","lname:Last Name","sex:Gender","dob:Date Of Birth","nationality:Nationality","active:Active Record"));
		
		$loc_qry = $this->_model->getAllRecords($s_cond,"students","",array("county:County Of Residence","ward:Ward","area:Estate/ Area of Residence","street:Street"));
		
		$data=array();
		
		$data['bio'] = $bio_qry;
		$data['loc'] = $loc_qry;
		
		return $data;
	}
	
	public function promoteselectedstudents(){
		//print_r($_POST);
		
		$combArr = $_POST;
		$classid =  array_shift($combArr);
		$academicyear = array_shift($combArr);
		$classname = array_shift($combArr);
		$msg = "";
		
		//check if class exists
		$class_exists_cond = $this->_model->where(array(array("WHERE","classes.academicyear",$academicyear,"=")));
		$class_exists_qry = $this->_model->getAllRecords($class_exists_cond,"classes","",array("classID"));
		
		//Create an array for SQL insert query	
		$promo_arr = array();
		foreach ($combArr as $value) {
			$promo_arr['studentkey'][]=$value;
			$promo_arr['classid'][]=$classid;
		}
		
		//check if the students are enrolled to the class by key
		
		//$chk_enrolled_cond = $this->_model->where(array(array("WHERE","classenroll.classid",$classid,"="),array("AND","classes.academicyear",$academicyear,"=")));
		//$chk_enrolled_qry = $this->_model->getAllRecords($chk_enrolled_cond,"classenroll","",array("classenroll.studentkey:studentkey"),$this->classenrolljoin());
		//$fine_enrolled_arr = array();
		//foreach ($chk_enrolled_qry as $value) {
			//$fine_enrolled_arr[]=$value->studentkey;
		//}
		
		
		
		//check if the students are enrolled to other class by key
		//$chk_enrolled_other_cond = $this->_model->where(array(array("WHERE","classenroll.classid",$classid,"<>"),array("AND","classes.academicyear",$academicyear,"=")));
		$chk_enrolled_other_cond = $this->_model->where(array(array("WHERE","classes.academicyear",$academicyear,"=")));
		$chk_enrolled_other_qry = $this->_model->getAllRecords($chk_enrolled_other_cond,"classenroll","",array("classenroll.studentkey:studentkey"),$this->classenrolljoin());
		//$fine_enrolled_other_arr = array();
		$all_enrolled_arr = array();
		foreach ($chk_enrolled_other_qry as $value) {
			//$fine_enrolled_other_arr[]=$value->studentkey;
			$all_enrolled_arr[]=$value->studentkey;
		}
		
		//Create array for all enrolled		
		//$all_enrolled_arr = array_merge($fine_enrolled_arr,$fine_enrolled_other_arr);
		
		$cnt_new = 0;
		$cnt_exists = 0;
		$new_promo_arr = array();
		$update_promo_arr=array();
		
		foreach ($combArr as $value) {
			if(in_array($value,$all_enrolled_arr)){
				$update_promo_arr[]=$value;
				//$cnt_exists++;
			}else{
				$new_promo_arr['studentkey'][]=$value;
				$new_promo_arr['classid'][]=$classid;
				//$cnt_new++;
			}
		}
		
		//$cnt_new = count($new_promo_arr['studentkey']);
		//$cnt_exists = count($update_promo_arr);
		
		
		if(count($update_promo_arr)>0){
			$cnt_exists = count($update_promo_arr);
			foreach($update_promo_arr as $key){
				$set = array("classid"=>$classid);
				$cnd = $this->_model->where(array(array("WHERE","studentkey",$key,"=")));
				$this->_model->updateQuery($set,$cnd,"classenroll");
			}
		}
		
		
		if(isset($new_promo_arr['studentkey'])){
			if(count($new_promo_arr['studentkey'])>0){
				$cnt_new = count($new_promo_arr['studentkey']);
				$this->_model->insertArray($new_promo_arr,"classenroll").". ";
			}
		}
				
		if(count($class_exists_qry)===0){
			$msg = "You can't promoted students to a non existing class. Please consider creating the class before promoting";
		}else{
			$sum = $cnt_exists+$cnt_new;
			$msg = "Updated ".$cnt_exists." Records. Created ".$cnt_new." Records. ".$sum." students promoted/ demoted successfully.";
		}
		
		echo $msg;
	}
}
?>