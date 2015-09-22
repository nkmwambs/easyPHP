<?php
class Reports_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Reports_Model("users");
    }
    public function viewAll($render=1,$path="",$tags=array("All")){
        //$data = "All Reports!";
		//return $data;
		return $this->_model->getAllRecords("","queries");
    }
	public function queryView($render=2,$path='',$tags=array("All")){
		//$sql = "SELECT ".$_POST['query'];
		//return $this->_model->queryTables($sql);
		$sql = $_POST['query'];
		$okQry = substr_count($sql,"SELECT",0);
		if($okQry>0){
			$data =  $this->_model->queryTables($sql);
		}else{
			$data = "Query denied. Contact the administrator!";
		}
		//if(empty($data)){
			//return "Invalid Query";
		//}else{
			return $data;
		//}
		
	}
    public function csp($render=1,$path="",$tags=array("1")){
    		$csp_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
        	$csp_qry = $this->_model->getAllRecords($csp_cond,"csp_projects");
			
			$qtr_cond = $this->_model->where(array(array("where","keno",Resources::session()->fname,"=")));
			$qtr=$this->_model->getAllRecords($qtr_cond,"csp_monthly_report");
			//$data = $csp_qry[0]->csp_num;
			$data[] =$csp_qry;
			$data[]= $qtr;
			return $data;
    }
    
	public function submitCsp(){
		//print_r($_POST);
		$chk=$this->_model->where(array(array("where","period",$_POST['period'],"="),array("AND","month",$_POST['month'],"="),array("AND","cspNo",$_POST['cspNo'],"=")));
		$qry = $this->_model->getAllRecords($chk,"csp_monthly_report");
		if(count($qry)>0){
			//print("Report already available!");
			$this->_model->deleteQuery($chk,"csp_monthly_report");
		}
			print($this->_model->insertRecord($_POST,"csp_monthly_report"));
					
	
	}
	
	public function showCspRpt($render=2,$path="",$tags=array("All")){
		
		if(isset($this->choice[3])){
			$period = $this->choice[1];
			$month = $this->choice[3];
			$rpt_cond = $this->_model->where(array(array("where","period",$period,"="),array("AND","month",$month,"="),array("AND","keno",Resources::session()->fname,"=")));
			$rpt_qry = $this->_model->getAllRecords($rpt_cond,"csp_monthly_report");
		}else{
			$rid = $this->choice[1];
			$rpt_cond = $this->_model->where(array(array("where","rid",$rid,"=")));
			$rpt_qry = $this->_model->getAllRecords($rpt_cond,"csp_monthly_report");			
		}
			return $rpt_qry;
	}
	
	public function deleteCsp(){
		//print($this->choice[1]);
		$chk=$this->_model->where(array(array("where","rid",$this->choice[1],"=")));
		$rec = $this->_model->getAllRecords($chk,"csp_monthly_report");
		if(count($rec)>0){
			print($this->_model->deleteQuery($chk,"csp_monthly_report"));
		}else{
			print("Record not available!");
		}
		//dispatch($render="1",$path='csp',$results='',$tags=array("1"));
	}
	
	public function viewCsp($render=1,$path='',$tags=array("All")){
		//if(isset($this->choice[1])){
			//$period=$this->choice[1];
		//}else{
			$fy =  Resources::func('get_financial_year',array(date("Y-m-d")));	
			$qtr = Resources::func('financial_quarter',array(date("Y-m-d")));
			$period = "FY20".$fy."Q".$qtr;
		//}
		$rpt_cond="";
		if(Resources::session()->userlevel==="2"){
			$rpt_cond = $this->_model->where(array(array("where","period",$period,"="),array("AND","cname",Resources::session()->cname,"=")));
		}else{
			$rpt_cond = $this->_model->where(array(array("where","period",$period,"=")));	
		}
		
		$rpt_qry = $this->_model->getAllRecords($rpt_cond,"csp_monthly_report","ORDER BY month,cspNo");
		
		$qtr_qry = $this->_model->cspRptQtrs();
		
		$data[]=$rpt_qry;
		$data[]=$qtr_qry;
		
		return $data;
		
	}
	public function nonIcpCspView($render=2,$path='',$tags=array("All")){
		//if(isset($this->choice[1])){
			$period=$this->choice[1];
		//}else{
			//$fy =  Resources::func(get_financial_year,array(date("Y-m-d")));	
			//$qtr = Resources::func(financial_quarter,array(date("Y-m-d")));
			//$period = "FY20".$fy."Q".$qtr;
		//}
		if($this->choice[3]!=="0"){
			$rpt_cond = $this->_model->where(array(array("where","period",$period,"="),array("AND","month",$this->choice[3],"=")));
		}else{
			$rpt_cond = $this->_model->where(array(array("where","period",$period,"=")));	
		}
		
		$rpt_qry = $this->_model->getAllRecords($rpt_cond,"csp_monthly_report");
		
		$qtr_qry = $this->_model->cspRptQtrs();
		
		$data[]=$rpt_qry;
		$data[]=$qtr_qry;
		
		return $data;
		
	}
	function cspExcel($render=2,$path='',$tags=array("All")){
		//return "Hello";
		$qtr = "FY2015Q3";
		$cond = $this->_model->where(array(array("where","period",$qtr,"=")));
		$qry = $this->_model->getAllRecords($cond,"csp_monthly_report");
		return $qry;
	}
    public function health($render=1,$path="",$tags=array("All")){
        $data = "Health Report!";
		return $data;
    }
   
    public function hvcQtrly($render=1,$path="",$tags=array("All")){
        $data = "HVC Report!";
		return $data;
    }
    
    public function pds($render=1,$path="",$tags=array("All")){
        $data = "Monthly PD's Report!";
		return $data;
    }
public function getChildrenDetails(){
	$str=$this->choice[1];
	$newStr = str_replace("_","-",$str);
	
	//echo $newStr;
	
	$chk_cond = $this->_model->where(array(array("where","childNo",$newStr,"=")));
	$chk_arr = $this->_model->getAllRecords($chk_cond,"childdetails");
	
	print(json_encode($chk_arr[0]));
}
        
    public function hvcIndexing(){
        //$data = "Annual HVC Indexing Form!";
        $data = array();
		$path='';
		//Get ICP Cluster
		$clst_cond = $this->_model->where(array(array("where","fname",Resources::session()->fname,"=")));
		$clst_arr = $this->_model->getAllRecords($clst_cond,"users");
		$clst = $clst_arr[0]->cname;
		$icp = $clst_arr[0]->fname;
		
		//Vulnerabilities
		$vul_arr = $this->_model->getAllRecords("","vulnerability");
		
		//intervention
		$int_arr = $this->_model->getAllRecords("","intervention");
		
		//non_hvc_int
		$otherInt_arr = $this->_model->getAllRecords("","non_hvc_int");
		
		//Global Allowable Active Case count CSP
		$cnt_csp_cond = $this->_model->where(array(array("where","prg","1","=")));
		$cnt_csp_arr = $this->_model->getAllRecords($cnt_csp_cond,"hvc_limit");
		$csp_limit = $cnt_csp_arr[0]->limit;
		
		//Active CSP cases count
		$active_csp_cond = $this->_model->where(array(array("where","pNo",Resources::session()->fname,"="),array("AND","prg","1","="),array("AND","active","1","=")));
		$active_csp_arr = $this->_model->getAllRecords($active_csp_cond,"indexing");
		$active_csp = count($active_csp_arr);
		
		//Specific ICP allowable CSP cases
		$allowable_csp = $csp_limit-$active_csp;
		
		
		//Global Allowable Active Case count CSP
		$cnt_cdsp_cond = $this->_model->where(array(array("where","prg","2","=")));
		$cnt_cdsp_arr = $this->_model->getAllRecords($cnt_cdsp_cond,"hvc_limit");
		$cdsp_limit = $cnt_cdsp_arr[0]->limit;
		
			//Active CDSP cases count
		$active_cdsp_cond = $this->_model->where(array(array("where","pNo",Resources::session()->fname,"="),array("AND","prg","2","="),array("AND","active","1","=")));
		$active_cdsp_arr = $this->_model->getAllRecords($active_cdsp_cond,"indexing");
		$active_cdsp = count($active_cdsp_arr);
		
		//Specific ICP allowable CSP cases
		$allowable_cdsp = $cdsp_limit-$active_cdsp;
		
		//Get the Recent HVC Indexing Closure Date and FY
		$max_closure_date = $this->_model->getAllRecords("","hvc_closure_dates","",array("MAX(fy)","fy","closureDate"));
		
		//Check if ICP has CSP
		$has_csp_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
		$has_csp_arr = $this->_model->getAllRecords($has_csp_cond,"csp_projects");
		$has_csp = count($has_csp_arr);
		
		//Get CSP Number
		if($has_csp===1){
			$data['csp']=$has_csp_arr[0]->cspNo;
		}
		
		$data['clst']=$clst;
		$data['icp']=$icp;
		$data['vul']=$vul_arr;
		$data['int']=$int_arr;
		$data['otherInt']=$otherInt_arr;
		$data['csp_limit']=$allowable_csp;
		$data['cdsp_limit']=$allowable_cdsp;
		$data['current_closure_date']=$max_closure_date[0];
		$data['has_csp']=$has_csp;
		
		$data['test']="";
		//return $data;
		if(Resources::session()->userlevel==='1'){
			$path='';
		}else{
			$data = $this->manageHvc();
			$path="manageHvc";
		}
		
		$this->dispatch($render=1,$path, $data,$tags=array("All"));
    }
	public function submitHvcIndex(){
		//print_r($_POST);
		$vul = implode(",", $_POST['vul']);
		$intervene = implode(",", $_POST['intervene']);
		$othSup = implode(",", $_POST['othSup']);
		
		$_POST['vul']= $vul;
		$_POST['intervene']=$intervene;
		$_POST['othSup']=$othSup;
		
		$arr = $_POST;
		//print_r($_POST);
		
		//Check if deadline
		$deadline_arr = $this->_model->getAllRecords("","hvc_closure_dates","",array("MAX(fy)","fy","closureDate"));
		$max_date = $deadline_arr[0]->closureDate;
		
		//Check allowable slots
		
				//Global Allowable Active Case count CSP
				$cnt_csp_cond = $this->_model->where(array(array("where","prg","1","=")));
				$cnt_csp_arr = $this->_model->getAllRecords($cnt_csp_cond,"hvc_limit");
				$csp_limit = $cnt_csp_arr[0]->limit;
				
				//Active CSP cases count
				$active_csp_cond = $this->_model->where(array(array("where","pNo",Resources::session()->fname,"="),array("AND","prg","1","="),array("AND","active","1","=")));
				$active_csp_arr = $this->_model->getAllRecords($active_csp_cond,"indexing");
				$active_csp = count($active_csp_arr);
				
				//Specific ICP allowable CSP cases
				$allowable_csp = $csp_limit-$active_csp;
				
				
				//Global Allowable Active Case count CSP
				$cnt_cdsp_cond = $this->_model->where(array(array("where","prg","2","=")));
				$cnt_cdsp_arr = $this->_model->getAllRecords($cnt_cdsp_cond,"hvc_limit");
				$cdsp_limit = $cnt_cdsp_arr[0]->limit;
				
					//Active CDSP cases count
				$active_cdsp_cond = $this->_model->where(array(array("where","pNo",Resources::session()->fname,"="),array("AND","prg","2","="),array("AND","active","1","=")));
				$active_cdsp_arr = $this->_model->getAllRecords($active_cdsp_cond,"indexing");
				$active_cdsp = count($active_cdsp_arr);
				
				//Specific ICP allowable CSP cases
				$allowable_cdsp = $cdsp_limit-$active_cdsp;
		
		
		if($max_date<date("Y-m-d")){
			echo "Indexing deadline has passed! Case not Indexed";
		}elseif($allowable_csp===0&&$_POST['prg']==='1'){
			echo "You have reached the maximum number allowable to be indexed for CSP program. Record not posted!";
		}elseif($allowable_cdsp===0&&$_POST['prg']==='2'){
			echo "You have reached the maximum number allowable to be indexed for CDSP program. Record not posted!";
		}else{
			//Count duplicated
			$duplicate_cond = $this->_model->where(array(array("where","childNo",$_POST['childNo'],"="),array("AND","active",1,"=")));
			$duplicate_arr = $this->_model->getAllRecords($duplicate_cond,"indexing");
			
			if(!empty($duplicate_arr)){
				echo "You are posting a duplicate record. A beneficiary can only be re-indexed after a period not less than one Year";
			}else{
			echo $this->_model->insertRecord($arr,"indexing");
			}
		}
	}
	public function manageHvc($render=1,$path="",$tags=array("All")){
		$data=array();
		$cases_cond='';
		$active=1;
		$icpNo=Resources::session()->fname;
		$cst=Resources::session()->cname;
		
		if(isset($this->choice[1])&&$this->choice[0]==='state'){
			$active=$this->choice[1];
		}
		
		if(isset($this->choice[3])){
			$icpNo=$this->choice[3];
			$data['setPF']=1;	
			$data['icpNo']=$icpNo;
		}
		
		if(isset($this->choice[1])&&$this->choice[0]==='cst'){
			$cst=str_replace("_","-",$this->choice[1]);
			$data['setOther']=1;
		}
		
		if(Resources::session()->userlevel==='1'||isset($data['setPF'])){
			$cases_cond = $this->_model->where(array(array("where","pNo",$icpNo,"="),array("AND","active",$active,"=")));
		}elseif(Resources::session()->userlevel==='2'||isset($data['setOther'])){
			$cases_cond = $this->_model->where(array(array("where","cst",$cst,"="),array("AND","active",$active,"=")));
		}else{
			$cases_cond='';
		}
		
		//All HVC Cases
		$cases_arr = $this->_model->getAllRecords($cases_cond,"indexing");
		
		//ICP with Indexed Beneficiaries
		$icp_arr = array();
		foreach ($cases_arr as $value) {
			$icp_arr[$value->pNo][]=$value;
		}
		
		//Clusters With Indexed Beneficiaries
		$clst_arr = array();
		foreach ($cases_arr as $value) {
			$clst_arr[$value->cst][$value->pNo][]=$value;
			
		}
		
		
		$data['allCases']=$cases_arr;
		$data['caseGrpByIcp']=$icp_arr;
		$data['caseGrpByCst']=$clst_arr;
		
		$data['test']="";
		
		return $data;
	}

	public function inactivateCase(){
		$cid = $this->choice[1];
		$inactivate_cond = $this->_model->where(array(array("where","indID",$cid,"=")));
		$sets = array("active"=>0);
		echo $this->_model->updateQuery($sets,$inactivate_cond,"indexing");
	}
	public function newQuery(){
		//print_r($_POST);
		$data['qryName']=$_POST['qryName'];
		$data['qryDetail']=$_POST['query'];
		print($this->_model->insertRecord($data,"queries"));
	}
public function history($render=1,$path='',$tags=array("All")){
	$user_cond = $this->_model->where(array(array("where","ID",Resources::session()->ID,"=")));
	$user_arr = $this->_model->getAllRecords($user_cond,"users");
	
	$hist_cond=$this->_model->where(array(array("where","user_tbl_fname",$user_arr[0]->fname,"=")));
	$hist_arr = $this->_model->getAllRecords($hist_cond,"history");
	
	$data=array();
	$data['all_hist']=$hist_arr;
	
	return $data;
}
public function malnutrition($render=1,$path='',$tags=array("All")){
	
}
public function registerMalCase($render=1,$path='',$tags=array("All")){
	$data=array();
	//Get ICP Cluster
		$clst_cond = $this->_model->where(array(array("where","fname",Resources::session()->fname,"=")));
		$clst_arr = $this->_model->getAllRecords($clst_cond,"users");
		$clst = $clst_arr[0]->cname;
		$icp = $clst_arr[0]->fname;
		
	//Check if ICP has CSP
		$has_csp_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
		$has_csp_arr = $this->_model->getAllRecords($has_csp_cond,"csp_projects");
		$has_csp = count($has_csp_arr);
		
		//Get CSP Number
		if($has_csp===1){
			$data['csp']=$has_csp_arr[0]->cspNo;
		}
	
	$data['cst']=$clst;
	$data['icp']=$icp;
	$data['has_csp']=$has_csp;
	
	return $data;
}
public function updateMalCase($render=1,$path='',$tags=array("All")){
	$icpNo = Resources::session()->fname;
	//Get All Cases
	$mal_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
	$mal_arr = $this->_model->getAllRecords($mal_cond,"malnutrition","",array("malID","childNo","childName","childDOB","sex"));
	
	$data=array();
	$data['mal']=$mal_arr;
	return $data;
}
public function newMalCase(){
	//Check for Duplicates
	$childNo = $_POST['childNo'];
	$chk_dups_cond = $this->_model->where(array(array("where","childNo",$childNo,"=")));
	$chk_dups_arr = $this->_model->getAllRecords($chk_dups_cond,"malnutrition","",array("icpNo","childNo"));
	$chk_if_exists = count($chk_dups_arr);
	
	if($chk_if_exists===0){
		echo $this->_model->insertRecord($_POST,"malnutrition");	
	}else{
		echo "Record already exists";
	}
	
}
public function tfiUpdate($render=1,$path='',$tags=array("All")){
	//Get records posted
	$malID=$this->choice[3];
	$rec_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$rec_arr = $this->_model->getAllRecords($rec_cond,"malupdatetfi");
	
	$data=array();
	$data['childNo']=$this->choice[1];
	$data['malID']=$this->choice[3];
	$data['rec']=$rec_arr;
	return $data;
}
public function newtfiUpdate(){
	echo $this->_model->insertRecord($_POST,"malupdatetfi");
}
public function malmetricsUpdate($render=1,$path='',$tags=array("All")){
	//Get records posted
	$malID=$this->choice[3];
	$rec_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$rec_arr = $this->_model->getAllRecords($rec_cond,"malmetricsupdate");
	
	$data=array();
	$data['childNo']=$this->choice[1];
	$data['malID']=$this->choice[3];
	$data['rec']=$rec_arr;
	return $data;
}
public function newmalmetricsupdate(){
	echo $this->_model->insertRecord($_POST,"malmetricsupdate");
}
public function malcaseview($render=1,$path='',$tags=array("All")){
	$malID=$this->choice[1];
	
	//Get Mal Indentifier Record
	$mal_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$mal_arr = $this->_model->getAllRecords($mal_cond,"malnutrition");
	
	//Enrol Date
	$enrolDate = "";
	$enrol_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$enrol_arr = $this->_model->getAllRecords($enrol_cond,"othertfienrol");
	if(!empty($enrol_arr)){
		$enrolDate=$enrol_arr[0]->othertfienroldate;
	}
	
	//TFI Requests
	$tfi_req_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$tfi_req_arr = $this->_model->getAllRecords($tfi_req_cond,"malupdatetfi");
	
	//Metric Update
	$metrics_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$metrics_arr = $this->_model->getAllRecords($metrics_cond,"malmetricsupdate");
	
	//Beneficiary Exit Status
	$exitStatus="Active";//Others: Exit Requested, Exited
	$exitParams=array();;
	$exit_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$exit_arr = $this->_model->getAllRecords($exit_cond,"malcaseexit");
	if(!empty($exit_arr)){
		if($exit_arr[0]->exitStatus==='0'){
			$exitStatus='Exit Requested';
		}elseif($exit_arr[0]->exitStatus==='1'){
			$exitStatus='Exited';
		}
		$exitParams=$exit_arr[0];
	}
	
	
	$data=array();
	
	$data['case']=$mal_arr[0];
	$data['enrolDateOther']=$enrolDate;
	$data['tfiReq']=$tfi_req_arr;
	$data['metricsUpdate']=$metrics_arr;
	$data['exitParamaters']=$exitParams;
	$data['exitStatus']=$exitStatus;
	$data['test']="";
	
	return $data;
}
public function tfienrol($render=1,$path='',$tags=array("All")){
	//Get records posted
	$malID=$this->choice[3];
	$rec_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$rec_arr = $this->_model->getAllRecords($rec_cond,"othertfienrol");
			
	$data=array();
	$data['childNo']=$this->choice[1];
	$data['malID']=$this->choice[3];
	$data['rec']=$rec_arr;
	return $data;
}
public function newothertfienrol(){
	//Find if Duplicate
	$malID=$_POST['malID'];
	$dup_cond=$this->_model->where(array(array("where","malID",$malID,"=")));
	$dup_arr = $this->_model->getAllRecords($dup_cond,"othertfienrol");
	if(count($dup_arr)>0){
		echo "The beneficiary is already registered to be enrolled to a supplementary feeding program on ".$dup_arr[0]->othertfienroldate;
	}else{
		echo $this->_model->insertRecord($_POST,"othertfienrol");
	}
}
public function exitMalCase($render=1,$path='',$tags=array("All")){
	$malID = $this->choice[3];
	//Exit Reasons
	$reason_arr = $this->_model->getAllRecords("","exitreasons");
	
	//Get exit requests
	$exitParams=array();
	$exit_req_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	$exit_req_arr = $this->_model->getAllRecords($exit_req_cond,"malcaseexit");
	if(!empty($exit_req_arr)){
		$exitParams=$exit_req_arr[0];
	}
		
	$data=array();
	$data['childNo']=$this->choice[1];
	$data['malID']=$this->choice[3];
	$data['reasons']=$reason_arr;
	$data['exitParams'] =$exitParams;
	return $data;
}
public function exitRequest(){
	//print_r($_POST);
	echo $this->_model->insertRecord($_POST,"malcaseexit");
}
public function declineRequest(){
	//print_r($_POST);
	$malID=$_POST['malID'];
	$del_cond = $this->_model->where(array(array("where","malID",$malID,"=")));
	echo $this->_model->deleteQuery($del_cond,"malcaseexit");
}
}