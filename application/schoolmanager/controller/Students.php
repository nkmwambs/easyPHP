<?php
class Students_Controller extends E_Controller{
     private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Students_Model("students");
    }
    public function newStudent(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent); 
    }
    public function searchStudent(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);        
    }
    public function searchResults(){
        //print_r($_POST);
                //print_r(json_encode($this->_model->searchResultsQuery($_POST)));
                $data = $this->_model->searchResultsQuery($_POST);
                if(is_array($data)){
                    $rst = $data;
                }  else {
                    $rst = "The search could not be completed!";
                }
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("Basic/studentSearchResults",$rst);
		$this->template->view("Basic/footer",$recent); 

    }
    
    public function getFlds(){
        $flds = $this->_model->getStudentsTableFields();
        print_r(json_encode($flds));
    }

    public function addStudentRecord(){
        $rec = $_POST;
        $found_cond=  $this->_model->where(array("where"=>array("admNo",$rec['admNo'],"="),"AND"=>array("fname",$rec['fname'],"!="),"AND"=>array("lname",$rec['lname'],"!=")));
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
       
       $student_cond=  $this->_model->where(array("where"=>array("admNo",$final_arr['admNo'],"=")));
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
        //echo $this->choice[1];
        $draft_cond = $this->_model->where(array("where"=>array("studentKey",  $this->choice[1],"=")));
        $rs = $this->_model->getAllRecords($draft_cond,"students");
        print_r(json_encode($rs));
    }

    public function draftStudentRecords(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $draft_cond = $this->_model->where(array("where"=>array("draft",'1',"=")));
                $data = $this->_model->getAllRecords($draft_cond,"students");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("",$data);
		$this->template->view("Basic/footer",$recent); 
    }
   

    
}
?>