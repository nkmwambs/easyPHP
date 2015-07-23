<?php
class Finance_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Finance_Model("voucher_header");  
        //$this->helper->get_func(array("get_financial_year","test","get_month_number_array"));
    }
    public function switchboard($render=1,$path='',$tags=array("2","3","9")){
        return $cluster = $this->_model->getClusters();
    }
	public function view($render=1,$path="",$tags=array("All")){
		
	}

    public function viewAll($render=1){
            //$this->dispatch();
    }    
    public function accounts(){
        $voucherType_code = $this->choice[1];
        if($voucherType_code==="PC"||$voucherType_code==="CHQ"){
            $AccGrp = 0;
        }elseif($voucherType_code==="CR"){
            $AccGrp = 1;
        }
        $cond = $this->_model->where(array(array("where","accounts.AccGrp",$AccGrp,"=")));
        //$rst = $this->_model->getAllRecords($cond,"accounts","ORDER BY AccNo ASC, prg DESC");
        $rst_rw=$this->_model->civaAccountsMerge($cond,$this->choice[1]);
        $rst=array();
        foreach($rst_rw as $civaAcc):
            if(is_numeric($civaAcc->civaID)&&substr_count($civaAcc->allocate,$_SESSION['fname'])>0){
                $rst[]=$civaAcc;
            }elseif(!is_numeric($civaAcc->civaID)){
                $rst[]=$civaAcc;
            }
        endforeach;
        
        print_r(json_encode($rst));
    }

    public function voucher($render=1,$tags=array("1")){
            try{
                if(isset($_SESSION['username'])){
                    $mth = date('m');
                    $icp = $_SESSION['username'];
                    return $data = $this->_model->getMonthByNumber($mth,$icp);
                    //$this->dispatch("",$data);
                }  else {
                    throw new customException("Session ID username is not set!");
                }
            }catch(customException $e){
                echo $e->errorMessage();
            } 
    }
    public function ecjOther($render=1,$path='',$tags=array("2","3")){
        if(isset($_POST['icpSelector'])){
                    $cond = $this->model->where(array(array("where","fname",trim(filter_input(INPUT_POST,"icpSelector")),"=")));
        }elseif(isset ($this->choice[1])) {
            $cond = $this->model->where(array(array("where","fname",  $this->choice[1],"=")));
        }
                    $results = $this->_model->getAllRecords($cond,"users");
                foreach($results[0] as $key=>$value):
                    $_SESSION[$key."_backup"]=$value;
                endforeach;
              $cds = $this->_model->where(array(array("where","icpNo",$_SESSION['username_backup'],"="),array("AND","Month(`TDate`)",date('m'),"=")));  
            
            $data[]=$this->_model->accounts();
            $data[] = $this->_model->getVoucherForEcj($cds);
            return $data;                
}   

    public function ecj(){

            if(isset($this->choice[1])){
            	$d=date('Y-m-t',strtotime("-1 month",$this->choice[1]));
            	$v_month =date('m',$this->choice[1]);
			}else{
				$d=date('Y-m-t',strtotime("-1 month"));
				$v_month=date('m');
			}		
					
					$bc_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","month",$d,"="),array("AND","accNo","BC","=")));
    				$pc_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","month",$d,"="),array("AND","accNo","PC","=")));
		
					$bc_arr = $this->_model->getAllRecords($bc_cond,"cashbal");
					$pc_arr = $this->_model->getAllRecords($pc_cond,"cashbal");		
		
					//print($bc_arr[0]->amount);
    				if(count($bc_arr)&&count($pc_arr)){
    					$bc = $bc_arr[0]->amount;
				  		$pc= $pc_arr[0]->amount;
    				}else{
    					$bc =0;
				  		$pc= 0;
    				}
		          		
            	
				
                	$cds = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","Month(`TDate`)",$v_month,"=")));
            	    $data[]=$this->_model->accounts();
		            $data[] = $this->_model->getVoucherForEcj($cds);
					$data[]=$bc;//BC Balance
					$data[]=$pc;//PC Balance
					
					if(isset($this->choice[1])){
						$data[]=$this->choice[1];
						$render=2;
					}else{
						$render=1;
					}
		            
		            if(Resources::session()->userlevel==="1"){
		                $this->dispatch($render,"",$data,array("1"));
		            }elseif(Resources::session()->userlevel==="2"){
		                $selector_cond_pf = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
		                $selector_pf = $this->_model->getAllRecords($selector_cond_pf,"users");
		                $cluster = $selector_pf[0]->cname;
		                $selector_cond_icps = $this->_model->where(array(array("where","cname",addslashes($cluster),"="),array("AND","userlevel","1","=")));
		                $selector_icps = $this->_model->getAllRecords($selector_cond_icps,"users");
		                $this->dispatch($render,"icpSelector",$selector_icps,array("2"));
		        }
    }
    
    public function ppbf(){
            if($_SESSION['userlevel']==="1"){
                $this->dispatch($render=1,$path="");    
            }elseif($_SESSION['userlevel']==="2"){
                $cluster_cond = $this->_model->where(array(array("where","cname",$_SESSION['cname'],"="),array("AND","userlevel","2","<>")));
                $cluster_arr = $this->_model->getAllRecords($cluster_cond,"users");
                $this->dispatch($render=1,"icpSelectorForPpbf",$cluster_arr);
            }  else {
                
            } 
    }
    public function ppbfOther($render=1,$path='',$tags=array("2","3")){
        if(isset($this->choice[1])){
            $icp_cond = $this->_model->where(array(array("where","icpNo",  $this->choice[1],"=")));
        }else{
           $icp_cond = $this->_model->where(array(array("where","icpNo",$_POST['icpSelector'],"="))); 
        }
        
        return $icp_arr = $this->_model->getAllRecords($icp_cond,"planheader");
        
    }

        public function getPpbf($render=1){
        if($_SESSION['userlevel']==="1"){ 
            if($this->choice[1]==='1'||$this->choice[1]==='2'){
                $plan_cond = $this->_model->where(array(array("WHERE","planheader.icpNo",$_SESSION['username'],"="),array("AND","planheader.fy",$this->choice[3],"="),array("AND","planheader.planType",  $this->choice[1],"=")));
            }
            }elseif ($_SESSION['userlevel']==="2") {
                $plan_cond = $this->_model->where(array(array("AND","planheader.planHeaderID",$this->choice[1],"=")));
                
            }else{
                $plan_cond = $this->_model->where(array(array("AND","planheader.planHeaderID",$this->choice[1],"=")));
                
            }
            $plan =  $this->_model->getPpbfModel($plan_cond);
            try{
                if(!isset($plan)){
                     throw new customException("Missing Variable Plan!");
                 }else{
                    $acc_cond=$this->_model->where(array("where"=>array("AccGrp","0","="),"AND"=>array("AccNo","100","<")));
                    $acc = $this->_model->getAllRecords($acc_cond,"accounts"); 
                    
                    $data[]=$acc;
                    $data[]=$plan;    
                    return $data;
                 }
             } catch (customException $e) {
                    echo $e->errorMessage();
             }                     
    }

    public function newPlan($render=1){
            $acc_cond=$this->_model->where(array("where"=>array("AccGrp","0","="),"AND"=>array("AccNo","100","<")));
            return $acc = $this->_model->getAllRecords($acc_cond,"accounts");
            
    }
    
    public function searchPlan(){
                $chk_cond = $this->_model->where(array(array("where","planheader.icpNo",$_SESSION['username'],"="),array("AND","planheader.planType",$this->choice[1],"="),array("AND","planheader.fy",$this->choice[3],"=")));
                $chk =  $this->_model->getPpbfModel($chk_cond);
                if(empty($chk)){
                    echo 0;
                }else{
                    print(json_encode($chk));
                }
    }    
    
    public function postNewPlan(){
        $plan_arr = $_POST;
        //print_r($plan_arr);
        $header_arr_rw = array();
        foreach($plan_arr as $fld):
            $header_arr_rw[]=  array_shift($fld);
        endforeach;
        $header_keys = array_slice(array_keys($_POST),0,3);
        $header_arr_rw2 = array_slice($header_arr_rw,0,3);
        $header_arr = array_combine($header_keys, $header_arr_rw2);
        //print_r($header_arr);
        $planType = $header_arr['planType'];
        $fy = $header_arr['fy'];
        $icpNo = $header_arr['icpNo'];
        $chk_header_cond = $this->_model->where(array(array("where","planType",$planType,"="),array("AND","fy",$fy,"="),array("AND","icpNo",$icpNo,"=")));
        $chk_header_exists = $this->_model->getAllRecords($chk_header_cond,"planheader");
         
        $approved = $chk_header_exists[0]->approved;
        if($approved==="1"){
            echo "The plan your attempting to Update is locked! Please Contact your PF!";
        }else{
                $cur_planid = $chk_header_exists[0]->planHeaderID;

                if(count($chk_header_exists)>0){
                    $this->_model->deleteQuery($chk_header_cond,"planheader");
                }
                    //echo $this->_model->insertRecord($header_arr,"planheader");
                    $this->_model->insertRecord($header_arr,"planheader");

                $cur_plan = $this->_model->getAllRecords($chk_header_cond,"planheader");
                //print_r($cur_plan);
                $new_planid = $cur_plan[0]->planHeaderID; 

                $body_arr = array_slice($plan_arr,3);
                $header_id_arr['planHeaderID'] = array_fill(0,  sizeof($body_arr['AccNo']), $new_planid);
                $body_arr_fin = array_merge($header_id_arr,$body_arr);

               $chk_body_cond = $this->_model->where(array(array("where","planHeaderID",$cur_planid,"=")));
               $chk_body_records_exists = $this->_model->getAllRecords($chk_body_cond,"plansbody");
                if(count($chk_body_records_exists)>0){
                    $this->_model->deleteQuery($chk_body_cond,"plansbody");
                }
                echo $this->_model->insertArray($body_arr_fin,"plansbody");
        }
    }
    public function approvePlan(){
        //echo $this->choice[1];
        $approve_cond = $this->_model->where(array(array("where","planHeaderID",$this->choice[1],"=")));
        if($this->choice[3]==="0"){    
            $approve_set = array("approved"=>"0");
            $msg = "Plan approved Successfully!";
        }elseif($this->choice[3]==="1"){
            $approve_set = array("approved"=>"1");
            $msg = "Plan approved Successfully!";
        }
        $rst = $this->_model->updateQuery($approve_set,$approve_cond,"planheader");
        if($rst===1){
            echo $msg;
        }  else {
            echo 0;
        }
    }
    
    public function schedules(){
            $acc_cond=  $this->_model->where(array(array("where","AccGrp","0","="),array("AND","AccNo",100,"<")));
            $acc = $this->_model->getAllRecords($acc_cond,"accounts");

            //$fy = get_financial_year(date('Y-m-d'));
            $fy = Resources::func("get_financial_year",array(date('Y-m-d')));
            //$fy = get_financial_year(date('Y-m-d'));
            
            $data[]=$fy;
            $data[]=$acc;
            if($_SESSION['userlevel']==="1"){
                $this->dispatch($render=1,"",$data,$tags=array("1"));
            }else{
                $this->dispatch($render=1,"pfPlansSchedulesView",$data,$tags=array("2"));
            }

            }       
    public function pfSchedules($render=1,$path="",$tags=array("2")){           
        $fy = $this->choice[3];
        $icpNo = $this->choice[1];
        $schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$icpNo,"=")));
        $schedules = $this->_model->getScheduleWithAcNames($schedules_cond);
        //print_r($schedules);
        
        $acDetails=array();
        foreach ($schedules as $filter):
            $obj = new stdClass();
            $obj->AccNo=$filter->AccNo;
            $obj->AccText=$filter->AccText;
            $obj->AccName=$filter->AccName;
            $acDetails[$filter->AccText]=$obj;
        endforeach;
        
        $totals=$this->_model->getSchedulesSummaryWithAcNames($schedules_cond);
        //array_unique((array)$acDetails);
        $data[]=$acDetails;
        $data[]=$schedules;
        $data[]=$totals;
        return $data;
    }
    public function showNewPlansItems($render=2,$path="",$tags=array("2")){
    	
        $fy = $this->choice[1];
        $new_item_cond = $this->_model->where(array(array("where","plansschedule.approved",1,"="),array("AND","users.cname",$_SESSION['cname'],"="),array("AND","planheader.fy",$fy,"=")));  
        $new_item = $this->_model->countNewSchedules($new_item_cond);
        $data[] =$fy;
        $data[]=$new_item;
		return $data;
        //$this->template->view("",$data);
    }

    public function adjust_financial_year(){
        //get_financial_year(date('Y-m-d')); 
        if($this->choice[3]==="n"){
          $Fy=  $this->choice[1]+1;  
        }  elseif($this->choice[3]==="p") {
            $Fy=  $this->choice[1]-1;
        }
        
        print($Fy);
    }
    public function pfPlansView($render=2,$path="",$tags=array("2")){
        $fy = $this->choice[1];
        $all_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","users.cname",$_SESSION['cname'],"=")));
        $all = $this->_model->countNewSchedules($all_cond);
        $data[]=$fy;
        $data[]=$all;
		return $data;
        //$this->template->view("",$data);
    }

    public function checkSchedule(){
        $fy = $this->choice[1];
        $AccNo = $this->choice[3];
        
        $schedule_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","plansschedule.AccNo",$AccNo,"="),array("AND","icpNo",$_SESSION['fname'],"=")));
        $schedule = $this->_model->getSchedule($schedule_cond);
        print_r(json_encode($schedule));
    }
    public function viewAllSchedules($render=2,$path="",$tags=array("1")){
        if($this->choice[2]==="scheduleID"){
            $scheduleID=  $this->choice[3];
            $del_cond = $this->_model->where(array(array("where","scheduleID",$scheduleID,"=")));
            $this->_model->deleteQuery($del_cond,"plansschedule");
        }
        $fy = $this->choice[1];
        $schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",Resources::session()->fname,"=")));
        $schedules = $this->_model->getScheduleWithAcNames($schedules_cond);
        
        $acDetails=array();
        foreach ($schedules as $filter):
            $obj = new stdClass();
            $obj->AccNo=$filter->AccNo;
            $obj->AccText=$filter->AccText;
            $obj->AccName=$filter->AccName;
            $acDetails[$filter->AccText]=$obj;
        endforeach;
        
        //$totals=$this->_model->getSchedulesSummaryWithAcNames($schedules_cond);
        //$data[]=$acDetails;
        
        //$schedules_arr=array();
		//$keys_arr = array_keys((array)$schedules[0]);

        $data[]=$acDetails;
		$data[]=$schedules;
        //$data[]=$totals;
        return $data;
    }
    public function viewPlanSummary($render=2,$path="",$tags=array("1")){
        $fy = $this->choice[1];
        //if($_SESSION['userlevel']==="1"){
        $summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"="),array("AND","plansschedule.approved","2","=")));
        //}else{
       // $summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$this->choice[3],"="),array("AND","plansschedule.approved","2","=")));            
        //}
        
        $total_summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"=")));        
        $summary = $this->_model->getSchedulesSummaryWithAcNames($summary_cond);
        $total_summary = $this->_model->getSchedulesSummaryWithAcNames($total_summary_cond);
        
        $totals = $this->_model->getBudgetTotalArray($summary_cond);
        $All_Totals = $this->_model->getBudgetTotalArray($total_summary_cond);
        
        $data[]=$summary;
        $data[]=$totals;
        $data[]=$total_summary;
        $data[]=$All_Totals;
        $data[]=$fy;
        return $data;
    }
    public function viewPlanSummaryByPf($render=2,$path='',$tags=array("2")){
        $fy = $this->choice[1];
        $icpNo = $this->choice[3];
        //if($_SESSION['userlevel']==="1"){
        $summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$icpNo,"="),array("AND","plansschedule.approved","2","=")));
        //}else{
       // $summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$this->choice[3],"="),array("AND","plansschedule.approved","2","=")));            
        //}
        
        $total_summary_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$icpNo,"=")));        
        $summary = $this->_model->getSchedulesSummaryWithAcNames($summary_cond);
        $total_summary = $this->_model->getSchedulesSummaryWithAcNames($total_summary_cond);
        
        $totals = $this->_model->getBudgetTotalArray($summary_cond);
        $All_Totals = $this->_model->getBudgetTotalArray($total_summary_cond);
        
        $data[]=$summary;
        $data[]=$totals;
        $data[]=$total_summary;
        $data[]=$All_Totals;
        $data[]=$icpNo;
        $data[]=$fy;
        return $data;
    }
    public function postSchedule(){
        $AccNo = array_shift($_POST);
        $fy=  array_shift($_POST);
        
        $chk_plan_cond = $this->_model->where(array(array("where","icpNo",$_SESSION['fname'],"="),array("AND","fy",$fy,"=")));        
        
        $chk_plan=  $this->_model->getAllRecords($chk_plan_cond,"planheader");
        if(count($chk_plan)===0){
            $header_arr = array('fy'=>$fy,'icpNo'=>Resources::session()->fname);
            $this->_model->insertRecord($header_arr,"planheader");
        }
        
        $chk_plan_two=  $this->_model->getAllRecords($chk_plan_cond,"planheader");
        $headerID = $chk_plan_two[0]->planHeaderID;
        $chk_plan_cond_with_acc = $this->_model->where(array(array("where","planHeaderID",$headerID,"="),array("AND","AccNo",$AccNo,"=")));
        
        $chk_plan_with_acc=  $this->_model->getAllRecords($chk_plan_cond_with_acc,"plansschedule");
        if(count($chk_plan_with_acc)>0){
            $this->_model->deleteQuery($chk_plan_cond_with_acc,"plansschedule");
        }

        $lead_arr=array();
       for($i=0;$i<count($_POST['qty']);$i++){
           $lead_arr['planHeaderID'][$i]=$headerID;
           $lead_arr['AccNo'][$i]=$AccNo;

       }
       
       
       $fin = array_merge($lead_arr,$_POST);
       //print_r($fin);
       echo $this->_model->insertArray($fin,"plansschedule");
    }
    public function planRequest(){
        $_POST['senderID']=$_SESSION['ID'];
        echo $this->_model->insertRecord($_POST,"plansrequests");
        if($_SESSION['userlevel']!=="1"){
            echo 1;
        }
    }

    public function getRequests(){
        $scheduleID=$this->choice[1];
        $rqType=  $this->choice[3];
        $request_cond = $this->_model->where(array(array("where","plansrequests.scheduleID",$scheduleID,"=")));
        $requests = $this->_model->getRequestsQuery($request_cond);
        if($rqType==="rejItem"){
            $set = array("approved"=>"3");
            $set_cond = $this->_model->where(array(array("where","scheduleID",$scheduleID,"=")));
            $this->_model->updateQuery($set,$set_cond,"plansschedule");
        }
        print_r(json_encode($requests));
    }
    public function submitNewPlanItem($render=2,$path="viewAllSchedules",$tags=array("All")){
        $scheduleID =  $this->choice[1];
        $set_arr = array("approved"=>"1");
        $update_cond = $this->_model->where(array(array("where","scheduleID",$scheduleID,"=")));
        $rst = $this->_model->updateQuery($set_arr,$update_cond,"plansschedule");
        if($rst===1){
                $fy = $this->choice[3];
                $schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"=")));
                $schedules = $this->_model->getScheduleWithAcNames($schedules_cond);

                $acDetails=array();
                foreach ($schedules as $filter):
                    $obj = new stdClass();
                    $obj->AccNo=$filter->AccNo;
                    $obj->AccText=$filter->AccText;
                    $obj->AccName=$filter->AccName;
                    $acDetails[$filter->AccText]=$obj;
                endforeach;

                $totals=$this->_model->getSchedulesSummaryWithAcNames($schedules_cond);
                //array_unique((array)$acDetails);
                $data[]=$acDetails;
                $data[]=$schedules;
                $data[]=$totals;  
				return $data;  
                
                
        }else{
            echo "0";
        }
        
    }
    public function massSubmitPlanItems($render=1,$path="viewAllSchedules"){
        $fy = $this->choice[1];
        $new_schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"="),array("AND","plansschedule.approved",0,"=")));
        $new_schedules = $this->_model->getScheduleIDs($new_schedules_cond);
        foreach($new_schedules as $id):
            $update_cond = $this->_model->where(array(array("where","scheduleID",$id,"=")));   
            $set = array("approved"=>"1");
            $update = $this->_model->updateQuery($set,$update_cond,"plansschedule");
        endforeach;
        
        //$fy = $this->choice[3];
                $schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"=")));
                $schedules = $this->_model->getScheduleWithAcNames($schedules_cond);

                $acDetails=array();
                foreach ($schedules as $filter):
                    $obj = new stdClass();
                    $obj->AccNo=$filter->AccNo;
                    $obj->AccText=$filter->AccText;
                    $obj->AccName=$filter->AccName;
                    $acDetails[$filter->AccText]=$obj;
                endforeach;

                $totals=$this->_model->getSchedulesSummaryWithAcNames($schedules_cond);
                //array_unique((array)$acDetails);
                $data[]=$acDetails;
                $data[]=$schedules;
                $data[]=$totals;    
                return $data;
        
    }

    public function mfr($render=1,$path="",$tags=array("1")){
	        $year=date("Y");
			$month=date("m");
			$fullDate=date("Y-m-d");     

			$acc_cond = $this->_model->where(array(array("where","voucher_body.icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
	        $balBf_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime('-1 month',strtotime($fullDate))),"=")));
			
			$chk_end_bal_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime($fullDate)),"=")));            
			
			$bc_end_bal_cond = $this->_model->where(array(array("where","month",date("Y-m-t",strtotime("-1 month")),"="),array("AND","accNo","BC","="),array("AND","icpNo",Resources::session()->fname,"=")));
			$pc_end_bal_cond = $this->_model->where(array(array("where","month",date("Y-m-t",strtotime("-1 month")),"="),array("AND","accNo","PC","="),array("AND","icpNo",Resources::session()->fname,"=")));
			
			$month_bank_inc_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			$month_bank_exp_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			
			$month_pc_inc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","AccNo",2000,"="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			$month_pc_exp_cond = $this->_model->where(array(array("where","VType","PC","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			
			$month_dep_in_transit_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
			$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
			
            $exp_acc_cond = $this->_model->where(array(array("where","AccGrp",0,"="),array("AND","prg","2","="),array("AND","Active",1,"=")));
			
            $acc = $this->_model->accountsForMfr($acc_cond);//An array of current month transactions
            $balBf = $this->_model->balFundsBf($balBf_cond);//An array of opening funds balances per month
            $chk_end_bal_qry = $this->_model->balFundsBf($chk_end_bal_cond);// Used to calculate submit state
            
            $bc_end_bal=$this->_model->getAllRecords($bc_end_bal_cond,"cashbal");//Previous month Closing Bank Balance
			$pc_end_bal=$this->_model->getAllRecords($pc_end_bal_cond,"cashbal");//Previous month Closing Petty Cash Balance
			
			$month_bank_inc=$this->_model->getAllRecords($month_bank_inc_cond,"voucher_body");
			$month_bank_exp=$this->_model->getAllRecords($month_bank_exp_cond,"voucher_body");
			
			$month_pc_inc=$this->_model->getAllRecords($month_pc_inc_cond,"voucher_body");
			$month_pc_exp=$this->_model->getAllRecords($month_pc_exp_cond,"voucher_body");
			
			$month_dep_in_transit=$this->_model->getAllRecords($month_dep_in_transit_cond,"voucher_header");			
			$month_oc=$this->_model->getAllRecords($month_oc_cond,"voucher_header");
			
			$exp_acc = $this->_model->getAllRecords($exp_acc_cond,"accounts");
			
			$maxID_cond=$this->_model->where(array(array("where","Month(TDate)",$month,"="),array("AND","Year(TDate)",$year,"=")));
			$maxID = $this->_model->getMaxVoucherID($maxID_cond);
			$year_todate_exp_cond=$this->_model->where(array(array("where","voucher_header.icpNo",Resources::session()->fname,"="),array("AND","voucher_header.Fy",Resources::func("get_financial_year",array($fullDate)),"="),array("AND","voucher_body.bID",$maxID,"<=")));
			
			$year_todate_exp=$this->_model->get_todate_expenses($year_todate_exp_cond);
			
			
			$todate_budget_cond=$this->_model->where(array(array("where","planheader.icpNo",Resources::session()->fname,"="),array("AND","planheader.fy",Resources::func("get_financial_year",array($fullDate)),"=")));
			
			$todate_budget = $this->_model->get_todate_budget($todate_budget_cond,date("n",strtotime($fullDate)));
			$sum_month_inc=0;
			$sum_month_exp=0;
			$sum_month_pc_inc=0;
			$sum_month_pc_exp=0;
			foreach ($month_bank_inc as $value) {
				$sum_month_inc+=$value->Cost;
			}
			foreach ($month_bank_exp as $value) {
				$sum_month_exp+=$value->Cost;
			}
			
			foreach ($month_pc_inc as $value) {
				$sum_month_pc_inc+=$value->Cost;
			}
			foreach ($month_pc_exp as $value) {
				$sum_month_pc_exp+=$value->Cost;
			}			
				$bc_bal=0;
				$pc_bal=0;
			if(isset($bc_end_bal)&&count($bc_end_bal)>0){
				$bc_bal = $bc_end_bal[0]->amount+$sum_month_inc-$sum_month_exp;
				$pc_bal = $pc_end_bal[0]->amount+$sum_month_pc_inc-$sum_month_pc_exp;
			}
			
			$tot_cash= $bc_bal+$pc_bal;
			
            if(empty($chk_end_bal_qry)){
            	$state = 0;
            }else{
            	$state=1;
            }
			
			
			$acc_arr = array();
			for ($i=0; $i < count($balBf); $i++) { 
				$acc_arr[$balBf[$i]->funds]=array(
				"bf"=>$balBf[$i]->amount,
				"inc"=>0,
				"exp"=>0,
				"end"=>0
				);
			}

			for ($i=0; $i < count($acc); $i++) {
				if(!array_key_exists($acc[$i]->AccNo, $acc_arr)) {
						if($acc[$i]->AccNo>99&&$acc[$i]->AccNo<1000){
							$inc += $acc[$i]->Cost;
						}else{
							$inc=0;
							if($acc[$i]->AccNo<100){
								$acc_arr[100]['exp']+=$acc[$i]->Cost;
							}else{
								$acc_arr[$acc[$i]->AccNo-1000]['exp']+=$acc[$i]->Cost;
							}
						}
						if($acc[$i]->AccNo>99&&$acc[$i]->AccNo<1000){
							$acc_arr[$acc[$i]->AccNo]=array(
							"bf"=>0,
							"inc"=>$inc,
							"exp"=>0,
							"end"=>0
							);
						}
					}else{
						$acc_arr[$acc[$i]->AccNo]['inc']+=$acc[$i]->Cost;
					}
			}
			
			foreach ($acc_arr as $key => $value) {
				$acc_arr[$key]['end']=$acc_arr[$key]['bf']+$acc_arr[$key]['inc']-$acc_arr[$key]['exp'];
			}
			ksort($acc_arr);
			
			
			$month_exp = array_merge($month_pc_exp,$month_bank_exp);

			$actual_month_exp=array();
			foreach ($month_exp as  $value) {
				if(array_key_exists($value->AccNo,$actual_month_exp)){
					$actual_month_exp[$value->AccNo]+=$value->Cost;
				}else{
					$actual_month_exp[$value->AccNo]=$value->Cost;
				}	
			}
			
			//$year_todate_bank_exp
			$todate_exp=array();
			foreach ($year_todate_exp as $value) {
				if(array_key_exists($value->AccNo,$todate_exp)){
					$todate_exp[$value->AccNo]+=$value->Cost;
				}else{
					$todate_exp[$value->AccNo]=$value->Cost;
				}
			}
			ksort($todate_exp);
			
			$todate_plan=array();
			foreach($todate_budget as $value){
				$todate_plan[$value->AccNo]=$value->Cost;
			}
			ksort($todate_plan);
			
			ksort($actual_month_exp);
			foreach ($exp_acc as $value) {
				$accs[$value->AccNo]['details']=array($value->AccText,$value->AccName);
				$accs[$value->AccNo]['figures']=array(
					//"cur"=>$actual_month_exp[$value->AccNo],
					//"accum"=>$todate_exp[$value->AccNo],
					//"bud"=>$todate_plan[$value->AccNo],
					//"var"=>$todate_plan[$value->AccNo]-$todate_exp[$value->AccNo],
					//"varPer"=>(($todate_plan[$value->AccNo]-$todate_exp[$value->AccNo])/$todate_plan[$value->AccNo])*100,
				);
			}
			
			
			
            $data[]=$state;
			$data[]=time();
			$data[]=$bc_bal;
			$data[]=$pc_bal;
			$data[]=$acc_arr;
			$data[]=$tot_cash;
			$data[]=$month_dep_in_transit;
			$data[]=$month_oc;
			$data[]=$accs;
			$data[]=$month_exp;
			//$data[]=$todate_plan;

            return $data;
    }
public function changeState(){
	$cond = $this->_model->where(array(array("where","hID",$this->choice[1],"=")));
	$sets = array("ChqState"=>1);
	$this->_model->updateQuery($sets,$cond,"voucher_header");
}
public function undochangeState(){
	$cond = $this->_model->where(array(array("where","hID",$this->choice[1],"=")));
	$sets = array("ChqState"=>0);
	$this->_model->updateQuery($sets,$cond,"voucher_header");	
}
public function mfrNav($render=2,$path="",$tags=array("1")){
    		//if(isset($this->choice[1])){
    			$year=date("Y",$this->choice[1]);
				$month=date("m",$this->choice[1]);
				$fullDate=date("Y-m-d",$this->choice[1]);
    		//}else{
	          //  $year=date("Y");
			//	$month=date("m");
				//$fullDate=date("Y-m-d");     
			//}
			$acc_cond = $this->_model->where(array(array("where","voucher_body.icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
	        $balBf_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime('-1 month',strtotime($fullDate))),"=")));
			
			$chk_end_bal_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime($fullDate)),"=")));            
			
			$bc_end_bal_cond = $this->_model->where(array(array("where",month,date("Y-m-t",strtotime("-1 month")),"="),array("AND","accNo","BC","="),array("AND","icpNo",Resources::session()->fname,"=")));
			$pc_end_bal_cond = $this->_model->where(array(array("where",month,date("Y-m-t",strtotime("-1 month")),"="),array("AND","accNo","PC","="),array("AND","icpNo",Resources::session()->fname,"=")));
			
			$month_bank_inc_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			$month_bank_exp_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			
			$month_pc_inc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","AccNo",2000,"="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			$month_pc_exp_cond = $this->_model->where(array(array("where","VType","PC","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			
			$month_dep_in_transit_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
			$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",Resources::session()->fname,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
			
            $exp_acc_cond = $this->_model->where(array(array("where","AccGrp",0,"="),array("AND","prg","2","="),array("AND","Active",1,"=")));
			
            $acc = $this->_model->accountsForMfr($acc_cond);//An array of current month transactions
            $balBf = $this->_model->balFundsBf($balBf_cond);//An array of opening funds balances per month
            $chk_end_bal_qry = $this->_model->balFundsBf($chk_end_bal_cond);// Used to calculate submit state
            
            $bc_end_bal=$this->_model->getAllRecords($bc_end_bal_cond,"cashbal");//Previous month Closing Bank Balance
			$pc_end_bal=$this->_model->getAllRecords($pc_end_bal_cond,"cashbal");//Previous month Closing Petty Cash Balance
			
			$month_bank_inc=$this->_model->getAllRecords($month_bank_inc_cond,"voucher_body");
			$month_bank_exp=$this->_model->getAllRecords($month_bank_exp_cond,"voucher_body");
			
			$month_pc_inc=$this->_model->getAllRecords($month_pc_inc_cond,"voucher_body");
			$month_pc_exp=$this->_model->getAllRecords($month_pc_exp_cond,"voucher_body");
			
			$month_dep_in_transit=$this->_model->getAllRecords($month_dep_in_transit_cond,"voucher_header");			
			$month_oc=$this->_model->getAllRecords($month_oc_cond,"voucher_header");
			
			$exp_acc = $this->_model->getAllRecords($exp_acc_cond,"accounts");
			
			$maxID_cond=$this->_model->where(array(array("where","Month(TDate)",$month,"="),array("AND","Year(TDate)",$year,"=")));
			$maxID = $this->_model->getMaxVoucherID($cond);
			$year_todate_exp_cond=$this->_model->where(array(array("where","voucher_header.icpNo",Resources::session()->fname,"="),array("AND","voucher_header.Fy",Resources::func(get_financial_year,array($fullDate)),"="),array("AND","voucher_body.bID",$maxID,"<=")));
			
			$year_todate_exp=$this->_model->get_todate_expenses($year_todate_exp_cond);
			
			
			$todate_budget_cond=$this->_model->where(array(array("where","planheader.icpNo",Resources::session()->fname,"="),array("AND","planheader.fy",Resources::func(get_financial_year,array($fullDate)),"=")));
			
			$todate_budget = $this->_model->get_todate_budget($todate_budget_cond,date("n",strtotime($fullDate)));
			
			foreach ($month_bank_inc as $value) {
				$sum_month_inc+=$value->Cost;
			}
			foreach ($month_bank_exp as $value) {
				$sum_month_exp+=$value->Cost;
			}
			
			foreach ($month_pc_inc as $value) {
				$sum_month_pc_inc+=$value->Cost;
			}
			foreach ($month_pc_exp as $value) {
				$sum_month_pc_exp+=$value->Cost;
			}			
			
			
			$bc_bal = $bc_end_bal[0]->amount+$sum_month_inc-$sum_month_exp;
			$pc_bal = $pc_end_bal[0]->amount+$sum_month_pc_inc-$sum_month_pc_exp;
			$tot_cash= $bc_bal+$pc_bal;
			
            if(empty($chk_end_bal_qry)){
            	$state = 0;
            }else{
            	$state=1;
            }
			
			
			$acc_arr = array();
			for ($i=0; $i < count($balBf); $i++) { 
				$acc_arr[$balBf[$i]->funds]=array(
				"bf"=>$balBf[$i]->amount,
				"inc"=>0,
				"exp"=>0,
				"end"=>0
				);
			}

			for ($i=0; $i < count($acc); $i++) {
				if(!array_key_exists($acc[$i]->AccNo, $acc_arr)) {
						if($acc[$i]->AccNo>99&&$acc[$i]->AccNo<1000){
							$inc += $acc[$i]->Cost;
						}else{
							$inc=0;
							if($acc[$i]->AccNo<100){
								$acc_arr[100]['exp']+=$acc[$i]->Cost;
							}else{
								$acc_arr[$acc[$i]->AccNo-1000]['exp']+=$acc[$i]->Cost;
							}
						}
						if($acc[$i]->AccNo>99&&$acc[$i]->AccNo<1000){
							$acc_arr[$acc[$i]->AccNo]=array(
							"bf"=>0,
							"inc"=>$inc,
							"exp"=>0,
							"end"=>0
							);
						}
					}else{
						$acc_arr[$acc[$i]->AccNo]['inc']+=$acc[$i]->Cost;
					}
			}
			
			foreach ($acc_arr as $key => $value) {
				$acc_arr[$key]['end']=$acc_arr[$key]['bf']+$acc_arr[$key]['inc']-$acc_arr[$key]['exp'];
			}
			ksort($acc_arr);
			
			
			$month_exp = array_merge($month_pc_exp,$month_bank_exp);

			$actual_month_exp=array();
			foreach ($month_exp as  $value) {
				if(array_key_exists($value->AccNo,$actual_month_exp)){
					$actual_month_exp[$value->AccNo]+=$value->Cost;
				}else{
					$actual_month_exp[$value->AccNo]=$value->Cost;
				}	
			}
			
			//$year_todate_bank_exp
			$todate_exp=array();
			foreach ($year_todate_exp as $value) {
				if(array_key_exists($value->AccNo,$todate_exp)){
					$todate_exp[$value->AccNo]+=$value->Cost;
				}else{
					$todate_exp[$value->AccNo]=$value->Cost;
				}
			}
			ksort($todate_exp);
			
			$todate_plan=array();
			foreach($todate_budget as $value){
				$todate_plan[$value->AccNo]=$value->Cost;
			}
			ksort($todate_plan);
			
			ksort($actual_month_exp);
			foreach ($exp_acc as $value) {
				$accs[$value->AccNo]=array(
					"text"=>$value->AccText,
					"item"=>$value->AccName,
					"cur"=>$actual_month_exp[$value->AccNo],
					"accum"=>$todate_exp[$value->AccNo],
					"bud"=>$todate_plan[$value->AccNo],
					"var"=>$todate_plan[$value->AccNo]-$todate_exp[$value->AccNo],
					"varPer"=>(($todate_plan[$value->AccNo]-$todate_exp[$value->AccNo])/$todate_plan[$value->AccNo])*100,
				);
			}
			
			
			
            $data[]=$state;
			$data[]=time();
			$data[]=$bc_bal;
			$data[]=$pc_bal;
			$data[]=$acc_arr;
			$data[]=$tot_cash;
			$data[]=$month_dep_in_transit;
			$data[]=$month_oc;
			$data[]=$accs;
			//$data[]=$todate_budget_cond;
			//$data[]=$todate_plan;

            return $data;
    }
    public function submitMfr(){
    	$cond_last_mfr=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
    	$maxMfrDate = $this->_model->maxMfrDate($cond_last_mfr);
		$curClosuredate=date("Y-m-t",strtotime("+1 month",strtotime($maxMfrDate)));
    	/**
		 * ICP should not close a report:
		 * a) Before the end of the month
		 * b) Where there is no previous report closure
		 * c) Bank reconciliation is incorrect
		 */
    	if(strtotime($curClosuredate)>strtotime($_POST['curDate'])){
				print("Reporting dealine is not yet or Invalid report!");
		}elseif(strtotime($curClosuredate)<strtotime($_POST['curDate'])){
				print("You have previous unsubmitted report(s)!");
		}else{
		
			$balHd=array();
	    	$balHd['icpNo']=Resources::session()->fname;
			$balHd['totalBal']=array_sum($_POST['endFunds']);
			$balHd['closureDate']=$curClosuredate;
			$balHd['allowEdit']=1;
			$balHd['systemOpening']=1;
			$this->_model->insertRecord($balHd,"opfundsbalheader");
			
			$balHdID= $this->_model->maxMfrID($cond_last_mfr);
			$funds_body = array();
			foreach ($_POST['endFunds'] as $key => $value) {
				$funds_body['balHdID']=$balHdID;
				$funds_body['funds']=$key;
				$funds_body['amount']=$value;
				$this->_model->insertRecord($funds_body,"opfundsbal");
			}
			print("Submit Complete!");	

		}	

		
		
    }
    public function statements($render=1,$path="",$tags=array("1")){
            return $data = "View Bank Statements";
            
    }

    public function disbursement($render=1,$path="",$tags=array("1","2","3")){
            
    } 
    public function uploadFundsList(){
        set_time_limit(3600); 
        $lists = $_POST['lists'];
        $file = $_FILES['csv']['tmp_name'];
        //$handle = fopen($file,"r");
        $this->_model->uploadFunds($lists,$file);
    }
    public function advicePerICP($render=1){
            $cluster_cond = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
            $cluster = $this->_model->getAllRecords($cluster_cond,"users");
            
            //$cst_cond = $this->_model->where(array(array("where","cname",$cluster[0]->cname,"="),array("AND","userlevel","2","<>")));
            return $cst = $this->_model->fundsPerICP($cluster[0]->cname);
      
    }

    public function fundsCategories(){
    	if(isset($this->choice[1])){
    		//$this->dispatch($render=2,'fundsCategories',$data,array("2","3"));
    	}else{
    		$cond = $this->_model->where(array(array("where","Month",date('Y-m-01',strtotime('-1 month')),"=")));
			$qry = $this->_model->getAllRecords($cond,"fundsschedule","LIMIT 0,10");
    		$this->dispatch($render=1,'fundsCategories',$qry,array("2","3"));
    	}
                    
    }

    public function fundsUpload($render=1,$path='',$tags=array("3")){
    	
           
    }

    public function viewSlip(){
    	if(isset($this->choice[1])){
    		//echo date('Y-m-d',$this->choice[1]);
    		$funds_cond = $this->_model->where(array(array("where","KENumber",Resources::session()->fname,"="),array("AND","Month",date('Y-m-d',$this->choice[1]),"=")));
            //$funds_cond = $this->_model->where(array(array("where","KENumber",$_SESSION['fname'],"="),array("AND","Month",date('Y-m-01'),"=")));
            
            $data[] = $this->_model->getAllRecords($funds_cond,"fundsschedule");
			$data[]=$this->choice[1];		
			$this->dispatch($render=2,"",$data,array("1"));
		}else{
            $funds_cond = $this->_model->where(array(array("where","KENumber",$_SESSION['fname'],"="),array("AND","Month",date('Y-m-01'),"=")));
            $data[] = $this->_model->getAllRecords($funds_cond,"fundsschedule");
			//$data[]=0;
			$this->dispatch($render=1,"",$data,array("1"));
		}	
            //return $data; 

    }

    public function chqIntel(){
        $icp = $_SESSION['username'];
        $chq = $this->choice[1];
        $rs = $this->_model->chqIntel($icp,$chq);
        if($rs>0){
            echo "The cheque number ".$chq." has already been used!";
        }  //else {
            //echo "You have skipped some cheques!";
        //}
    }
    public function downloadVoucher($render=1,$path='',$tags=array("1")){
    	$VNum=  $this->choice[1];
	        if($_SESSION['userlevel']==="1"){
	            $icpNo = $_SESSION['username'];
	        }  elseif ($_SESSION['userlevel']==="2") {
	            $icpNo = $_SESSION['username_backup'];
	        }  else {
	            
	        }
   		return $this->_model->showVoucher($VNum,$icpNo);
    }
    public function postVoucher(){
        //return $_POST;
        
        $header = array();
        for($i=0;$i<8;$i++){
            $header[]=  array_shift($_POST);
        }
        $header[]=array_pop($_POST);
        $fy = Resources::func("get_financial_year",array(date("Y-m-d")));
        $tm = time();
        $chqState =0;
        
		//print_r($header);
		
        $fld_header_arr = array("icpNo","TDate","Fy","VNumber","Payee","Address","VType","ChqNo","ChqState","TDescription","totals","unixStmp");
        $header_one = array_splice($header,0,2);
        $header_two = array_splice($header,0,5);
        array_push($header_two, $chqState);
        array_push($header, $tm);
        array_push($header_one,$fy);
        $new_header = array_merge($header_one, $header_two,$header);
        $qry_array = array_combine($fld_header_arr, $new_header);
        
        $qry_array['totals']=  str_replace(",","",$qry_array['totals']);
		echo $this->_model->insertRecord($qry_array,"voucher_header");
        //print_r($qry_array);
        
        $hID_cond=$this->_model->where(array(array("where","VNumber",$qry_array['VNumber'],"="),array("AND","icpNo",$qry_array['icpNo'],"=")));
        $hID_rst = $this->_model->getAllRecords($hID_cond,"voucher_header");
		
		//print_r($hID_rst);
        
        $body_raw =array();
        foreach($_POST as $val):
            $cnt_rows = count($val);
            for($j=0;$j<$cnt_rows;$j++){
                $body_raw[$j][]=$val[$j];
            }
        endforeach;
        $lead_body_fld_vals=array($hID_rst[0]->hID,$qry_array['icpNo'],$qry_array['VNumber'],$qry_array['TDate']);
        $end_body_fld_vals=array($qry_array['VType'],$qry_array['ChqNo'],$qry_array['unixStmp']);
        foreach($body_raw as $arr):
            $arr_fin=array_merge($lead_body_fld_vals,$arr,$end_body_fld_vals);
            $fld_body_arr=array("hID","icpNo","VNumber","TDate","Qty","Details","UnitCost","Cost","AccNo","civaCode","VType","ChqNo","unixStmp");
            $body_raw_two = array_combine($fld_body_arr, $arr_fin);
            $body[]=$body_raw_two;
        endforeach;
        
        //print_r($body);
        foreach($body as $value):
            $this->_model->insertRecord($value,"voucher_body");
        endforeach;
		            //$mth = date('m');
                    //$icp = $_SESSION['username'];
                    //return $data = $this->_model->getMonthByNumber($mth,$icp);
        
		
    }
    public function showVoucher($render=1,$path="",$tags=array("1")){       
        $VNum=  $this->choice[1];
        if($_SESSION['userlevel']==="1"){
            $icpNo = $_SESSION['username'];
        }  elseif ($_SESSION['userlevel']==="2") {
            $icpNo = $_SESSION['username_backup'];
        }  else {
            
        }
        
        return $data = $this->_model->showVoucher($VNum,$icpNo);

    }
    public function getFlds(){
        $arr_tables=$this->_model->dbTables();
        $flds = $this->_model->getVoucherTableFields($arr_tables[$this->choice[1]]);
        print_r(json_encode($flds));
    }
    public function searchResults($render=1){
                $data = $this->_model->searchResultsQuery($_POST);
                if(is_array($data)){
                    $rst = $data;
                }  else {
                    $rst = $data;
                }
		return $rst;

    }
public function civ($render=1,$path='',$tags=array("3")){       
        $civa_cond = $this->_model->where(array(array("where","civa.open","1","="),array("AND","accounts.AccGrp","0","=")));
        //$civa = $this->_model->getAllRecords($civa_cond,"civa");
        $civa[] = $this->_model->civaExpenseAccounts($civa_cond);
            return $civa;
}
public function AddCIVA($render=1){
           
}

public function viewFunds(){
			if(isset($this->choice[1])){
				$funds_cond=  $this->_model->where(array(array("where","Month",date('Y-m-01',$this->choice[1]),"=")));
            	$funds[] = $this->_model->getAllRecords($funds_cond,"fundsschedule","LIMIT 0,100");
				$funds[]=$this->choice[1];
				$this->dispatch($render=2,"viewFunds",$funds,array("2","3"));
			}else{
				$funds_cond=  $this->_model->where(array(array("where","Month",date('Y-m-01'),"=")));
            	$funds[] = $this->_model->getAllRecords($funds_cond,"fundsschedule","LIMIT 0,100");
				$funds[]=time();
				$this->dispatch($render=1,"viewFunds",$funds,array("2","3"));
			}


}
public function fundsOpBal($render=1,$path="",$tags=array("1")){
  
}
public function getExpAccounts(){
            $acc_cond=  $this->_model->where(array(array("where","AccGrp","1","=")));
            $acc = $this->_model->getAllRecords($acc_cond,"accounts");
            print_r(json_encode($acc));
}
public function addFundBal(){

	$day = date("j",strtotime($_POST['closureDate']));
	$cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","allowEdit","1","=")));
	$qry = $this->_model->getAllRecords($cond,"opfundsbalheader");
	
	$cond_two = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
	$qry_two = $this->_model->getAllRecords($cond_two,"opfundsbalheader");
		
	if(count($qry)===0&&count($qry_two)>0){
		print("You are not allowed to edit this record!");	
	}else{
		//if(date('t',strtotime($_POST['closureDate']))===$day){
		//	print("Choose the last day of the month as the close date.");
		//}else{
		    $header_arr['closureDate']=$_POST['closureDate'];
		    $header_arr['icpNo']=$_SESSION['fname'];
		    $header_arr['totalBal']=$_POST['totalBal'];
		    $header_arr['systemOpening']="1";
		    $bal_chk_cond = $this->_model->where(array(array("where","icpNo",$_SESSION['fname'],"="),array("AND","systemOpening","1","=")));
		    $bal_chk = $this->_model->getAllRecords($bal_chk_cond,"opfundsbalheader");
		 
		    if(count($bal_chk)>0){
		        $balID = $bal_chk[0]->balHdID;
		        $id_cond = $this->_model->where(array(array("where","balHdID",$balID,"=")));
		        $this->_model->deleteQuery($bal_chk_cond,"opfundsbalheader");
		        $this->_model->deleteQuery($id_cond,"opfundsbal");
		    }
		    array_shift($_POST);
		    array_shift($_POST);
		    $this->_model->insertRecord($header_arr,"opfundsbalheader");
		    
		    $new_bal_chk_cond = $this->_model->where(array(array("where","icpNo",$_SESSION['fname'],"=")));
		    $new_bal_chk = $this->_model->getAllRecords($new_bal_chk_cond,"opfundsbalheader");
		    $curID = $new_bal_chk[0]->balHdID;
		
		    for($i=0;$i<sizeof($_POST['funds']);$i++){
		        $_POST['balHdID'][$i]=$curID;
		    }
		    $this->_model->insertArray($_POST,"opfundsbal");
		//}
	}
}
public function pfSettings($render=1,$path="icpSelectorForBal",$tags=array("2")){
                $selector_cond_pf = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
                $selector_pf = $this->_model->getAllRecords($selector_cond_pf,"users");
                $cluster = $selector_pf[0]->cname;
                $selector_cond_icps = $this->_model->where(array(array("where","cname",addslashes($cluster),"="),array("AND","userlevel","1","=")));
                return $selector_icps = $this->_model->getAllRecords($selector_cond_icps,"users");     
}
public function showOpeningBal($render=1){
        if(isset($_POST['icpSelector'])){
            $icpNo = $_POST['icpSelector'];
        }else{
            $icpNo=$_SESSION['fname'];
        }
        $icp_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
        return $icp = $this->_model->getAllRecords($icp_cond,"opfundsbalheader");

}
public function oustChqBf($render=1,$path="",$tags=array("1")){    
              
}
public function addOustChqBf(){
    //print_r($_POST);
    $frmData = $_POST;
    for($i=0;$i<count($frmData['chqNo']);$i++){
        $frmData['icpNo'][$i]=$_SESSION['fname'];
    }
        $chks_cond = $this->_model->where(array(array("where","icpNo",$_SESSION['fname'],"=")));
        $chks = $this->_model->getAllRecords($chks_cond,"oschqbf"); 
        if(count($chks)>0){
            $this->_model->deleteQuery($chks_cond,"oschqbf");
        }
        echo $this->_model->insertArray($frmData,"oschqbf");
    //print_r($frmData);
    
}
public function viewBal($render=2,$path="",$tags=array("All")){
	$cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->viewFundsBal($cond);
	return $qry;
}
public function cashBalBf($render=1,$path="",$tags=array("1")){   
      
}

public function addCash(){
	$day = date("t",strtotime($_POST['cjCashOpBal']));	
	
	$cond = $this->_model->where(array(array("where","month",$_POST['cjCashOpBal'],"="),array("AND","icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->getAllRecords($cond,"cashbal");
	$cnt = count($qry);
	if($cnt===0){
		if(date("j",strtotime($_POST['cjCashOpBal']))===$day){
			$size = count($_POST['cashBal']);
			$accNos =array("BC","PC");
			$arr=array();
			for ($i=0; $i < $size; $i++) { 
				$arr['month'][]=$_POST['cjCashOpBal'];
				$arr['icpNo'][]=Resources::session()->fname;
				$arr['accNo'][]=$accNos[$i];
				$arr['amount'][]=$_POST['cashBal'][$i];
				
			}
			//print(count($qry));
			print($this->_model->insertArray($arr,"cashbal"));
		}else{
			print("The date specified should be the last date of the month!");
		}
	}else{
		print("Closing Cash Balances for the specified period exists!");
	}
}
public function addStmtCash(){
	//print_r($_POST);
	$day = date("t",strtotime($_POST['bsCashOpBalDate']));	
	
	$cond = $this->_model->where(array(array("where","month",$_POST['bsCashOpBalDate'],"="),array("AND","icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->getAllRecords($cond,"statementbal");
	$cnt = count($qry);
	
	if($cnt===0){
		if(date("j",strtotime($_POST['bsCashOpBalDate']))===$day){
			$arr['month']=$_POST['bsCashOpBalDate'];
			$arr['icpNo']=Resources::session()->fname;
			$arr['amount']=$_POST['bsCashOpBal'];
			print($this->_model->insertRecord($arr,"statementBal"));
		}else{
			print("The date specified should be the last date of the month!");
		}
	}else{
		print("Closing Balances for the specified period exists!");
	}
}

public function opRecon($render=1,$path="",$tags=array("1")){   
      
}

public function viewCashBal($render=2,$path="",$tags=array("1")){
	$cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->getAllRecords($cond,"cashbal");
	return $qry;
}
public function viewCashStmtBal($render=2,$path="",$tags=array("1")){
	//print("Hello there!");
	$cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->getAllRecords($cond,"statementBal");
	return $qry;
}
public function ocView($render=2,$path="",$tags=array("1")){
	$cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","chqState",0,"=")));
	$qry = $this->_model->getAllRecords($cond,"oschqbf");
	return $qry;
}

}