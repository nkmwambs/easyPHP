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
		$data=array();
		$data['rec'] = $this->_model->getAllRecords("","queries");
		return $data;
    }
	public function extraReports($render=1,$path='',$tags=array("All")){
		
		//List all Reports
		$relate = $this->_model->getAllRecords("","relationships","",array("rID","qryTitle"));
		
		$data =array();
		$data['relate'] = $relate;
		
		return $data;
		
	}
	public function addcondition(){
		
		$rid = $_POST['qryTitle'];
		$arr=array();
		$fld_arr=array();
		$alias_arr=array();
		
		$conds = $this->_model->where(array(array("WHERE","rID",$rid,"=")));
		$rst = $this->_model->getAllRecords($conds,"relationships","",array("tables","fields","field_alias","joins"));
		
		$flds = $rst[0]->fields;
		$alias = $rst[0]->field_alias;
		$joins = $rst[0]->joins;
		
		if($flds!=="*"&&!empty($alias)){
			//Convert field string to array
			$fld_arr = explode(",", $flds);
			
			//Convert field_alias string to array
			$alias_arr = explode(",", $alias);
			
			//Construct array to be rendered to view
			for ($x=0; $x < count($fld_arr); $x++) { 
				$arr[$fld_arr[$x]]=$alias_arr[$x];
			}
			
		}else{
			$arr = $this->_model->getTableColumns($rst[0]->tables);			
		}
		
		
		print_r(json_encode($arr));
	}
		public function getQueryResults($render=2,$path='queryView',$tags=array("All")){
		//print_r($_POST);
		$str = $_POST;
		$data =array();
		if(isset($str['qryTitle'])){
			//Initialize variables
			$f_arr="";
			$a_arr="";
			$flds = "";
			$conds = "";
			$final_cond = 1;
			$tbl = "";
			$fld_arr="";
			$op_arr="";
			$val_arr="";
			$extra = "";
			$startfrom = 0;
			$offset = 50;
			$tbl_cond = $this->_model->where(array(array("where","rID",$str['qryTitle'],"=")));
			
			//Get Relationship Table Results
			$tbl_rst = $this->_model->getAllRecords($tbl_cond,"relationships","",array("tables","fields","field_alias","joins","conditions","extra_conditions","hide_column"));
			
			//Set Results to variables
			
			$tbl = $tbl_rst[0]->tables;
			$tbl_flds = $tbl_rst[0]->fields;
			$tbl_joins = $tbl_rst[0]->joins;
			$tbl_cd = $tbl_rst[0]->conditions;
			$tbl_alias = $tbl_rst[0]->field_alias;
			$tbl_extra = $tbl_rst[0]->extra_conditions;
			$tbl_col_hide = $tbl_rst[0]->hide_column;
			
			if(!empty($tbl_cd)){
				$conds .=" ".$tbl_cd." AND ";
			}
			
			if($tbl_extra!=="all"){
				$extra = $tbl_extra;
			}
			
			//Set Fields from default all fields asterik
			if($tbl_flds!=='*'){
				//Convert field string to array
				$f_arr = explode(",", $tbl_flds);
				
				//Convert field_alias string to array
				$a_arr = explode(",", $tbl_alias);
				
				//Convert hidden columns to array
				$h_arr = explode(",", $tbl_col_hide);
				
				for ($k=0; $k <count($f_arr) ; $k++) {
					if(!in_array($f_arr[$k], $h_arr)){
						$flds.= $f_arr[$k]." As '".$a_arr[$k]."',"; 	
					} 
				}
				
				$flds = substr($flds,0,-1);
			}else{
				$flds="*";
			}
			
			//Set condition for the query
			if(sizeof($str)>1&&isset($str['fld'])){
				$fld_arr = $str['fld'];
				$op_arr = $str['op'];
				$val_arr = $str['val'];	
				
				for ($i=0; $i < sizeof($fld_arr); $i++) {
					if($op_arr[$i]==='LIKE %%'){
						$conds .= " ".$fld_arr[$i]." LIKE '%".$val_arr[$i]."%' AND ";
					}elseif($op_arr[$i]==='BETWEEN'){
						$conds .= " ".$fld_arr[$i]." ".$op_arr[$i]." ".$val_arr[$i]." AND ";
					}elseif($op_arr[$i]==='IN' ||$op_arr[$i]==='NOT IN'){
						$conds .= " ".$fld_arr[$i]." ".$op_arr[$i]." (".$val_arr[$i].") AND ";
					}else{
						$conds .= " ".$fld_arr[$i]." ".$op_arr[$i]." '".$val_arr[$i]."' AND ";
					} 
					
				}
			
				$final_cond = substr($conds, 0, -4);	
			}
				
			//Construct the sql - Limited Query to 50 items
				$sql = "SELECT ".$flds." FROM ".$tbl." ".$tbl_joins." WHERE ".$final_cond." ".$extra." LIMIT ".$startfrom.",".$offset;
			//Total records query
				$sql_total = "SELECT count(*) as num_records FROM ".$tbl." ".$tbl_joins." WHERE ".$final_cond." ".$extra;
				
			//Send query to model	
				$okQry = substr_count($sql,"SELECT",0);
				$okQryTwo = substr_count($sql,"SHOW",0);
				$finSql = str_replace("'", "\"", $sql);
				$finSql_total = str_replace("'", "\"", $sql_total);
				if($okQry>0||$okQryTwo){
					$data['rst'] =  $this->_model->queryTables($sql);
					$totals = $this->_model->queryTables($sql_total);
					$data['rst_total'] =  $totals[0]->num_records;
					$data['sql']=$finSql;
				}else{
					$data['rst'] = "Query denied. Contact the administrator!";
				}

		}else{
			$data['rst'] = "<b>No Query selected!</b>";
		}	
		return $data;
	}
	public function runquery(){

	}
	public function queryView($render=2,$path='',$tags=array("All")){
		$data=array();
		$sql = $_POST['query'];
		$okQry = substr_count($sql,"SELECT",0);
		$okQryTwo = substr_count($sql,"SHOW",0);
		$finSql = str_replace("'", "\"", $sql);
		if($okQry>0||$okQryTwo){
			$data['rst'] =  $this->_model->queryTables($sql);
			$data['sql']=$finSql;
		}else{
			$data['rst'] = "Query denied. Contact the administrator!";
		}
		
		return $data;
		
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

    }
   
    public function hvcQtrly($render=1,$path="",$tags=array("All")){
        $data = "HVC Report!";
		return $data;
    }
    public function pdsreportview(){
    	$data=array();
		$cdate=date("Y-m-01");
		
		if(isset($_POST['cdate'])){
				$cdate=date('Y-m-d',$_POST['cdate']);
		}
		
		if(Resources::session()->userlevel==='1'){
			$path='';
		}elseif(Resources::session()->userlevel==='2'){
			$data = $this->pdsreportviewpf();
			$path="pdsreportviewpf";
		}elseif(Resources::session()->userlevel==='12'){	
			$data = $this->pdsreportviewers($cdate);
			$path="pdsreportviewers";
		}
		
		$this->dispatch($render=1,$path, $data,$tags=array("All"));
    }
public function pdsreportviewpf(){
    		$data=array();
			$rec_arr=array();	
			$cst = Resources::session()->cname;
			
    		//Get Selected Month PDs Reports
    		$get_rpts_cond = $this->_model->where(array(array("where","cstName",$cst,"=")));
			$get_rpts_arr = $this->_model->getAllRecords($get_rpts_cond,"pdsreport","",array("icpNo","rptMonth","status"));
			
			$rawArr = array();
			foreach ($get_rpts_arr as $value) {
				$rawArr['month']=$value->rptMonth;
				$rawArr['status']=$value->status;
				$rec_arr[$value->icpNo][]=$rawArr;
			}
			
			$data['test']=$get_rpts_arr;
			$data['rec']=$rec_arr;
			
			return $data;
}
public function pdsreportviewers($cdate=""){
	    	$data=array();
			$rec_arr=array();
			$curdate=date('Y-m-01');
			if($cdate!==""){
				$curdate=$cdate;
			}
			
			//Get Selected Month PDs Reports
    		$get_rpts_cond = $this->_model->where(array(array("where","rptMonth",$curdate,"=")));
			$get_rpts_arr = $this->_model->getAllRecords($get_rpts_cond,"pdsreport","",array("cstName","icpNo","rptMonth","status"));
			
			foreach ($get_rpts_arr as $value) {
				$rw = (array)$value;
				$arr = array_shift($rw);
				$rec_arr[$value->cstName][]=$rw;
			}
			
			$data['test']=$get_rpts_arr;
			$data['rec']=$rec_arr;
			$data['rptMonth']=$curdate;
			
			return $data;
}
	public function createpdsreport(){
		$dt = date("Y-m-d",$this->choice[1]);
		$prev_dt = date("Y-m-d",strtotime('-1 month',$this->choice[1]));
		$icp = Resources::session()->fname;
		$cstName=Resources::session()->cname;
		
		//Check if report exists for the current month
		$chk_cur_month_rpt_cond = $this->_model->where(array(array("where","rptMonth",$dt,"="),array("AND","icpNo",$icp,"=")));
		$chk_cur_month_rpt_arr = $this->_model->getAllRecords($chk_cur_month_rpt_cond,"pdsreport");
		$cur_report_present=0;
		if(count($chk_cur_month_rpt_arr)>0){
			$cur_report_present=1;
		}
		
		//Check if the is previous unsubmitted Report
		$chk_prev_submitted_month_rpt_cond = $this->_model->where(array(array("where","rptMonth",$prev_dt,"="),array("AND","status",'0',"="),array("AND","icpNo",$icp,"=")));
		$chk_prev_submitted_month_rpt_arr = $this->_model->getAllRecords($chk_prev_submitted_month_rpt_cond,"pdsreport");
		$prev_unsubmitted=0;
		if(count($chk_prev_submitted_month_rpt_arr)>0){
			$prev_unsubmitted=1;
		}
		
		if($cur_report_present===0&&$prev_unsubmitted===0){		
			$newRec=array();
			$newRec['icpNo']=$icp;
			$newRec['cstName']=$cstName;
			$newRec['rptMonth']=$dt;
			
			echo $this->_model->insertRecord($newRec,"pdsreport");
		}elseif($cur_report_present===1){
			echo "Cannot create a duplicate report for the current month!";
		}elseif($prev_unsubmitted===1){
			echo "You cannot create a new report. You have a previous month unsubmitted report";
		}	
		
		
	}
	public function viewPdsReports($render=2,$path="",$tags=array("All")){
		$icp=Resources::session()->fname;
		
		if(isset($_POST['icp'])){
			$icp=$_POST['icp'];
		}
		
		$rpt_cond = $this->_model->where(array(array("WHERE","icpNo",$icp,"=")));
		$rpt_arr = $this->_model->getAllRecords($rpt_cond,"pdsreport","",array("rptMonth","status"));
		$rpt="";
		if(!empty($rpt_arr)){
			$rpt=$rpt_arr;
		}
		
		$data=array();
		
		$data['rec']=$rpt;
		$data['icp']=$icp;
		
		return $data;
	}
    public function pds($render=1,$path="",$tags=array("All")){
        $data=array();
		$month=date('Y-m-d',$this->choice[1]);
		//Get ICP identifier
		$icp=Resources::session()->fname;
		if(isset($this->choice[3])){
			$icp=$this->choice[3];
		}
		$cst=$data['cst']=Resources::session()->cname;
		
		//Get Attendance
		$flds = range(1, 31);
		$att_cond = $this->_model->where(array(array("where","rptMonth",$month,"="),array("AND","icpNo",$icp,"=")));
		$att_arr = $this->_model->getAllRecords($att_cond,"pdsreport","",array("fday1","fday2","fday3","fday4","fday5","fday6","fday7","fday8","fday9","fday10","fday11","fday12","fday13","fday14","fday15","fday16","fday17","fday18","fday19","fday20","fday21","fday22","fday23","fday24","fday25","fday26","fday27","fday28","fday29","fday30","fday31","day1","day2","day3","day4","day5","day6","day7","day8","day9","day10","day11","day12","day13","day14","day15","day16","day17","day18","day19","day20","day21","day22","day23","day24","day25","day26","day27","day28","day29","day30","day31"));
		$att="";
		if(!empty($att_arr)){
			$att = (array)$att_arr[0];;
		}
		
		//Get Non Attendance Fields
		$non_att_arr = $this->_model->getAllRecords($att_cond,"pdsreport");
		$non_att="";
		if(!empty($non_att_arr)){
			$non_att=(array)$non_att_arr[0];
		}
		
		
		$data['month']=date('m',$this->choice[1]);
		$data['year']=date('y',$this->choice[1]);
		$data['icp']=$icp;
		$data['cst']=$cst;
		$data['attendance']=$att;
		$data['nonattflds']=$non_att;
		return $data;
    }
public function validatepdsreport(){
	$rid = $_POST['rptID'];
	$state = $_POST['status'];
	$rsn = $_POST['declineReason'];
	
	//echo $state;
	$recUpdateSet=array();
	$recUpdateSet=array("status"=>$state,"declineReason"=>$rsn);
	
	$recUpdateCond = $this->_model->where(array(array("where","rptID",$rid,"=")));
	$this->_model->updateQuery($recUpdateSet,$recUpdateCond,"pdsreport");
	
	if($state==='2'){
		echo "Report declined successfully";	
	}elseif($state==='3'){
		echo "Report validation successfully";
	}
	
}
public function savePdsReport(){
	//print_r($_POST);
	$icp = $_POST['icpNo'];
	$month = date('Y-m-d',strtotime($_POST['rptMonth']));
	
	//Updating
	$rng = range(1, 31);
	$update_set_sec=array();
	foreach ($rng as $value) {
		if(isset($_POST['day'.$value])){
			$update_set_sec['day'.$value]=$_POST['day'.$value];
		}
		if(isset($_POST['fday'.$value])){
			$update_set_sec_two['fday'.$value]=$_POST['fday'.$value];
		}
	}
	
	$other_sets = array(
		"communityActivitiesParticipation"=>"".$_POST['communityActivitiesParticipation']."",
		"firstTimeSaved"=>"".$_POST['firstTimeSaved']."",
		"practiseSpiritualDiscipline"=>"".$_POST['practiseSpiritualDiscipline']."",
		"receivedFirstBibles"=>"".$_POST['receivedFirstBibles']."",
		"shareVerses"=>"".$_POST['shareVerses']."",
		"childrenCounselled"=>"".$_POST['childrenCounselled']."",
		"plantedTrees"=>"".$_POST['plantedTrees']."",
		"participateinoutrreach"=>"".$_POST['participateinoutrreach']."",
		"baselinecdpr"=>"".$_POST['baselinecdpr']."",
		"finalcdpr"=>"".$_POST['finalcdpr']."",
		"cdspbencompleted"=>"".$_POST['cdspbencompleted']."",
		"cdspexitbeforecomplete"=>"".$_POST['cdspexitbeforecomplete']."",
		"collegestudents"=>"".$_POST['collegestudents']."",
		"completenondegreeeducation"=>"".$_POST['completenondegreeeducation']."",
		"completedegreeeducation"=>"".$_POST['completedegreeeducation']."",
		"completedvocational"=>"".$_POST['completedvocational']."",
		"utilizediga"=>"".$_POST['utilizediga']."",
		"attainmpftgoals"=>"".$_POST['attainmpftgoals']."",
		"updatedmpft"=>"".$_POST['updatedmpft']."",
		"beneficiariesincompassionsunday"=>"".$_POST['beneficiariesincompassionsunday']."",
		"celebratedbirthday"=>"".$_POST['celebratedbirthday']."",
		"boardingchildren"=>"boardingchildren",
		"volunteerchildprotection"=>"volunteerchildprotection",
		"caregiverchildprotection"=>"caregiverchildprotection",
		"beneficiarychildprotection"=>"beneficiarychildprotection",
		"caregiverearning"=>"caregiverearning"	
	
	);
	if(isset($_POST['submitting'])){
		$other_sets['status']=1;
	}
	$update_set=array_merge($update_set_sec_two,$update_set_sec,$other_sets);
	$update_cond = $this->_model->where(array(array("where","icpNo",$icp,"="),array("AND","rptMonth",$month,"=")));
	
	//Check if Report is already submitted before Updating
	$flag='0';
	$chk_submit_cond = $this->_model->where(array(array("where","icpNo",$icp,"="),array("AND","rptMonth",$month,"="),array("AND","status",1,"=")));
	$chk_submit_arr = $this->_model->getAllRecords($chk_submit_cond,"pdsreport");
	if(empty($chk_submit_arr)){
		$this->_model->updateQuery($update_set,$update_cond,"pdsreport");
		$flag='1';
	}
	
	if(isset($_POST['submitting'])&&$flag==='1'){
		echo "Report Submitted successfully";
	}elseif(isset($_POST['submitting'])&&$flag==='0'){
		echo "Report could not be submitted. There is already a report submitted for this period";
	}else{
		echo "Report Saved Successfully";
	}
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
		}elseif(Resources::session()->userlevel==='2'){
			$data = $this->manageHvcPf();
			$path="manageHvcPf";
		}else{
			$data = $this->manageHvcSpecialist();
			$path="manageHvcSpecialist";
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
public function manageHvcSpecialist($render=1,$path="",$tags=array("All")){
		//SELECT cst,pNo,count(pNo) as noOfCases FROM `indexing` GROUP BY cst,pNo
		$hvc_cond = $this->_model->where(array(array("where","active",'1',"=")));
		$hvc_arr = $this->_model->getAllRecords($hvc_cond,"indexing"," GROUP BY cst,pNo",array("cst","pNo","count(pNo):noOfCases"));
		
		$grp_arr=array();
		foreach ($hvc_arr as $value) {
			$arr = (array)$value;
			array_shift($arr);
			$grp_arr[$value->cst][$arr['pNo']]=array($arr['pNo'],$arr['noOfCases']);;
		}
		
		$data=array();
		
		$data['rec']=$grp_arr;
		$data['test']="";
		
		return $data;
}
public function manageHvcPf($render=1,$path="",$tags=array("All")){
	$cst=Resources::session()->cname;	
	if(isset($_POST['cst'])){
		$cst=$_POST['cst'];
	}
	
	$hvc_cond = $this->_model->where(array(array("where","active",'1',"="),array("AND","cst",$cst,"=")));
	$hvc_arr = $this->_model->getAllRecords($hvc_cond,"indexing"," GROUP BY pNo",array("pNo","count(pNo):noOfCases"));
	
	$data=array();
	
	$data['test']="";
	$data['rec']=$hvc_arr;
	$data['cst']=$cst;
	return $data;
}
public function manageHvcIcp($render=1,$path="",$tags=array("All")){
	$icp=Resources::session()->fname;
	$state=1;
	if(isset($_POST['icp'])){
		$icp=$_POST['icp'];
	}
	if(isset($_POST['state'])){
		$state=$_POST['state'];
	}
	
	$hvc_cond = $this->_model->where(array(array("where","active",$state,"="),array("AND","pNo",$icp,"=")));
	$hvc_arr = $this->_model->getAllRecords($hvc_cond,"indexing");
	
	$data=array();
	
	$data['test']="";
	$data['icpNo']=$icp;
	$data['rec']=$hvc_arr;
	return $data;
	
}
public function inactivateCase(){
		$cid = $_POST['cid'];
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
public function nonicpmalnutrition($render=1,$path='updateMalCase',$tags=array("All")){
	
	if(Resources::session()->userlevel==='2'){
		$mal_cond = $this->_model->where(array(array("where","cst",Resources::session()->cname,"=")));
	}else{
		$mal_cond = "";//$this->_model->where(array(array("where","icpNo",$icpNo,"=")));
	}
	
	$mal_arr = $this->_model->getAllRecords($mal_cond,"malnutrition","",array("malID","childNo","childName","childDOB","sex","diagDate","diagWeight","diagHeight"));
	
	$data=array();
	$data['mal']=$mal_arr;
	return $data;
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
public function pfcdprview($render=1,$path='',$tags=array("All")){
	//$path="c";
		$cst = $_POST['cst'];
		$cdpr_arr = array();
				
		//Complete CDPR
		$comp_cdpr_pf_cond = $this->_model->where(array(array("WHERE","users.cname",$cst,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",1,"=")));
		$comp_cdpr_pf_arr = $this->_model->getAllRecords($comp_cdpr_pf_cond,"cdpr","GROUP BY cdpr.pNo",array("cdpr.pNo:pNo","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		if(count($comp_cdpr_pf_arr)>0){
			foreach ($comp_cdpr_pf_arr as $value) {
				$cdpr_arr[$value->pNo]['comp_cnt']=$value->cnt;
			}
		}
		
		//Incomplete CDPR
		$incomp_cdpr_pf_cond = $this->_model->where(array(array("WHERE","users.cname",$cst,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",0,"=")));
		$incomp_cdpr_pf_arr = $this->_model->getAllRecords($incomp_cdpr_pf_cond,"cdpr","GROUP BY cdpr.pNo",array("cdpr.pNo:pNo","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		if(count($incomp_cdpr_pf_arr)>0){
			foreach ($incomp_cdpr_pf_arr as $value) {
				$cdpr_arr[$value->pNo]['incomp_cnt']=$value->cnt;	
			}
		}
		
		//Count of Beneficiaries
		$ben_count_arr="";
		$ben_count_cond="";
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				$ben_count_cond = $this->_model->where(array(array("WHERE","pNo",$key,"=")));
				$ben_count_arr = $this->_model->getAllRecords($ben_count_cond,"childdetails","GROUP BY pNo",array("count(pNo):NoOfBen"));	
				$cdpr_arr[$key]['NoOfBen']=$ben_count_arr[0]->NoOfBen;
			}
		}
		
		//Set default number of Completed Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['comp_cnt'])){
				$cdpr_arr[$key]['comp_cnt']=0;
			}
		}
		
		//Set default number of Incompleted Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['incomp_cnt'])){
				$cdpr_arr[$key]['incomp_cnt']=0;
			}
		}
		
		//% Completed Assessments
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				if(!empty($cdpr_arr[$key]['comp_cnt'])||$cdpr_arr[$key]['comp_cnt']===0){
					$cdpr_arr[$key]['percent']	= ($cdpr_arr[$key]['comp_cnt']/$cdpr_arr[$key]['NoOfBen'])*100;
				}
			}
		}
		
		
		$data=array();
		
		$data['rec'] =$cdpr_arr;
		$data['test']=$ben_count_arr;
		$data['cst']=Resources::session()->cname;
		
		return $data;
}
public function cdpr(){
	$render=1;
	$tags=array("All");
	$cdpr_pf_cond="";
	$cdpr_pf_arr="";
	$data=array();
	if(Resources::session()->userlevel==='1'){
		$path="";
	}elseif(Resources::session()->userlevel==='2'){
		$path="pfcdprview";
		$cdpr_arr = array();
				
		//Complete CDPR
		$comp_cdpr_pf_cond = $this->_model->where(array(array("WHERE","users.cname",Resources::session()->cname,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",1,"=")));
		$comp_cdpr_pf_arr = $this->_model->getAllRecords($comp_cdpr_pf_cond,"cdpr","GROUP BY cdpr.pNo",array("cdpr.pNo:pNo","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		if(count($comp_cdpr_pf_arr)>0){
			foreach ($comp_cdpr_pf_arr as $value) {
				$cdpr_arr[$value->pNo]['comp_cnt']=$value->cnt;
			}
		}
		
		//Incomplete CDPR
		$incomp_cdpr_pf_cond = $this->_model->where(array(array("WHERE","users.cname",Resources::session()->cname,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",0,"=")));
		$incomp_cdpr_pf_arr = $this->_model->getAllRecords($incomp_cdpr_pf_cond,"cdpr","GROUP BY cdpr.pNo",array("cdpr.pNo:pNo","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		if(count($incomp_cdpr_pf_arr)>0){
			foreach ($incomp_cdpr_pf_arr as $value) {
				$cdpr_arr[$value->pNo]['incomp_cnt']=$value->cnt;	
			}
		}
		
		//Count of Beneficiaries
		$ben_count_arr="";
		$ben_count_cond="";
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				$ben_count_cond = $this->_model->where(array(array("WHERE","pNo",$key,"=")));
				$ben_count_arr = $this->_model->getAllRecords($ben_count_cond,"childdetails","GROUP BY pNo",array("count(pNo):NoOfBen"));	
				$cdpr_arr[$key]['NoOfBen']=$ben_count_arr[0]->NoOfBen;
			}
		}
		
		//Set default number of Completed Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['comp_cnt'])){
				$cdpr_arr[$key]['comp_cnt']=0;
			}
		}
		
		//Set default number of Incompleted Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['incomp_cnt'])){
				$cdpr_arr[$key]['incomp_cnt']=0;
			}
		}
		
		//% Completed Assessments
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				if(!empty($cdpr_arr[$key]['comp_cnt'])||$cdpr_arr[$key]['comp_cnt']===0){
					$cdpr_arr[$key]['percent']	= ($cdpr_arr[$key]['comp_cnt']/$cdpr_arr[$key]['NoOfBen'])*100;
				}
			}
		}
		
		
		
		
		$data['rec'] =$cdpr_arr;
		$data['test']=$ben_count_arr;
		$data['cst']=Resources::session()->cname;
	}else{
		$path="allicpcdprview";
		$cdpr_arr = array();
				
		//Complete CDPR
		$comp_cdpr_all_cond = $this->_model->where(array(array("WHERE","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",1,"=")));
		$comp_cdpr_all_arr = $this->_model->getAllRecords($comp_cdpr_all_cond,"cdpr","GROUP BY users.cname",array("users.cname:cst","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		foreach ($comp_cdpr_all_arr as $value) {
			$cdpr_arr[$value->cst]['comp']=$value->cnt;
		}

				
		//Incomplete CDPR
		$incomp_cdpr_all_cond = $this->_model->where(array(array("WHERE","users.userlevel",1,"="),array("AND","users.department",0,"="),array("AND","cdpr.status",0,"=")));
		$incomp_cdpr_all_arr = $this->_model->getAllRecords($incomp_cdpr_all_cond,"cdpr","GROUP BY users.cname",array("users.cname:cst","count(cdpr.pNo):cnt"),array("LEFT JOIN"=>array("cdpr"=>"pNo","users"=>"fname")));
		
		foreach ($incomp_cdpr_all_arr as $value) {
			$cdpr_arr[$value->cst]['incomp']=$value->cnt;
		}
		
		//Count of Beneficiaries
		$ben_count_arr="";
		$ben_count_cond="";
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				$ben_count_cond = $this->_model->where(array(array("WHERE","cstName",$key,"=")));
				$ben_count_arr = $this->_model->getAllRecords($ben_count_cond,"childdetails","GROUP BY cstName",array("count(cstName):NoOfBen"));	
				$cdpr_arr[$key]['NoOfBen']=$ben_count_arr[0]->NoOfBen;
			}
		}	
			
		//Set default number of Completed Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['comp'])){
				$cdpr_arr[$key]['comp']=0;
			}
		}
		
		//Set default number of Incompleted Assessment to Zero if non Exists
		foreach ($cdpr_arr as $key => $value) {
			if(!isset($cdpr_arr[$key]['incomp'])){
				$cdpr_arr[$key]['incomp']=0;
			}
		}
		
		//% Completed Assessments
		if(count($cdpr_arr)>0){
			foreach ($cdpr_arr as $key => $value) {
				if(!empty($cdpr_arr[$key]['comp'])||$cdpr_arr[$key]['comp']===0){
					$cdpr_arr[$key]['percent']	= ($cdpr_arr[$key]['comp']/$cdpr_arr[$key]['NoOfBen'])*100;
				}
			}
		}
		
		$data['rec'] =$cdpr_arr;
	}
	$this->dispatch($render,$path, $data,$tags);
}
public function savecdpr(){
	//Update Record	
	$childNo = $_POST['childNo'];
	$agegroup = $_POST['cognitiveagegroup'];
	$ass_cond = $this->_model->where(array(array("WHERE","childNo",$childNo,"="),array("AND","cognitiveagegroup",$agegroup,"=")));
	
	$this->_model->updateQuery($_POST,$ass_cond,"cdpr");
	
	echo "Record Saved Successfully";
	
}
public function submitcdpr(){
	//Update Record	
	$childNo = $_POST['childNo'];
	$agegroup = $_POST['cognitiveagegroup'];
	$ass_cond = $this->_model->where(array(array("WHERE","childNo",$childNo,"="),array("AND","cognitiveagegroup",$agegroup,"=")));
	
	$_POST['status']='1';
	
	$this->_model->updateQuery($_POST,$ass_cond,"cdpr");
	
	echo "Record Submitted Successfully";
}
public function viewcdprgrid($render=1,$path='',$tags=array("All")){
	$data=array();
	//Extract Assessed Beneficiaries
	$pNo = Resources::session()->fname;
	if(isset($this->choice[1])){
		$pNo=$this->choice[1];
	}
	
	$assessed_ben_cond = $this->_model->where(array(array("WHERE","pNo",$pNo,"=")));
	$assessed_ben_arr = $this->_model->getAllRecords($assessed_ben_cond,"cdpr","",array("childNo","cognitiveagegroup","status"));
	
	$refined_rec = array();
	foreach ($assessed_ben_arr as $value) {
		$refined_rec[$value->childNo][$value->cognitiveagegroup]=$value->status;
	}
	
	$data['rec'] = $refined_rec;
	return $data;
}
public function getChildDetailsforCDPR($render=1,$path='',$tags=array("All")){
	//Check if Child Exists in the the Database
	$data=array();
	$childNo = $_POST['childNo'];
	$agegroup = $_POST['cognitiveagegroup'];
	$cdpr_cond = $this->_model->where(array(array("WHERE","childNo",$childNo,"=")));
	$cdpr_arr = $this->_model->getAllRecords($cdpr_cond,"childdetails");
	if(count($cdpr_arr)!==0){
		//Check if Record exists: If Yes, Update Else Insert New Reord
		$ass_cond = $this->_model->where(array(array("WHERE","childNo",$childNo,"="),array("AND","cognitiveagegroup",$agegroup,"=")));
		$ass_arr = $this->_model->getAllRecords($ass_cond,"cdpr","",array("childNo","cognitiveagegroup","status"));
		$new_rec = array();
		if(count($ass_arr)===0){
			//Insert a  Record
			$new_rec['pNo']=Resources::session()->fname;
			//$pNo = Resources::session()->fname;//$_POST['pNo'];
			$new_rec['childNo']=$childNo;
			$new_rec['childName']=$cdpr_arr[0]->childName;
			$new_rec['dob']=$cdpr_arr[0]->dob;
			$new_rec['cognitiveagegroup']=$agegroup;
			
			$this->_model->insertRecord($new_rec,"cdpr");
		}
		
		$cur_ass_arr = $this->_model->getAllRecords($ass_cond,"cdpr");	
		$data['rec']=$cur_ass_arr;
		
	}else{
		$data['rec']="";
	}	
	
	
	//$data['icp']=Resources::session()->fname;
	$data['icp']=Resources::session()->fname;
	$data['cognitiveagegroup']=$agegroup;
	$data['ben']=$childNo;
	
	return $data;
}


}