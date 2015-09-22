<?php
class ProgramCommunication_Controller extends E_Controller
{
	
private $_model;

public function __construct()
{
        parent::__construct();
        $this->_model=new ProgramCommunication_Model("beneficiaryform");  
}

public function viewAll($render=1,$path='',$tags=array("All")){
	
}
public function selecticps($render=2,$path='',$tags=array("All")){
	//Get ICPs
	$state = $_POST['pullicps'];
	$infotype=$_POST['infotype'];
	
	$arr_cond="";
	if($state!=='5'&&$infotype==='0'){//Selected states,All InfoTypes
		$arr_cond = $this->_model->where(array(array("where","status",$state,"=")));
	}elseif($state==='5'&&$infotype!=='0'){//All State, Selected InfoType
		$arr_cond = $this->_model->where(array(array("where","InfoType",$infotype,"=")));
	}elseif($state!=='5'&&$infotype!=='0'){//Selected States, Selected InfoTypes
		$arr_cond = $this->_model->where(array(array("where","InfoType",$infotype,"="),array("AND","status",$state,"=")));
	}

	$arr = $this->_model->getAllRecords($arr_cond,"beneficiaryform","GROUP BY ID2",array("ID2"));
	
	
	//Status array
	$status =array("New","Declined","Processed","Archived","Flagged","All States","Resolved Flags");
	
	//Information Type
	$info = array("All Information Types","Initial Registration","Information Update");
	
	$data =array();
	$data['icpNos']=$arr;
	$data['state']=$state;
	$data['state_tag']=$status[$state];
	$data['infotype']=$infotype;
	$data['info_tag']=$info[$infotype];
	return $data;
}
public function main($render=1,$path='',$tags=array("All")){
	//Get ICPs
	$arr = $this->_model->getAllRecords("","beneficiaryform","GROUP BY ID2",array("ID2"));
	
	//InfoType Statistics
	$infotype_arr = $this->_model->getAllRecords("","beneficiaryform","GROUP BY InfoType,status",array("count(InfoType):cnt","count(status):cntSt","InfoType","status"));
	
	$data=array();
	$data['icpNos']=$arr;
	$data['state']='5';
	$data['info']='0';
	$data['infotype']=$infotype_arr;
	return $data;
}

public function downloadforms($render=2,$path='',$tags=array("All")){
		
	$icpNo = $_POST['icpNo'];
	$state = $_POST['state'];
	$infotype=$_POST['infotype'];
	
	$offset=0;
	if(isset($_POST['offset'])){
		$offset=$_POST['offset'];
	}
	
	//Get all records for the ICP
	$ben_cond = "";
	if($state!=='5'&&$infotype==='0'&&$icpNo!=='0'){//Selected states,All InfoTypes
		$ben_cond = $this->_model->where(array(array("where","ID2",$icpNo,"="),array('AND',"status",$state,"=")));
	}elseif($state==='5'&&$infotype!=='0'&&$icpNo!=='0'){//All State, Selected InfoType
		$ben_cond = $this->_model->where(array(array("where","ID2",$icpNo,"="),array('AND',"InfoType",$infotype,"=")));
	}elseif($state!=='5'&&$infotype!=='0'&&$icpNo!=='0'){//Selected States, Selected InfoTypes
		$ben_cond = $this->_model->where(array(array("where","ID2",$icpNo,"="),array('AND',"status",$state,"="),array('AND',"InfoType",$infotype,"=")));
	}elseif($state==='5'&&$infotype==='0'&&$icpNo!=='0'){
		$ben_cond = $this->_model->where(array(array("where","ID2",$icpNo,"=")));
	}elseif($icpNo==='0'){
		$ben_cond = $this->_model->where(array(array("where","status",$state,"=")));
	}
	
	$ben_arr = $this->_model->getAllRecords($ben_cond,"beneficiaryform","LIMIT $offset,25"); 
	$total_arr = $this->_model->getAllRecords($ben_cond,"beneficiaryform","",array("COUNT(rID):total")); 
	
		
	//Status array
	$status =array("New","Declined","Processed","Archived","Flagged","All States","Resolved Flags");
	
	//Information Type
	$info = array("All Information Types","Initial Registration","Information Update");
	
	
	$data=array();
	$data['test']=$ben_cond;
	$data['rec']=$ben_arr;
	$data['icpNo']=$icpNo;
	$data['state']=$state;
	$data['state_tag']=$status[$state];
	$data['infotype']=$infotype;
	$data['info_tag']=$info[$infotype];
	$data['offset']=$offset;
	$data['total_rec'] = array_keys(array_chunk(range(1, $total_arr[0]->total), 25));
	return $data;
}
public function excelDownload($render=2,$path='',$tags=array("All")){
	$icpNo = $this->choice[1];
	
	$data=array();
	$data['icpNo']=$icpNo;
	return $data;
}
public function statusupdate(){
	$state = $this->choice[1];
	$rid = $this->choice[3];
	$icpNo = $this->choice[5];

	$sets_str = array("status"=>$state);
	$cond_str = $this->_model->where(array(array("where","rID",$rid,"=")));
	$this->_model->updateQuery($sets_str,$cond_str,"beneficiaryform");
	echo $state;
}
}
?>