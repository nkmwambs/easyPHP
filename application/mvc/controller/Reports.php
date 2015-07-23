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
			$fy =  Resources::func(get_financial_year,array(date("Y-m-d")));	
			$qtr = Resources::func(financial_quarter,array(date("Y-m-d")));
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
    
        
    public function hvcIndexing($render=1,$path="",$tags=array("All")){
        $data = "Annual HVC Indexing Form!";
		return $data;
    }
	public function newQuery(){
		//print_r($_POST);
		$data['qryName']=$_POST['qryName'];
		$data['qryDetail']=$_POST['query'];
		print($this->_model->insertRecord($data,"queries"));
	}
}