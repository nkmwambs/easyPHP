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
    	$msg_qry = $this->_model->getAllRecords("","msgtypes");
    	
		$data = array();
		
		$data['rst'] =$msg_qry;
		
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
}
?>