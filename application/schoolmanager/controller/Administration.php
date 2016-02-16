<?php
class Administration_Controller extends E_Controller{
	private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Register_Model("messages");
    }
    public function showAll($render=1,$path='',$tags=array("All")){

    }
    public function messageboard($render=1,$path='',$tags=array("All")){
    	//Message Type	
    	$msg_qry = $this->_model->getAllRecords("","msgtypes");
		
		//Logos
    	$logos = $this->_model->getAllRecords("","logos");
    	
		$data = array();
		
		$data['rst'] =$msg_qry;
		$data['logos'] = $logos;
		
		return $data;
    }
	public function postmsg(){
		//print_r($_POST);
		$ar = $_POST;
		
		//Check if pointer is used
		$pointer_cond = $this->_model->where(array(array("WHERE","pointer",$ar['pointer'],"=")));
		$pointer_qry = $this->_model->getAllRecords($pointer_cond,"messages","",array("msgID"));
		
		if(count($pointer_qry)>0){
			$set = array("msg"=>$ar['msg'],"boardname"=>$ar['boardname'],"msg_type"=>$ar['msg_type']);
			$update_qry = $this->_model->updateQuery($set,$pointer_cond,"messages");
			echo "Message Updated Successfully";
		}else{
			echo $this->_model->insertRecord($ar,"messages");
		}
		
		
	}
	public function postlogo(){
		$title = $_POST['sitetitle'];
		$logoID = "";
		if(isset($_POST['sellogo'])){
			$logoID = $_POST['sellogo'];
		}
		$filename = $_FILES['imglogo']['name'];
		$filesize = $_FILES['imglogo']['size'];
		$msg ="";
		if($filesize>50000){
			$msg = "The image is larger than 5MB and cannot be uploaded or missing fields";
		}else{	       
	       $target_dir = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."images".DS."logos".DS;
	       $target_dir = $target_dir . $filename; 

	        if (move_uploaded_file($_FILES["imglogo"]["tmp_name"], $target_dir)) {
	        	if($logoID!==""){
					$cond = $this->_model->where(array(array("WHERE","logoID",$logoID,"=")));
					$set = array("url"=>$filename,"title"=>$title);
					$this->_model->updateQuery($set,$cond,"logos");
					$msg = "Logo updated successfully!";
				}else{
					$newLogo = array();
					$newLogo['url']=$filename;
					$newLogo['title']=$title;
					
					$msg = $this->_model->insertRecord($newLogo,"logos");
				}	
	        
			} else {
	            $msg= "Upload Error!";
	        }
			
		}
		
		echo $msg;
	}
	
	public function changedefaultlogo(){
	//print_r($_POST);
		$logoID= "";
		if($_POST['sellogo']){
			$logoID=$_POST['sellogo'];
		}
		
		//Find Default and set it to Zero
		$chk_def_cond = $this->_model->where(array(array("WHERE","viewable",1,"=")));
		$set_to_null = array("viewable"=>0);
		$chk_def_qry = $this->_model->updateQuery($set_to_null,$chk_def_cond,"logos");	
		
		//Set the new default
		$new_def_logo_cond = $this->_model->where(array(array("where","logoID",$logoID,"=")));
		$set_new = array("viewable"=>1);
		$new_def_logo_qry = $this->_model->updateQuery($set_new,$new_def_logo_cond,"logos");
		
		echo "Default logo reset successfully!";
	}
}
?>