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
   
}
?>