<?php
class Finance_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Finance_Model("voucher_header");  
        //$this->helper->get_func(array("get_financial_year","test","get_month_number_array"));
    }
    public function switchboard($render=1,$path='',$tags=array("2","3","9","22")){
    	$clst='';
    	if(Resources::session()->userlevel==='2'){
    		$cluster_rcd_cond = $this->_model->where(array(array("where","ID",Resources::session()->ID,"=")));
			$cluster_rcd=$this->_model->getAllRecords($cluster_rcd_cond,"users");
			$clst=$cluster_rcd[0]->cname;
    	}
        return $cluster = $this->_model->getClusters($clst);
    }
	public function view(){
		$data=array();
		$render=1;
		$path="";
		$tags=array("All");
		
		//Submitted MFRs
		$arr_cond ="";
		$rst_arr=array();
		$recent_mfr_arr=array();
		if(Resources::session()->userlevel==='1'){
			$data['icp']=Resources::session()->fname;
			$arr_cond=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));	
			$rst_arr_raw = $this->_model->getAllRecords($arr_cond,"bssubmitted","",array("icpNo","month","stmp"));
			$i=0;
			foreach ($rst_arr_raw as $value) {
				$rst_arr[$value->icpNo][$i]['month']=$value->month;
				$rst_arr[$value->icpNo][$i]['stmp']=$value->stmp;
				$i++;
			}
		}elseif(Resources::session()->userlevel==='2'){
			$data['cst']=Resources::session()->cname;
			$path="pfview";
			$arr_cond=$this->_model->where(array(array("WHERE","users.cname",Resources::session()->cname,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"=")));
			$rst_arr_raw = $this->_model->getAllRecords($arr_cond,"bssubmitted","",array("bssubmitted.icpNo:icpNo","bssubmitted.month:month","bssubmitted.stmp:stmp"),array("LEFT JOIN"=>array("bssubmitted"=>"icpNo","users"=>"fname")));
			$i=0;
			foreach ($rst_arr_raw as $value) {
				$rst_arr[$value->icpNo][$i]['month']=$value->month;
				$rst_arr[$value->icpNo][$i]['stmp']=$value->stmp;
				$i++;
			}
		}else{
			$path="allicpsview";
			$arr_cond=$this->_model->where(array(array("WHERE","users.cname",Resources::session()->cname,"="),array("AND","users.userlevel",1,"="),array("AND","users.department",0,"=")));
			$rst_arr_raw=$this->_model->getAllRecords("","bssubmitted","GROUP BY bssubmitted.icpNo",array("users.cname:cname","bssubmitted.icpNo:icpNo","count('bssubmitted.icpNo'):cnt","MAX('bssubmitted.month')"),array("LEFT JOIN"=>array("bssubmitted"=>"icpNo","users"=>"fname")));
			$j=0;
			foreach ($rst_arr_raw as $value) {
				$rst_arr[$value->cname][$j]['icp']=$value->icpNo;
				$rst_arr[$value->cname][$j]['cnt']=$value->cnt;
				$j++;
			}
			//Max Date
			//$n=0;
			//$recent_mfr_arr=array();
			foreach ($rst_arr as $k=>$v) {
				foreach ($v as $val) {
					$new_cond = $this->_model->where(array(array("WHERE","icpNo",$val['icp'],"=")));
					$new_arr = $this->_model->getAllRecords($new_cond,"bssubmitted","",array("icpNo","MAX(month):recent")); 
					$recent_mfr_arr[$val['icp']]=$new_arr[0]->recent;
				}
				//$n++;
				
			}
		}
		
		
		
		$data['test']="";
		$data['recent']=$recent_mfr_arr;
		$data['rec']=$rst_arr;
		//return $data;
		$this->dispatch($render,$path,$data,$tags);
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
        }elseif($voucherType_code==="PCR"){
        	$AccGrp = 4;
        }
        $cond = $this->_model->where(array(array("where","accounts.AccGrp",$AccGrp,"=")));
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

    public function voucher($render=1,$path="",$tags=array("All")){
            try{
                if(isset($_SESSION['username'])){
                	
					//Date Control
					$date_control_cond=$this->_model->where(array(array("where","extraID",6,"=")));
					$date_control=$this->_model->getAllRecords($date_control_cond,"extras");
					$date_control_flag=$date_control[0]->flag;
					
					//Max Voucher - Get Max Date and Voucher Number
					$max_date_cond=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
					$max_date=$this->_model->maxICPVoucher($max_date_cond);
					
					$max_close_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
					$max_close=$this->_model->maxCloseBal($max_close_cond);
					
					$max_voucher=array();
					if(!empty($max_close)&&empty($max_date)){
							//$fy=Resources::func("get_financial_year",array(date("Y-m-d",strtotime('next month',strtotime($max_close[0]->closureDate)))));
							$fy=date("y",strtotime('next month',strtotime($max_close[0]->closureDate)));
							$m=date("m",strtotime('next month',strtotime($max_close[0]->closureDate)));					
							$max_voucher['TDate']=date("Y-m-01",strtotime('next month',strtotime($max_close[0]->closureDate)));
							$max_voucher['VNumber']=$fy.$m."00";
					}elseif(!empty($max_date)){
							$max_voucher['TDate']=$max_date[0]->TDate;
							$max_voucher['VNumber']=$max_date[0]->VNumber;
					}else{
								
						$open_bc_bal_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=",array("AND","accNo","BC","="))));
						$open_bc_bal=$this->_model->getAllRecords($open_bc_bal_cond,"cashbal");
						if(empty($open_bc_bal)){
							$fy_begin_date = '2015-06-30';
						}else{
							$fy_begin_date = $open_bc_bal[0]->month;
						}	
								//$fy_begin_date = '2015-06-30';
								//$fy=Resources::func("get_financial_year",array(date("Y-m-d",strtotime('next month',strtotime($fy_begin_date)))));
								$fy=date("y",strtotime('next month',strtotime($fy_begin_date)));
								$m=date("m",strtotime('next month',strtotime($fy_begin_date)));
								$max_voucher['TDate']=	$fy_begin_date;//$open_bc_bal[0]->month;
								$max_voucher['VNumber']=$fy.$m."00";				
					}
					
                    $mth = date('m');
                    $icp = $_SESSION['fname'];
					
					//Check if MFR was submitted
					$max_voucher_month=date("m",strtotime($max_voucher['TDate']));
					$max_voucher_year=date("Y",strtotime($max_voucher['TDate']));
					
					$chk_mfr_cond = $this->_model->where(array(array("where","Month(month)",$max_voucher_month,"="),array("AND","Year(month)",$max_voucher_year,"="),array("AND","icpNo",Resources::session()->fname,"=")));
					$chk_mfr_arr = $this->_model->getAllRecords($chk_mfr_cond,"bssubmitted");
					
					$data['cDate']=$max_voucher['TDate'];
					if(!empty($chk_mfr_arr)){
						$data['cDate']=date('Y-m-d',strtotime("+1 day",strtotime($chk_mfr_arr[0]->month)));
					}
					
					$data['months'] = $this->_model->getMonthByNumber($mth,$icp);
					$data['date_flag']=$date_control_flag;
					$data['maxRec']=$max_voucher;
					$data['test']="";
                    return $data; 
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
    	$d='';
		$v_month='';
		$render='';
		if(Resources::session()->userlevel==='1'){
			if(isset($this->choice[1])){
            	$d=date('Y-m-t',strtotime("last day of previous month",$this->choice[1]));
            	$v_month =date('m',$this->choice[1]);
				$data[4]=$this->choice[1];
				$render=2;
			}else{
				$d=date('Y-m-t',strtotime("last day of previous month"));
				$v_month=date('m');
				$render=1;
			}
			$icpNo = Resources::session()->fname;
		}else{
			$icpNo=$this->choice[3];
			$_SESSION['fname_backup']=$icpNo;
				if(isset($this->choice[1])){
            		$d=date('Y-m-t',strtotime("last day of previous month",$this->choice[1]));
            		$v_month =date('m',$this->choice[1]);
					$data[4]=$this->choice[1];
					$render=2;
				}else{
					$d=date('Y-m-t',strtotime("last day of previous month"));
					$v_month=date('m');
					$render=2;
				}
		}
					$bc_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","month",$d,"="),array("AND","accNo","BC","=")));
    				$pc_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","month",$d,"="),array("AND","accNo","PC","=")));
		
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
					
					//Get FootNotes
					if(isset($this->choice[1])){
						$y = date("Y",$this->choice[1]);
					}else{
						$y=date("Y");
					}
					$VoucherFootNotes_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","Month(VDate)",$v_month,"="),array("AND","Year(VDate)",$y,"=")));
					$VoucherFootNotes_arr = $this->_model->getAllRecords($VoucherFootNotes_cond,"voucherfootnotes");
					
					//Noted Vouchers
					$noted_vouchers=array();
					foreach($VoucherFootNotes_arr as $value):
						$noted_vouchers[]=$value->VNumber;
					endforeach;
					
					
                	$cds = $this->_model->where(array(array("where","voucher_header.icpNo",$icpNo,"="),array("AND","Month(voucher_header.TDate)",$v_month,"=")));
            	    $data[0]=$this->_model->accounts();
		            $data[1] = $this->_model->getVoucherForEcj($cds);
					$data[2]=$bc;//BC Balance
					$data[3]=$pc;//PC Balance
					$data[5]=$icpNo;
					$data[6]=$VoucherFootNotes_arr;
					$data[7]=array_unique($noted_vouchers);
		            
		            $this->dispatch($render,"",$data,array("All"));
		            
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
	public function pfSchedulesFromSwitchBoard(){           
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
        //return $data;
         $this->dispatch($render=2,$path="pfSchedules",$data=$data,$tags=array("2"));
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
        $data=array();
        $fy = $this->choice[1];
		$r=$fy-1;
		$closureDate = '20'.$r.'-06-30';
        $all_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","users.cname",Resources::session()->cname,"=")));
        $all = $this->_model->countNewSchedules($all_cond);
		
		if(empty($all)){
			$data['error']="<div id='error_div'>Budget Schedules for the FY{$fy} missing</div>";
			return $data;
			exit;
		}	
		
        $data[]=$fy;
        $data[]=$all;
		//$data[]=$param;
		return $data;

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
        
        $totals=$this->_model->getSchedulesSummaryWithAcNames($schedules_cond);
		
		$rqMsg_cond = $this->_model->where(array(array("where","closed",0,"="),array("AND","senderID",Resources::session()->ID,"=")));
		$rqMsg = $this->_model->getAllRecords("","plansrequests");
		//foreach():
		//endforeach;
		
        //$data[]=$acDetails;
        
        //$schedules_arr=array();
		//$keys_arr = array_keys((array)$schedules[0]);

        $data[]=$acDetails;
		$data[]=$schedules;
        $data[]=$totals;
		$data[]=$rqMsg;
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
    public function massSubmitPlanItems($render=2,$path="viewAllSchedules",$tags=array("All")){
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

    public function mfr($render=1,$path="",$tags=array("All")){
    		$data=array();
	        $year=date("Y");
			$month=date("m");
			$fullDate=date("Y-m-d");   
		
		$icpNo="";
		if(Resources::session()->userlevel==='1'){
				$icpNo = Resources::session()->fname;
			}else{
				$icpNo=$this->choice[1];
				$_SESSION['fname_backup']=$icpNo;
		}
						
			$acc_cond = $this->_model->where(array(array("where","voucher_body.icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
			$acc = $this->_model->accountsForMfr($acc_cond);//An array of current month transactions
			
			$balBf_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",$icpNo,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime('last day of previous month',strtotime($fullDate))),"=")));
			$balBf = $this->_model->balFundsBf($balBf_cond);//An array of opening funds balances per month
			
			//An array whose keys are accounts and values are opening balances for the month
			$refined_balbf=array();
			foreach($balBf as $value){
				$refined_balbf[$value['AccNo']]=$value['Amount'];
			}
			
			//An array whose keys are accounts and values are  transacted amounts for the month
			$refined_acc=array();
			foreach($acc as $value){
				$refined_acc[$value['AccNo']]=$value['Amount'];
			}
			
					
			//Extract unique keys from the refined arrays 
			$refined_acc_keys=array_keys($refined_acc);
			$refined_balbf_keys=array_keys($refined_balbf);
			$merge_keys = array_unique(array_merge($refined_acc_keys,$refined_balbf_keys));
			
			//Get sum of all transactions per account
			$sum_acc=array();
			foreach($merge_keys as $value){
				$sum_acc[$value]=0;
				if(array_key_exists($value, $refined_acc)){
					$sum_acc[$value]+=$refined_acc[$value];//$sum_balbf_acc
				}
			}
			ksort($sum_acc);// Sort in transactions in in ascending accounts order - A Very important array
			
			//Support expenses totals
			$support_exp_for_month = 0;
			foreach($sum_acc as $key=>$value){
				if($key<80 || $key===90){
					$support_exp_for_month+=$value;
				}
			}
			
			//CSP Grant Expenses
			$csp_exp_for_month = 0;
			foreach($sum_acc as $key=>$value){
				if($key>79&&$key<90){
					$csp_exp_for_month+=$value;
				}
			}			

			//None Support and None CSP Expenses array
			$none_support_csp_exp=array();
			foreach ($sum_acc as $key => $value) {
				if($key>1000&&$key<2000){
					$k=$key-1000;
					$none_support_csp_exp[$k]=$value;
				}
			}
			
			//All Incomes array
			$all_inc=array();
			foreach ($sum_acc as $key => $value) {
				if($key>=100&&$key<1000){
					$all_inc[$key]=$value;
				}
			}	
					
			
			//All Expenses Array
			$all_exp = array();
			$all_exp['100']=$support_exp_for_month;
			$all_exp['351']=$csp_exp_for_month;
			foreach($none_support_csp_exp as $key=>$value){
				$all_exp[$key]=$value;
			}
			
			//get unique keys reponding to R accounts
			$unique_acc_as_rev=array();
			foreach($merge_keys as $value){
				if($value>1000&&$value<2000){
					$unique_acc_as_rev[]=$value-1000;	
				}elseif($value>=100&&$value<1000){
					$unique_acc_as_rev[]=$value;
				}
				
			}
			
			//Add zero values to missing elements  
 			foreach($all_inc as $key=>$value){
				if(!array_key_exists($key, $refined_balbf)){
					$refined_balbf[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
				if(!array_key_exists($key, $all_exp)){
					$all_exp[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
			}
			
			foreach($all_exp as $key=>$value){
				if(!array_key_exists($key, $refined_balbf)){
					$refined_balbf[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
				if(!array_key_exists($key, $all_inc)){
					$all_inc[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
			}
			
			//End Balance Array
			$end_bal=array();
			foreach($unique_acc_as_rev as $value){
				$opBal=0;
				$fndInc=0;
				$fndExp=0;
				if(isset($refined_balbf[$value])){
					$opBal=$refined_balbf[$value];
				}
				if(isset($all_inc[$value])){
					$fndInc=$all_inc[$value];
				}
				if(isset($all_exp[$value])){
					$fndExp=$all_exp[$value];
				}
				$bal=$opBal+$fndInc-$fndExp;
				$end_bal[$value]=$bal;
			}
		
			ksort($refined_balbf);
			
			
			/**
			 * Cash and Banks Balances
			 */
			
		//Opening Bank Balances		 //date("t/m/Y", strtotime("last month"));
		$bc_end_bal_cond = $this->_model->where(array(array("where","month",date('Y-m-d', strtotime('last day of previous month')),"="),array("AND","accNo","BC","="),array("AND","icpNo",$icpNo,"=")));
		$bc_end_bal=$this->_model->getAllRecords($bc_end_bal_cond,"cashbal");//Previous month Closing Bank Balance
		if(!empty($bc_end_bal)){
			$bcBalBf=$bc_end_bal[0]->amount;
		}else{
			$bcBalBf=0;
		}
			
		
		//Opening PC Balances		
		$pc_end_bal_cond = $this->_model->where(array(array("where","month",date('Y-m-d', strtotime('last day of previous month')),"="),array("AND","accNo","PC","="),array("AND","icpNo",$icpNo,"=")));
		$pc_end_bal=$this->_model->getAllRecords($pc_end_bal_cond,"cashbal");//Previous month Closing Petty Cash Balance
		if(!empty($pc_end_bal)){
			$pcBalBf=$pc_end_bal[0]->amount;
		}else{
			$pcBalBf=0;
		}
			
		
		//All Bank Incomes for the month
		$month_bank_inc_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_bank_inc=$this->_model->getAllRecords($month_bank_inc_cond,"voucher_body");
		$bank_inc=0;
		foreach ($month_bank_inc as $value) {
				$bank_inc+=$value->Cost;
		}
		
		//All Bank Expenses for the month
		$month_bank_exp_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_bank_exp=$this->_model->getAllRecords($month_bank_exp_cond,"voucher_body");
		$bank_exp=0;
		foreach ($month_bank_exp as $value) {
				$bank_exp+=$value->Cost;
			}
		
		//All PC Income for the month
		$month_pc_inc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_pc_inc=$this->_model->monthPcIncome($month_pc_inc_cond);
		$pc_inc=$month_pc_inc;
		//foreach ($month_pc_inc as $value) {
			//	$pc_inc+=$value->Cost;
			//}
		
		//All PC Expenses for the month
		$month_pc_exp_cond = $this->_model->where(array(array("where","VType","PC","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_pc_exp=$this->_model->getAllRecords($month_pc_exp_cond,"voucher_body");
		$pc_exp=0;
		foreach ($month_pc_exp as $value) {
				$pc_exp+=$value->Cost;
			}
		
		//Bank and PC Closing Balances
		$close_bank_balance = $bcBalBf+$bank_inc-$bank_exp;
		$close_pc_balance=$pcBalBf+$pc_inc-$pc_exp;
		
		//Deposit in Transit
		$month_dep_in_transit_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
		$month_dep_in_transit=$this->_model->getAllRecords($month_dep_in_transit_cond,"voucher_header");
		
		//Oustanding Cheques
		//$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
		//$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array(array("AND","clrMonth","0000-00-00","="),array("OR","clrMonth",date('Y-m-t',$this->choice[1]),">"))));
		//$month_oc=$this->_model->getAllRecords($month_oc_cond,"voucher_header");
		$icpname=$icpNo;
		$curmonth = date('Y-m-t');
		$month_oc = $this->_model->current_month_outstanding_cheques($icpname, $curmonth);
		
		//All Expense Accounts
		$exp_acc_cond = $this->_model->where(array(array("where","AccGrp",0,"="),array("AND","Active",1,"=")));
		$acc_details = $this->_model->getAllRecords($exp_acc_cond,"accounts");
		$accs=array();
		foreach ($acc_details as $value) {
				$accs[$value->AccNo]=array($value->AccText,$value->AccName,$value->prg);
			}
		
		//Months Expenses per Account
		$exp_per_acc=array();
		foreach($refined_acc as $key=>$value){
			if($key<100||$key>1000&&$key<2000){
				$exp_per_acc[$key]=$value;
			}
		}
		
		//Maximum Transaction ID
		//$month_by_num = array(7,8,9,10,11,12,1,2,3,4,5,6);
		$maxID_cond=$this->_model->where(array(array("where","Month(TDate)",$month,"<="),array("AND","Year(TDate)",$year,"=")));
		$maxID = $this->_model->getMaxVoucherID($maxID_cond);
		
		//Expenses to date
		$year_todate_exp_cond=$this->_model->where(array(array("where","voucher_header.icpNo",$icpNo,"="),array("AND","voucher_header.Fy",Resources::func("get_financial_year",array($fullDate)),"="),array("AND","voucher_body.bID",$maxID,"<=")));	
		$year_todate_exp=$this->_model->get_todate_expenses($year_todate_exp_cond);
		$exp_to_date=array();
		foreach($year_todate_exp as $value){
			$key=$value->AccNo;
			if($key<100||$key>1000&&$key<2000){
				$exp_to_date[$key]=$value->Cost;
			}
		}
		
		
		//Accounts Details and Expense Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $exp_per_acc)){
				$accs[$key]['Exp']=$exp_per_acc[$key];
			}else{
				$accs[$key]['Exp']=0;	
			}
		}
		
		//Accounts Details and Expenses to Date Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $exp_to_date)){
				$accs[$key]['ExpToDate']=$exp_to_date[$key];
			}else{
				$accs[$key]['ExpToDate']=0;
			}
			
		}
		
		//Budget To Date
		$todate_budget_cond=$this->_model->where(array(array("where","planheader.icpNo",$icpNo,"="),array("AND","planheader.fy",Resources::func("get_financial_year",array($fullDate)),"="),array("AND","plansschedule.approved","2","=")));
		$todate_budget = $this->_model->get_todate_budget($todate_budget_cond,date("n",strtotime($fullDate)));
		$budget_to_date=array();
		foreach($todate_budget as $value){
			$budget_to_date[$value->AccNo]=$value->Cost;
		}
		
		//Accounts Details and Budget to Date Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $budget_to_date)){
				$accs[$key]['BudToDate']=$budget_to_date[$key];
			}else{
				$accs[$key]['BudToDate']=0;
			}
			
		}
		
		//Account Details and Variance Records
		foreach($accs as $key=>$value){
			$accs[$key]['var']=$accs[$key]['BudToDate']-$accs[$key]['ExpToDate'];
			if($accs[$key]['BudToDate']>0){	
				$accs[$key]['varPer']=($accs[$key]['var']/$accs[$key]['BudToDate'])*100;//@
			}else{
				$accs[$key]['varPer']=0;
			}
		}
			
		//Find Variance Explanation Statements
		$variance_explanation_cond=$this->_model->where(array(array("where","reportMonth",date("Y-m-t",strtotime($fullDate)),"="),array("AND","icpNo",$icpNo,"=")));
		$variance_explanation=$this->_model->getAllRecords($variance_explanation_cond,"varjustify");
		$varJustify=array();
		foreach($variance_explanation as $value){
			$varJustify[$value->AccNo]=$value->Details;
		}
		
		//Variance -/+ 10%
		$var_to_explain=array();
		foreach($accs as $key=>$value){
			
			if($value['varPer']>10 || $value['varPer']<-10){
				if(count($varJustify)>0){
					$value['notes']=$varJustify[$key];
				}
				$var_to_explain[$key]=$value;
			}
		}
		
		//Monthly Parameters -- Begin
		$param=array();
			//Calculate AFC	
			$afc=0;
			if($all_inc[100]>0){
				$afc=($end_bal[100]/$all_inc[100]);//@
			}
				
			
			//Calculate Budget Variance
			$sum_var = 0;
			foreach($accs as $key=>$value){
				if($key<100){
					$sum_var+=$value['var'];	
				}
				
			}
			$sum_bud_to_date=0;
			foreach ($accs as $value) {
				$sum_bud_to_date+=$value['BudToDate'];
			}
			
		$obv=0;
		if($sum_bud_to_date!==0){
			$obv=($sum_var/$sum_bud_to_date)*100;	
		}
		
		//Calculate Survival Ratio
		$sum_500_inc=0;
		foreach($all_inc as $key=>$value){
			if($key>500&&$key<600){
				$sum_500_inc+=$all_inc[$key];
			}
		}
		$sr=0;
		if($sum_500_inc!==0||$all_inc[100]!==0){
			$sr = ($sum_500_inc/$all_inc[100])*100;	
		}
		
		
		//Calculate Operating Ratio
		$sum_admin_exp =0;
		foreach($accs as $key=>$value){
			if($key===65||$key===70||$key===74||$key===75||$key===86||$key===87||$key===88){
				$sum_admin_exp+=$value['ExpToDate'];
			}
		}
		$or=0;
		if($all_exp[100]>0){
			$or=($sum_admin_exp/$all_exp[100])*100;//@
		}
		
		$param=array();		
		$param['afc']=$afc;
		$param['obv']=$obv;
		$param['sr']=$sr;
		$param['pcb']=$close_pc_balance;
		$param['or']=$or;
		$param['r']=0;
		//Monthly Parameters -- End
		
		
		//Reconstruct Outstanding Array
		$reconstruct_oc =array();
				//Add Current voucher_body Cheques to reconstruct_oc array
				$cnt=0;
				foreach($month_oc as $value){
					$reconstruct_oc[$cnt]['rId']=$value->hID;
					$reconstruct_oc[$cnt]['ChqNo']=$value->ChqNo;
					$reconstruct_oc[$cnt]['TDate']=$value->TDate;
					$reconstruct_oc[$cnt]['VNumber']=$value->VNumber;
					$reconstruct_oc[$cnt]['Details']=$value->TDescription;
					$reconstruct_oc[$cnt]['Amount']=$value->totals;
					$reconstruct_oc[$cnt]['source']=2;
					$cnt++;
				}
				
				//Add B/F Cheques to reconstruct_oc array
				$bf_oc_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","chqState",0,"=")));
				$bf_oc = $this->_model->getAllRecords($bf_oc_cond,"oschqbf");
				$cnt=count($reconstruct_oc);
				foreach($bf_oc as $value){
					$reconstruct_oc[$cnt]['rId']=$value->osBfID;
					$reconstruct_oc[$cnt]['ChqNo']=$value->chqNo;
					$reconstruct_oc[$cnt]['TDate']=$value->chqDate;
					$reconstruct_oc[$cnt]['VNumber']=$value->VNumber;
					$reconstruct_oc[$cnt]['Details']=$value->Details;
					$reconstruct_oc[$cnt]['Amount']=$value->amount;
					$reconstruct_oc[$cnt]['source']=1;
					$cnt++;
				}
		
		
		
		//Reconstruct Deposit in Transit
		$reconstruct_dep_in_transit =array();
				//Add Current voucher_body Cash Received to reconstruct_oc array
				$ct=0;
				foreach($month_dep_in_transit as $value){
					$reconstruct_dep_in_transit[$ct]['rId']=$value->hID;
					$reconstruct_dep_in_transit[$ct]['ChqNo']=$value->ChqNo;
					$reconstruct_dep_in_transit[$ct]['TDate']=$value->TDate;
					$reconstruct_dep_in_transit[$ct]['VNumber']=$value->VNumber;
					$reconstruct_dep_in_transit[$ct]['Details']=$value->TDescription;
					$reconstruct_dep_in_transit[$ct]['Amount']=$value->totals;
					$reconstruct_dep_in_transit[$ct]['source']=2;
					$ct++;
				}
				
				//Add B/F Cash Received to reconstruct_oc array
				$bf_dep_in_transit_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","TState",0,"=")));
				$bf_dep_in_transit = $this->_model->getAllRecords($bf_dep_in_transit_cond,"transitfundsbf");
				$ct=count($reconstruct_dep_in_transit);
				foreach($bf_dep_in_transit as $value){
					$reconstruct_dep_in_transit[$ct]['rId']=$value->transitBfID;
					$reconstruct_dep_in_transit[$ct]['TDate']=$value->TDate;
					$reconstruct_dep_in_transit[$ct]['VNumber']=$value->VNumber;
					$reconstruct_dep_in_transit[$ct]['Details']=$value->Details;
					$reconstruct_dep_in_transit[$ct]['Amount']=$value->amount;
					$reconstruct_dep_in_transit[$ct]['source']=1;
					$ct++;
				}		
		
		//MFR State
		//$chk_end_bal_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",$icpNo,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime($fullDate)),"=")));            
		//$chk_end_bal_qry = $this->_model->balFundsBf($chk_end_bal_cond);// Used to calculate submit state
		$chk_state_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","closureDate",date('Y-m-t',strtotime($fullDate)),"="))); 
		$chk_state=$this->_model->getAllRecords($chk_state_cond,"opfundsbalheader");
		$state=0;
		$mfrClosureFundsID=0;
		if(empty($chk_state)){
            	$state = 0;
         }elseif($chk_state[0]->allowEdit==='1'){
            	$state=1;
				$mfrClosureFundsID=$chk_state[0]->balHdID;
         }else{
         		$state=2;
				$mfrClosureFundsID=$chk_state[0]->balHdID;
         }
		 
		 
				
		//Find Bank Statement Date
		$bs_date_check_cond = $this->_model->where(array(array("where","month",date("Y-m-t",strtotime($fullDate)),"="),array("AND","icpNo",$icpNo,"=")));		
		$bs_date_check=$this->_model->getAllRecords($bs_date_check_cond,"statementbal");
		$statementDate = "";
		$statementAmount=0;
		if($state!==0){
			$statementDate=$bs_date_check[0]->statementDate;
			$statementAmount=$bs_date_check[0]->amount;
			
		}
				
		//Get Bank Statement File Name
		$getBs = $this->_model->getAllRecords($bs_date_check_cond,"bssubmitted");
				//$data['getBs']=$getBs;
		
		//Get MFR Notes
		
		$notes_cond = $this->_model->where(array(array("WHERE","period",date('Y-m-t'),"="),array("AND","noteto",$icpNo,"=")));
		$notes_arr = $this->_model->getAllRecords($notes_cond,"mfrnotes","ORDER BY noteID DESC");
		
		
		$data['balbf'] = $refined_balbf;
		$data['notes']=$notes_arr;
		$data['inc']=$all_inc;
		$data['exp']=$all_exp;
		$data['bal']=$end_bal;
		$data['bank']=$close_bank_balance;
		$data['pc']=$close_pc_balance;
		$data['transit']=$reconstruct_dep_in_transit;
		$data['oc']=$reconstruct_oc;
		$data['expenses']=$accs;
		$data['varExplain']=$var_to_explain;
		$data['param']=$param;
		$data['state']=$state;
		$data['stateID']=$mfrClosureFundsID;
		$data['statementDate']=$statementDate;
		$data['statementAmount']=$statementAmount;
		$data['varJustify']=$varJustify;
		$data['time']=time();
		$data['getBs']=$getBs;
		$data['icp']=$icpNo;
		$data['test']="";
		
		
		return $data;
			
    }
public function validateMFR(){
	//print("Hello ".$this->choice[1]);
	$validateMFR_cond = $this->_model->where(array(array("where","balHdID",$this->choice[1],"=")));
	$sets = array("allowEdit"=>0);
	$validateMFR=$this->_model->updateQuery($sets,$validateMFR_cond,"opfundsbalheader");
	//print($validateMFR);
	echo "Validation done successfully!";
}
public function changeState(){
	if($this->choice[3]==='2'){
		$cond = $this->_model->where(array(array("where","hID",$this->choice[1],"=")));
		$sets = array("ChqState"=>1,"clrMonth"=>date('Y-m-t',$this->choice[7]));
		$this->_model->updateQuery($sets,$cond,"voucher_header");
	}elseif($this->choice[5]==="dep"){
		$cond = $this->_model->where(array(array("where","transitBfID",$this->choice[1],"=")));
		$sets = array("TState"=>1,"clrMonth"=>date('Y-m-t',$this->choice[7]));
		$this->_model->updateQuery($sets,$cond,"transitfundsbf");		
	}elseif($this->choice[5]==="oc"){
		$cond = $this->_model->where(array(array("where","osBfID",$this->choice[1],"=")));
		$sets = array("chqState"=>1,"clrMonth"=>date('Y-m-t',$this->choice[7]));
		$this->_model->updateQuery($sets,$cond,"oschqbf");		
	}
}
public function undochangeState(){
	if($this->choice[3]==='2'){
		$cond = $this->_model->where(array(array("where","hID",$this->choice[1],"=")));
		$sets = array("ChqState"=>0,"clrMonth"=>'0000-00-00');
		$this->_model->updateQuery($sets,$cond,"voucher_header");
	}elseif($this->choice[5]==="dep"){
		$cond = $this->_model->where(array(array("where","transitBfID",$this->choice[1],"=")));
		$sets = array("TState"=>0,"clrMonth"=>'0000-00-00');
		$this->_model->updateQuery($sets,$cond,"transitfundsbf");		
	}elseif($this->choice[5]==="oc"){
		$cond = $this->_model->where(array(array("where","osBfID",$this->choice[1],"=")));
		$sets = array("chqState"=>0,"clrMonth"=>'0000-00-00');
		$this->_model->updateQuery($sets,$cond,"oschqbf");		
	}	
}
public function postMfrNotes(){
	$data=array();		
	
	//Post a note
	$this->_model->insertRecord($_POST,"mfrnotes");
	
	//Retrieve Notes
	$period = $_POST['period'];
	$icpNo = $_POST['noteto'];
	
	$notes_cond = $this->_model->where(array(array("WHERE","period",$period,"="),array("AND","noteto",$icpNo,"=")));
	$notes_arr = $this->_model->getAllRecords($notes_cond,"mfrnotes","ORDER BY noteID DESC");
	
	//Mail a notification
	$icp_mail_cond = $this->_model->where(array(array("WHERE","username",$icpNo,"=")));
	$icp_mail_arr=$this->_model->getAllRecords($icp_mail_cond,"users","",array("email"));
	$email = $icp_mail_arr[0]->email;
	 
	$title = "MFR Notification for the Period ending ".$period;
	$body = "You a notification from {$_POST['userfirstname']}:\n\n {$_POST['notes']}";
	 
	Resources::mailing($email, $title, $body); 
	
	$data['notes']=$notes_arr;
	//return $data;
	$this->dispatch($render=2,$path='',$data,$tags=array("All"));
}

public function mfrNav($render=2,$path="",$tags=array("All")){
		//Set Year, month and full date from choices received
		$data=array();
		$year=date("Y",$this->choice[1]);
		$month=date("m",$this->choice[1]);
		$fullDate=date("Y-m-d",$this->choice[1]);
		
		//Set ICP Number
		$icpNo ="";
		if(Resources::session()->userlevel==='1'){
				$icpNo = Resources::session()->fname;
			}else{
				$icpNo=$this->choice[3];
				$_SESSION['fname_backup']=$icpNo;
		}
	
	
		$acc_cond = $this->_model->where(array(array("where","voucher_body.icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$acc = $this->_model->accountsForMfr($acc_cond);//An array of current month transactions
		
		$transactions_arr=array();
		
		
		$data['chk']=$transactions_arr;
		
		
		
			$balBf_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",$icpNo,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime('last day of previous month',strtotime($fullDate))),"=")));
			$balBf = $this->_model->balFundsBf($balBf_cond);//An array of opening funds balances per month
			
			//An array whose keys are accounts and values are opening balances for the month
			$refined_balbf=array();
			foreach($balBf as $value){
				$refined_balbf[$value['AccNo']]=$value['Amount'];
			}
			
			//An array whose keys are accounts and values are  transacted amounts for the month
			$refined_acc=array();
			foreach($acc as $value){
				$refined_acc[$value['AccNo']]=$value['Amount'];
			}
			
					
			//Extract unique keys from the refined arrays 
			$refined_acc_keys=array_keys($refined_acc);
			$refined_balbf_keys=array_keys($refined_balbf);
			$merge_keys = array_unique(array_merge($refined_acc_keys,$refined_balbf_keys));
			
			//Get sum of all transactions per account
			$sum_acc=array();
			foreach($merge_keys as $value){
				$sum_acc[$value]=0;
				if(array_key_exists($value, $refined_acc)){
					$sum_acc[$value]+=$refined_acc[$value];//$sum_balbf_acc
				}
			}
			ksort($sum_acc);// Sort in transactions in in ascending accounts order - A Very important array
			
			//Support expenses totals
			$support_exp_for_month = 0;
			foreach($sum_acc as $key=>$value){
				if($key<80 || $key===90){
					$support_exp_for_month+=$value;
				}
			}
			
			//CSP Grant Expenses
			$csp_exp_for_month = 0;
			foreach($sum_acc as $key=>$value){
				if($key>79&&$key<90){
					$csp_exp_for_month+=$value;
				}
			}			

			//None Support and None CSP Expenses array
			$none_support_csp_exp=array();
			foreach ($sum_acc as $key => $value) {
				if($key>1000&&$key<2000){
					$k=$key-1000;
					$none_support_csp_exp[$k]=$value;
				}
			}
			
			//All Incomes array
			$all_inc=array();
			foreach ($sum_acc as $key => $value) {
				if($key>=100&&$key<1000){
					$all_inc[$key]=$value;
				}
			}	
					
			 
			//All Expenses Array
			$all_exp = array();
			$all_exp['100']=$support_exp_for_month;
			$all_exp['351']=$csp_exp_for_month;
			foreach($none_support_csp_exp as $key=>$value){
				$all_exp[$key]=$value;
			}
			
			//get unique keys reponding to R accounts
			$unique_acc_as_rev=array();
			foreach($merge_keys as $value){
				if($value>1000&&$value<2000){
					$unique_acc_as_rev[]=$value-1000;	
				}elseif($value>=100&&$value<1000){
					$unique_acc_as_rev[]=$value;
				}
				
			}
			
			//Add zero values to missing elements  
 			foreach($all_inc as $key=>$value){
				if(!array_key_exists($key, $refined_balbf)){
					$refined_balbf[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
				if(!array_key_exists($key, $all_exp)){
					$all_exp[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
			}
			
			foreach($all_exp as $key=>$value){
				if(!array_key_exists($key, $refined_balbf)){
					$refined_balbf[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
				if(!array_key_exists($key, $all_inc)){
					$all_inc[$key]=0;
					$unique_acc_as_rev[]=$key;
				}
			}
			
			//End Balance Array
			$end_bal=array();
			foreach($unique_acc_as_rev as $value){
				$opBal=0;
				$fndInc=0;
				$fndExp=0;
				if(isset($refined_balbf[$value])){
					$opBal=$refined_balbf[$value];
				}
				if(isset($all_inc[$value])){
					$fndInc=$all_inc[$value];
				}
				if(isset($all_exp[$value])){
					$fndExp=$all_exp[$value];
				}
				$bal=$opBal+$fndInc-$fndExp;
				$end_bal[$value]=$bal;
			}
		
			ksort($refined_balbf);
			
			
			/**
			 * Cash and Banks Balances
			 */
			
		//Opening Bank Balances		 //date("t/m/Y", strtotime("last month"));
		$bc_end_bal_cond = $this->_model->where(array(array("where","month",date('Y-m-d', strtotime('last day of previous month',strtotime($fullDate))),"="),array("AND","accNo","BC","="),array("AND","icpNo",$icpNo,"=")));
		$bc_end_bal=$this->_model->getAllRecords($bc_end_bal_cond,"cashbal");//Previous month Closing Bank Balance
		$bcBalBf=0;
		if(!empty($bc_end_bal)){
			$bcBalBf=$bc_end_bal[0]->amount;
		}
			
		
		//Opening PC Balances		
		$pc_end_bal_cond = $this->_model->where(array(array("where","month",date('Y-m-d', strtotime('last day of previous month',strtotime($fullDate))),"="),array("AND","accNo","PC","="),array("AND","icpNo",$icpNo,"=")));
		$pc_end_bal=$this->_model->getAllRecords($pc_end_bal_cond,"cashbal");//Previous month Closing Petty Cash Balance
		$pcBalBf=0;
		if(!empty($pc_end_bal)){
			$pcBalBf=$pc_end_bal[0]->amount;
		}
			
		
		//All Bank Incomes for the month
		$month_bank_inc_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_bank_inc=$this->_model->getAllRecords($month_bank_inc_cond,"voucher_body");
		$bank_inc=0;
		foreach ($month_bank_inc as $value) {
				$bank_inc+=$value->Cost;
		}
		
		//All Bank Expenses for the month
		$month_bank_exp_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_bank_exp=$this->_model->getAllRecords($month_bank_exp_cond,"voucher_body");
		$bank_exp=0;
		foreach ($month_bank_exp as $value) {
				$bank_exp+=$value->Cost;
			}
		
		//All PC Income for the month
		$month_pc_inc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_pc_inc=$this->_model->monthPcIncome($month_pc_inc_cond);
		$pc_inc=$month_pc_inc;
		
		//All PC Expenses for the month
		$month_pc_exp_cond = $this->_model->where(array(array("where","VType","PC","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_body.TDate)",$year,"="),array("AND","Month(voucher_body.TDate)",$month,"=")));
		$month_pc_exp=$this->_model->getAllRecords($month_pc_exp_cond,"voucher_body");
		$pc_exp=0;
		foreach ($month_pc_exp as $value) {
				$pc_exp+=$value->Cost;
			}
		
		//Bank and PC Closing Balances
		$close_bank_balance = 0;
		$close_pc_balance=0;
		//if($bank_exp!==0&&$pc_exp!==0){
			$close_bank_balance = $bcBalBf+$bank_inc-$bank_exp;
			$close_pc_balance=$pcBalBf+$pc_inc-$pc_exp;
		//}
		//$data['test']=$bcBalBf;
		//Deposit in Transit
		$month_dep_in_transit_cond = $this->_model->where(array(array("where","VType","CR","="),array("AND","icpNo",$icpNo,"="),array("AND","Year(voucher_header.TDate)",$year,"="),array("AND","Month(voucher_header.TDate)",$month,"="),array("AND","voucher_header.ChqState",0,"=")));
		$month_dep_in_transit=$this->_model->getAllRecords($month_dep_in_transit_cond,"voucher_header");
		
		//Oustanding Cheques
		//$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array("AND","voucher_header.ChqState",0,"=")));
		//$month_oc_cond = $this->_model->where(array(array("where","VType","CHQ","="),array("AND","icpNo",$icpNo,"="),array(array("AND","clrMonth","0000-00-00","="),array("OR","clrMonth",date('Y-m-t',$this->choice[1]),">"))));
		//$month_oc=$this->_model->getAllRecords($month_oc_cond,"voucher_header");
		$icpname=$icpNo;
		$curmonth = date('Y-m-t',$this->choice[1]);
		$month_oc = $this->_model->current_month_outstanding_cheques($icpname, $curmonth);
		
		//All Expense Accounts
		$exp_acc_cond = $this->_model->where(array(array("where","AccGrp",0,"="),array("AND","Active",1,"=")));
		$acc_details = $this->_model->getAllRecords($exp_acc_cond,"accounts");
		$accs=array();
		foreach ($acc_details as $value) {
				$accs[$value->AccNo]=array($value->AccText,$value->AccName,$value->prg);
			}
		
		//Months Expenses per Account
		$exp_per_acc=array();
		foreach($refined_acc as $key=>$value){
			if($key<100||$key>1000&&$key<2000){
				$exp_per_acc[$key]=$value;
			}
		}
		
		//Maximum Transaction ID
		//$month_by_num = array(7,8,9,10,11,12,1,2,3,4,5,6);
		$maxID_cond=$this->_model->where(array(array("where","Month(TDate)",$month,"<="),array("AND","Year(TDate)",$year,"=")));
		$maxID = $this->_model->getMaxVoucherID($maxID_cond);
		
		//Expenses to date
		$year_todate_exp_cond=$this->_model->where(array(array("where","voucher_header.icpNo",$icpNo,"="),array("AND","voucher_header.Fy",Resources::func("get_financial_year",array($fullDate)),"="),array("AND","voucher_body.bID",$maxID,"<=")));	
		$year_todate_exp=$this->_model->get_todate_expenses($year_todate_exp_cond);
		$exp_to_date=array();
		foreach($year_todate_exp as $value){
			$key=$value->AccNo;
			if($key<100||$key>1000&&$key<2000){
				$exp_to_date[$key]=$value->Cost;
			}
		}
		
		
		//Accounts Details and Expense Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $exp_per_acc)){
				$accs[$key]['Exp']=$exp_per_acc[$key];
			}else{
				$accs[$key]['Exp']=0;	
			}
		}
		
		//Accounts Details and Expenses to Date Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $exp_to_date)){
				$accs[$key]['ExpToDate']=$exp_to_date[$key];
			}else{
				$accs[$key]['ExpToDate']=0;
			}
			
		}
		
		//Budget To Date
		//$todate_budget_cond=$this->_model->where(array(array("where","planheader.icpNo",$icpNo,"="),array("AND","planheader.fy",Resources::func("get_financial_year",array($fullDate)),"="),array("AND","plansshedule.approved",2,"=")));
		$todate_budget_cond=$this->_model->where(array(array("where","planheader.icpNo",$icpNo,"="),array("AND","planheader.fy",Resources::func("get_financial_year",array($fullDate)),"=")));
		$todate_budget = $this->_model->get_todate_budget($todate_budget_cond,date("n",strtotime($fullDate)));
		$budget_to_date=array();
		foreach($todate_budget as $value){
			$budget_to_date[$value->AccNo]=$value->Cost;
		}
		
		//Accounts Details and Budget to Date Records
		foreach($accs as $key=>$value){
			if(array_key_exists($key, $budget_to_date)){
				$accs[$key]['BudToDate']=$budget_to_date[$key];
			}else{
				$accs[$key]['BudToDate']=0;
			}
			
		}
		
		//Account Details and Variance Records
		foreach($accs as $key=>$value){
			$accs[$key]['var']=$accs[$key]['BudToDate']-$accs[$key]['ExpToDate'];
			if($accs[$key]['BudToDate']>0){	
				$accs[$key]['varPer']=($accs[$key]['var']/$accs[$key]['BudToDate'])*100;//@
			}else{
				$accs[$key]['varPer']=0;
			}
		}
			
		//Find Variance Explanation Statements
		$variance_explanation_cond=$this->_model->where(array(array("where","reportMonth",date("Y-m-t",strtotime($fullDate)),"="),array("AND","icpNo",$icpNo,"=")));
		$variance_explanation=$this->_model->getAllRecords($variance_explanation_cond,"varjustify");
		$varJustify=array();
		foreach($variance_explanation as $value){
			$varJustify[$value->AccNo]=$value->Details;
		}
		
		//Variance -/+ 10%
		$var_to_explain=array();
		foreach($accs as $key=>$value){	
				if($value['varPer']>10 || $value['varPer']<-10){
					if(count($varJustify)>0&&array_key_exists($key, $varJustify)){
						$value['notes']=$varJustify[$key];
					}else{
						$value['notes']="";
					}
					$var_to_explain[$key]=$value;
				}
		}
		
		//Monthly Parameters -- Begin
		$param=array();
			//Calculate AFC	
			$afc=0;
			if($all_inc[100]>0){
				$afc=($end_bal[100]/$all_inc[100]);//@
			}
				
			
			//Calculate Budget Variance
			$sum_var = 0;
			foreach($accs as $key=>$value){
				if($key<100){
					$sum_var+=$value['var'];	
				}
				
			}
			$sum_bud_to_date=0;
			foreach ($accs as $value) {
				$sum_bud_to_date+=$value['BudToDate'];
			}
		$obv=0;
		if($sum_bud_to_date>0){
			$obv=($sum_var/$sum_bud_to_date)*100;	//@
		}
		
		//Calculate Survival Ratio
		$sum_500_inc=0;
		foreach($all_inc as $key=>$value){
			if($key>500&&$key<600){
				$sum_500_inc+=$all_inc[$key];
			}
		}
		$sr=0;
		if($all_inc[100]>0){
			$sr = ($sum_500_inc/$all_inc[100])*100;	//@
		}
		
		
		//Calculate Operating Ratio
		$sum_admin_exp =0;
		foreach($accs as $key=>$value){
			if($key===65||$key===70||$key===74||$key===75||$key===86||$key===87||$key===88){
				$sum_admin_exp+=$value['ExpToDate'];
			}
		}
		$or=0;
		if($all_exp[100]>0){
			$or=($sum_admin_exp/$all_exp[100])*100;//@
		}
		
		$r=1;
		//$fundVal = array_sum($end_bal)-($close_bank_balance+$close_pc_balance);
		//if($fundVal==='0'){
			//$r=1;
		//}
		//totalCash-close_fund_balance=0
		//reconBank-closeBankBal=0
		
		$param=array();		
		$param['afc']=$afc;
		$param['obv']=$obv;
		$param['sr']=$sr;
		$param['pcb']=$close_pc_balance;
		$param['or']=$or;
		$param['r']=$r;
		//Monthly Parameters -- End
		
		
		//Reconstruct Outstanding Array
		$reconstruct_oc =array();
				//Add Current voucher_body Cheques to reconstruct_oc array
				$cnt=0;
				foreach($month_oc as $value){
					$reconstruct_oc[$cnt]['rId']=$value->hID;
					$reconstruct_oc[$cnt]['ChqNo']=$value->ChqNo;
					$reconstruct_oc[$cnt]['TDate']=$value->TDate;
					$reconstruct_oc[$cnt]['VNumber']=$value->VNumber;
					$reconstruct_oc[$cnt]['Details']=$value->TDescription;
					$reconstruct_oc[$cnt]['Amount']=$value->totals;
					$reconstruct_oc[$cnt]['source']=2;
					$cnt++;
				}
				
				//Add B/F Cheques to reconstruct_oc array
				
				$icpname=$icpNo;
				$curmonth = date('Y-m-t',$this->choice[1]);
				$bf_oc = $this->_model->outstanding_cheques_bf($icpname, $curmonth);
				
				//$bf_oc_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","chqState",0,"=")));
				//$bf_oc = $this->_model->getAllRecords($bf_oc_cond,"oschqbf");
				$cnt=count($reconstruct_oc);
				foreach($bf_oc as $value){
					$reconstruct_oc[$cnt]['rId']=$value->osBfID;
					$reconstruct_oc[$cnt]['ChqNo']=$value->chqNo;
					$reconstruct_oc[$cnt]['TDate']=$value->chqDate;
					$reconstruct_oc[$cnt]['VNumber']=$value->VNumber;
					$reconstruct_oc[$cnt]['Details']=$value->Details;
					$reconstruct_oc[$cnt]['Amount']=$value->amount;
					$reconstruct_oc[$cnt]['source']=1;
					$cnt++;
				}
		
		
		
		//Reconstruct Deposit in Transit
		$reconstruct_dep_in_transit =array();
				//Add Current voucher_body Cash Received to reconstruct_oc array
				$ct=0;
				foreach($month_dep_in_transit as $value){
					$reconstruct_dep_in_transit[$ct]['rId']=$value->hID;
					$reconstruct_dep_in_transit[$ct]['ChqNo']=$value->ChqNo;
					$reconstruct_dep_in_transit[$ct]['TDate']=$value->TDate;
					$reconstruct_dep_in_transit[$ct]['VNumber']=$value->VNumber;
					$reconstruct_dep_in_transit[$ct]['Details']=$value->TDescription;
					$reconstruct_dep_in_transit[$ct]['Amount']=$value->totals;
					$reconstruct_dep_in_transit[$ct]['source']=2;
					$ct++;
				}
				
				//Add B/F Cash Received to reconstruct_oc array
				$bf_dep_in_transit_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","TState",0,"=")));
				$bf_dep_in_transit = $this->_model->getAllRecords($bf_dep_in_transit_cond,"transitfundsbf");
				$ct=count($reconstruct_dep_in_transit);
				foreach($bf_dep_in_transit as $value){
					$reconstruct_dep_in_transit[$ct]['rId']=$value->transitBfID;
					$reconstruct_dep_in_transit[$ct]['TDate']=$value->TDate;
					$reconstruct_dep_in_transit[$ct]['VNumber']=$value->VNumber;
					$reconstruct_dep_in_transit[$ct]['Details']=$value->Details;
					$reconstruct_dep_in_transit[$ct]['Amount']=$value->amount;
					$reconstruct_dep_in_transit[$ct]['source']=1;
					$ct++;
				}		
		
		//MFR State
		//$chk_end_bal_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",$icpNo,"="),array("AND","opfundsbalheader.closureDate",date('Y-m-t',strtotime($fullDate)),"=")));            
		//$chk_end_bal_qry = $this->_model->balFundsBf($chk_end_bal_cond);// Used to calculate submit state
		$chk_state_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","closureDate",date('Y-m-t',strtotime($fullDate)),"="))); 
		$chk_state=$this->_model->getAllRecords($chk_state_cond,"opfundsbalheader");
		
		$cnt_close_funds_bal_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
		$cnt_close_funds_bal=$this->_model->getAllRecords($cnt_close_funds_bal_cond,"opfundsbalheader");
		
		$cnt_close_funds=count($cnt_close_funds_bal);
		
		$state=0;
		$mfrClosureFundsID=0;
		$sysOpen=0;
		$closureMonth='';
		if(empty($chk_state)){
            	$state = 0;
         }elseif($chk_state[0]->allowEdit==='1'){
            	$state=1;
				$mfrClosureFundsID=$chk_state[0]->balHdID;
				$sysOpen = $chk_state[0]->systemOpening;
				$closureMonth = date("m",strtotime($chk_state[0]->closureDate));
         }else{
         		$state=2;
				$mfrClosureFundsID=$chk_state[0]->balHdID;
				$sysOpen = $chk_state[0]->systemOpening;
				$closureMonth = date("m",strtotime($chk_state[0]->closureDate));
         }
		 
		 
				
		//Find Bank Statement Date
		$bs_date_check_cond = $this->_model->where(array(array("where","month",date("Y-m-t",strtotime($fullDate)),"="),array("AND","icpNo",$icpNo,"=")));		
		$bs_date_check=$this->_model->getAllRecords($bs_date_check_cond,"statementbal");
		$statementDate = "";
		$statementAmount=0;
		if($state!==0&&!empty($bs_date_check)){
			$statementDate=$bs_date_check[0]->statementDate;
			$statementAmount=$bs_date_check[0]->amount;
			
		}
		
		//Get Bank Statement File Name
		$getBs = $this->_model->getAllRecords($bs_date_check_cond,"bssubmitted");
		
		//Get MFR Notes
		
		$notes_cond = $this->_model->where(array(array("WHERE","period",date('Y-m-t',$this->choice[1]),"="),array("AND","noteto",$icpNo,"=")));
		$notes_arr = $this->_model->getAllRecords($notes_cond,"mfrnotes","ORDER BY noteID DESC");
		
		//$data=array();
		//if($sysOpen==='0'||$cnt_close_funds<=1&&date('m',strtotime($fullDate))!==$closureMonth){
		$data['balbf'] = $refined_balbf;
		$data['inc']=$all_inc;
		$data['exp']=$all_exp;
		$data['bal']=$end_bal;
		$data['bank']=$close_bank_balance;
		$data['pc']=$close_pc_balance;
		$data['transit']=$reconstruct_dep_in_transit;
		$data['oc']=$reconstruct_oc;
		$data['expenses']=$accs;
		$data['varExplain']=$var_to_explain;
		$data['param']=$param;
		$data['state']=$state;
		$data['stateID']=$mfrClosureFundsID;
		$data['statementDate']=$statementDate;
		$data['statementAmount']=$statementAmount;
		$data['varJustify']=$varJustify;
		$data['time']=$this->choice[1];
		$data['getBs']=$getBs;
		$data['icp']=$icpNo;
		$data['notes']=$notes_arr;
		$data['test']="";
		//}		
		
		return $data;
    		
    }

public function attachBs($cst,$icpNo,$month,$fy,$sbDate){
  		$cname = $cst;//filter_input(INPUT_POST,"clst");
       	$icpNo = $icpNo;//filter_input(INPUT_POST,"pNo");
       	$month = $month;//filter_input(INPUT_POST,"childNo");
       	$fy = $fy;//filter_input(INPUT_POST,"rec");
       
       if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname)){
        mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname);
        if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname.DS.$icpNo)){
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname.DS.$icpNo);
        }
        }elseif(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname.DS.$icpNo)) {
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname.DS.$icpNo);
        }
       
       $target_dir = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cname.DS.$icpNo.DS;
       //$randNo = rand(1,99999);
       $newfilename = $icpNo."_".$month."_".$fy;
       $target_dir = $target_dir . $newfilename.".pdf"; 

        if (move_uploaded_file($_FILES["fileBs"]["tmp_name"], $target_dir)) {
                //echo $this->_model->uploadReceipt($randNo,$rec,$newfilename);
                $bs_arr = array();
                $bs_arr['bsKeys']=$newfilename;
               	$bs_arr['icpNo']=$icpNo;
				$bs_arr['month']=$sbDate;
				$this->_model->insertRecord($bs_arr,"bssubmitted");
				
        } else {
            $data['error']= "Upload Error!";
        }
}
    public function viewBs(){
        $bsKey = $_POST['bsKey'].".pdf";
        $cst=$_POST['clst'];
        $icpNo = $_POST['icp'];

        $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."finance".DS."bankstatements".DS.$cst.DS.$icpNo.DS.$bsKey;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
    }


public function submitMfr(){
    	 /**
		 * ICP should not close a report:
		 * a) Before the end of the month
		 * b) Where there is no previous report closure
		 * c) Bank reconciliation is incorrect
		 */
		 $file=$_FILES['fileBs']['tmp_name'];
		 //$_POST['file']=$file;
		
		$cond_last_mfr=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
		$maxMfrDate = $this->_model->maxMfrDate($cond_last_mfr);
		$curClosuredate=date("Y-m-t",strtotime("+1 month",strtotime(date("Y-m-01",strtotime($maxMfrDate)))));
		//print($curClosuredate);
		if(strtotime($curClosuredate)>strtotime($_POST['curDate'])){
				print("Reporting dealine is not yet!");
		}elseif(strtotime($curClosuredate)<strtotime($_POST['curDate'])){
				print("You have previous unsubmitted report(s) or missing funds closing balances for the previous month!");
		//}elseif(date("d")==="06"&&!Resources::session()->userlevel_backup===1){
			//	print("Submission time elapsed!");
		}else{
			//Fund Balance Header
			$balHd=array();
	    	$balHd['icpNo']=Resources::session()->fname;
			$balHd['totalBal']=array_sum($_POST['endFunds']);
			$balHd['closureDate']=$curClosuredate;
			$balHd['allowEdit']=1;
			$balHd['systemOpening']=0;
			$this->_model->insertRecord($balHd,"opfundsbalheader");
			
			//Fund Balance Body
			$balHdID= $this->_model->maxMfrID($cond_last_mfr);
			$funds_body = array();
			foreach ($_POST['endFunds'] as $key => $value) {
				$funds_body['balHdID'][]=$balHdID;
				$funds_body['funds'][]=$key;
				$funds_body['amount'][]=$value;
				//$this->_model->insertRecord($funds_body,"opfundsbal");
			}
			$this->_model->insertArray($funds_body,"opfundsbal");
			
			//Closing Cash Balance
			$closeCashBal = array();
			$closeCashBal['month'][]=date("Y-m-t",strtotime($_POST['curDate']));
			$closeCashBal['month'][]=date("Y-m-t",strtotime($_POST['curDate']));
			$closeCashBal['icpNo'][]=Resources::session()->fname;
			$closeCashBal['icpNo'][]=Resources::session()->fname;
			$closeCashBal['AccNo'][]="BC";
			$closeCashBal['AccNo'][]="PC";
			$closeCashBal['amount'][]=$_POST['bankTxt'];
			$closeCashBal['amount'][]=$_POST['pcbTxt'];
			$this->model->insertArray($closeCashBal,"cashbal");
			
			//Closing Statement Record
			$closeBs=array();
			$closeBs['month']=date("Y-m-t",strtotime($_POST['curDate']));
			$closeBs['statementDate']=$_POST['statementDate'];
			$closeBs['icpNo']=Resources::session()->fname;
			$closeBs['amount']=$_POST['statementAmount'];
			$this->_model->insertRecord($closeBs,"statementbal");
			
			//Variance Explanation Records
			$varianceExplain =array();
			foreach($_POST['explain'] as $key=>$value){
				$varianceExplain['icpNo'][]=Resources::session()->fname;
				$varianceExplain['AccNo'][]=$key;
				$varianceExplain['Details'][]=$_POST['explain'][$key];
				$varianceExplain['reportMonth'][]=date("Y-m-t",strtotime($_POST['curDate']));
			}
			$this->_model->insertArray($varianceExplain,"varjustify");
			$this->attachBs(Resources::session()->cname, Resources::session()->fname,date("m",strtotime($_POST['curDate'])), Resources::func("get_financial_year",array(date("Y-m-t",strtotime($_POST['curDate'])))),date("Y-m-t",strtotime($_POST['curDate'])));
			
			//Mail Voucher to PF
			$pf_email_cond=$this->_model->where(array(array("where","cname",Resources::session()->cname,"="),array("AND","userlevel","2","=")));
			$pf_email_arr = $this->_model->getAllRecords($pf_email_cond,"users");
			$pf_email="";
			if(count($pf_email_arr)!==0){
				$pf_email = $pf_email_arr[0]->email;
			}else{
				$pf_email="NKarisa@ke.ci.org";
			}
			
			$title = "MFR submission notification";
			$body =Resources::session()->fname." has submitted ".date('F-Y',strtotime($curClosuredate))." MFR";
			
			Resources::mailing($pf_email, $title, $body); 
			
			print("Report submitted Successfully!");
			
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
		$handle = fopen($file,"r");
	  	$rec=array();
		$recNums=0;
		if($lists === 'fundsSchedules'){
			while($data = fgetcsv($handle,1000,",","'")){
				$recNums++;
				$rec['KENumber']=$data[0];
				$rec['AccountCode']=$data[1];
				$rec['AccountDescription']=$data[2];
				$rec['civCode']=$data[3];
				$rec['Amount']=$data[4];
				$rec['Month']=$data[5];
				$this->_model->insertRecord($rec,"fundsschedule");
			}
			echo $recNums." records uploaded successfully";
		}elseif($lists === 'specialgifts'){
			while($data = fgetcsv($handle,1000,",","'")){
				$recNums++;
				$rec['KENumber']=$data[0];
				$rec['ChildNumber']=$data[1];
				$rec['Amount']=$data[2];
				$rec['Instructions']=$data[3];
				$rec['Month']=$data[4];
				$this->_model->insertRecord($rec,"specialgifts");
			}
			echo $recNums." records uploaded successfully";			
		}
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
    		$cond = $this->_model->where(array(array("where","Month",date('Y-m-01',strtotime('last day of previous month')),"=")));
			$qry = $this->_model->getAllRecords($cond,"fundsschedule","LIMIT 0,10");
    		$this->dispatch($render=1,'fundsCategories',$qry,array("2","3"));
    	}
                    
    }

    public function fundsUpload($render=1,$path='',$tags=array("3")){
    	
           
    }

    public function viewSlip(){
    	$icp=Resources::session()->fname;
    	if(isset($this->choice[3])){
    		$icp=$this->choice[3];
    	}
    	if(isset($this->choice[1])){
    		$funds_cond = $this->_model->where(array(array("where","KENumber",$icp,"="),array("AND","Month",date('Y-m-01',$this->choice[1]),"=")));
            $data[] = $this->_model->getAllRecords($funds_cond,"fundsschedule");
			$data[]=$this->choice[1];		
			$this->dispatch($render=2,"",$data,array("All"));
		}else{
            $funds_cond = $this->_model->where(array(array("where","KENumber",$icp,"="),array("AND","Month",date('Y-m-01'),"=")));
            $data[] = $this->_model->getAllRecords($funds_cond,"fundsschedule");
			//$data[]=0;
			$this->dispatch($render=1,"",$data,array("All"));
		}	
            //return $data; 

    }

    public function chqIntel(){
        //$icp = $_SESSION['fname'];
		$icp=Resources::session()->fname;
        $chq = $this->choice[1];
		
		//Get Bank Bank Code
		$bank_code=0;
		$bank_code_cond = $this->_model->where(array(array("where","icpNo",$icp,"=")));
		$bank_code_qry=$this->_model->getAllRecords($bank_code_cond,"projectsdetails");
		if(count($bank_code_qry)>0){
			$bank_code=$bank_code_qry[0]->bankID;
		}
			
        $rs = $this->_model->chqIntel($icp,$chq,$bank_code);
        if($rs>0){
            echo "The cheque number ".$chq." has already been used!";
        }  //else {
            //echo "You have skipped some cheques!";
        //}
    }
	public function approveSchedule(){
		$rid=$this->choice[1];
		//print($rid);
		$set = array("approved"=>2);
		$cond = $this->_model->where(array(array("where","scheduleID",$rid,"=")));
		echo $this->_model->updateQuery($set,$cond,"plansschedule");
	}
	public function reverseApproval(){
		$rid=$this->choice[1];
		//print($rid);
		$set = array("approved"=>1);
		$cond = $this->_model->where(array(array("where","scheduleID",$rid,"=")));
		echo $this->_model->updateQuery($set,$cond,"plansschedule");		
	}
    public function downloadVoucher($render=1,$path='',$tags=array("1")){
    	$VNum=  $this->choice[1];
	        if($_SESSION['userlevel']==="1"){
	            $icpNo = $_SESSION['fname'];
	        }  elseif ($_SESSION['userlevel']==="2") {
	            $icpNo = $_SESSION['fname_backup'];
	        }  else {
	            
	        }
   		return $this->_model->showVoucher($VNum,$icpNo);
    }
	
	public function postFootNote(){
		$VNum=$_POST['VNumber'];
		$icpNo=$_POST['icpNo'];
		
		$hid_cond = $this->_model->where(array(array("where","VNumber",$VNum,"="),array("AND","icpNo",$icpNo,"=")));
		$hid_arr = $this->_model->getAllRecords($hid_cond,"voucher_header");
		$hid = $hid_arr[0]->hID;
		$tDate = $hid_arr[0]->TDate;
		
		$_POST['hID']=$hid;
		$_POST['VDate']=$tDate;
		
		$this->_model->insertRecord($_POST,"voucherfootnotes");
		
		$footnote_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","VNumber",$VNum,"=")));
		$footnote_arr = $this->_model->getAllRecords($footnote_cond,"voucherfootnotes"," ORDER BY footnoteID DESC");
		
		//Mail a notification
		$icp_mail_cond = $this->_model->where(array(array("WHERE","username",$icpNo,"=")));
		$icp_mail_arr=$this->_model->getAllRecords($icp_mail_cond,"users","",array("email"));
		$email = $icp_mail_arr[0]->email;
		 
		$title = "Voucher #{$VNum} Notification ";
		$body = "You a notification from {$_POST['msg_from']}:\n\n {$_POST['msg']}";
		 
		Resources::mailing($email, $title, $body); 
		
		$data['details']=$this->_model->showVoucher($VNum,$icpNo);
		$data['footnotes']=$footnote_arr;
		
		$this->dispatch($render=2,$path='',$data,$tags=array("All"));
	}
	
public function postVoucher(){
        $header = array();
        for($i=0;$i<8;$i++){
            $header[]=  array_shift($_POST);
        }
        $header[]=array_pop($_POST);
        $fy = Resources::func("get_financial_year",array(date("Y-m-d")));
        $tm = time();
        $chqState =0;
        
		//Get Bank Bank Code
		$bank_code=0;
		$bank_code_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
		$bank_code_qry=$this->_model->getAllRecords($bank_code_cond,"projectsdetails","",array("bankID"));
		if(count($bank_code_qry)>0){
			$bank_code=$bank_code_qry[0]->bankID;
		}
			
		
		$rwChqNo=$header[6];
		if($rwChqNo===""){
			$header[6]="";
		}else{
			$header[6]=ltrim($rwChqNo,'0')."-".$bank_code;
		}
			
		
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
        $hID_rst = $this->_model->getAllRecords($hID_cond,"voucher_header","",array("hID"));
		
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
                    
        //Mail Voucher to PF
		$pf_email_cond=$this->_model->where(array(array("where","cname",Resources::session()->cname,"="),array("AND","userlevel","2","=")));
		$pf_email_arr = $this->_model->getAllRecords($pf_email_cond,"users","",array("email"));
		$pf_email="";
		if(count($pf_email_arr)!==0){
			$pf_email = $pf_email_arr[0]->email;
		}else{
			$pf_email="NKarisa@ke.ci.org";
		}
			
	
		
		//Mail Body
		$body = "<b>Voucher Number:</b>".$qry_array['VNumber']."<br>";
		$body.= "<b>Total Amount:</b>".$qry_array['totals']."<br>";
		$body.="<b>Voucher Type:</b>".$qry_array['VType']."<br>";
		$body.="<b>Description:</b>".$qry_array['TDescription']."<br>";
		$body.="<b>Posting Date and Time:</b>".date('Y-m-d H:i:s',strtotime('+9 hours',$qry_array['unixStmp']))."<br>";
		$body.="<b>Transaction Date:</b>".$qry_array['TDate']."<br>";
		$body.="<b>Posted By:</b>".Resources::session()->username."<br>";
		
		
		//Mail Header
		
		$title = $qry_array['icpNo']." Voucher Posting: V# ".$qry_array['VNumber'];
		
		Resources::mailing($pf_email, $title, $body); 
		
		//$action = "Posted voucher Number ".$qry_array['VNumber'];
		//user_history($userid,$langid,$lang="eng",$actionParam=array())
		Resources::user_history(Resources::session()->ID,"post_voucher",$lang="eng",$action=array("VNumber"=>$qry_array['VNumber']));
		
    }
    public function showVoucher($render=1,$path="",$tags=array("All")){       
        $VNum=  $this->choice[1];
        if($_SESSION['userlevel']==="1"){
            $icpNo = $_SESSION['fname'];
        }  else {
            $icpNo = $_SESSION['fname_backup'];
        }  
        
		$footnote_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","VNumber",$VNum,"=")));
		$footnote_arr = $this->_model->getAllRecords($footnote_cond,"voucherfootnotes"," ORDER BY footnoteID DESC");
		
		$data['details']=$this->_model->showVoucher($VNum,$icpNo);
		$data['footnotes']=$footnote_arr;
		
        return $data;

    }
public function showVoucherFromExternalSource($render=1,$path="showVoucher",$tags=array("All")){       
        $VNum=  $this->choice[1];
         $icpNo = $this->choice[3]; 
        
		$footnote_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","VNumber",$VNum,"=")));
		$footnote_arr = $this->_model->getAllRecords($footnote_cond,"voucherfootnotes"," ORDER BY footnoteID DESC");
		
		$data['details']=$this->_model->showVoucher($VNum,$icpNo);
		$data['footnotes']=$footnote_arr;
		
        return $data;

}
public function previewvoucher($render=2,$path="showVoucher",$tags=array("All")){       
        $VNum=  $_POST['VNumber'];
        $icpNo = Resources::session()->fname;
        
        //$VNum = '150702';
		//$icpNo = 'KE903';
        
		$footnote_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"="),array("AND","VNumber",$VNum,"=")));
		$footnote_arr = $this->_model->getAllRecords($footnote_cond,"voucherfootnotes"," ORDER BY footnoteID DESC");
		
		$data['details']=$this->_model->showVoucher($VNum,$icpNo);
		$data['footnotes']=$footnote_arr;
		
        return $data;

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
public function civ($render=1,$path='',$tags=array("All")){
		$civa = array();   
		
		$status='1';
		if(isset($this->choice[1])){
			$status=$this->choice[1];
		}
		
		$cname = Resources::session()->cname;
		$icps_cond = $this->_model->where(array(array("WHERE","cname",$cname,"="),array("AND","department",0,"="),array("AND","userlevel",1,"=")));
		$icps_arr = $this->_model->getAllRecords($icps_cond,"users","",array("fname"));
		$refined_icps_arr = array();
		foreach ($icps_arr as $value) {
			$refined_icps_arr[]=$value->fname;
		}
		
        $civa_cond = $this->_model->where(array(array("where","civa.open",$status,"="),array("AND","accounts.AccGrp","0","=")));
        $civa['rec'] = $this->_model->civaExpenseAccounts($civa_cond);
		$civa['icps']=$refined_icps_arr;
        return $civa;
}
public function AddCIVA($render=1,$path='',$tags=array("All")){
		$data=array();
       	
		//CIV Grants Group Accounts
	    $civa_acc_arr = $this->_model->getcivaaccounts();
		
		//Get CIVs From Funds Disbursement
		$disbursed_civs_cond = $this->_model->where(array(array("where","fundsschedule.civCode"," ","<>"))); 
		$disbursed_civs_arr = $this->_model->getAllRecords($disbursed_civs_cond,"fundsschedule","GROUP BY fundsschedule.civCode",array("civCode"));
	    
		//Find Existing CIV Accounts Codes
		$existing_acc_arr=array();
		$existing_acc_arr_raw = $this->_model->getAllRecords("","civa","GROUP BY AccNoCIVA",array("AccTextCIVA"));
		foreach ($existing_acc_arr_raw as $value) {
			$existing_acc_arr[]=trim($value->AccTextCIVA);
		}
		
		//Refine Funds Disbursed Codes Array
		$final_codes_arr=array();
		foreach ($disbursed_civs_arr as $value) {
			if(!in_array(trim($value->civCode), $existing_acc_arr)){
				$final_codes_arr[]=$value->civCode;
			}
		}
		
		$data['test']="";
		$data['civaAc']=$civa_acc_arr;
		$data['disbursedAc']=$final_codes_arr;
		
		return $data;
}
public function getCivAllocatedIcps(){
	//echo "Kudos";
	$civCode = $_POST['civCode'];
	
	//Get Allocated ICPs
	$alloc_icps_cond = $this->_model->where(array(array("where","civCode",$civCode,"=")));
	$alloc_icps_arr = $this->_model->getAllRecords($alloc_icps_cond,"fundsschedule","",array("KENumber"));
	
	$icps =array();
	foreach ($alloc_icps_arr as $value) {
		$icps[]=$value->KENumber;
	}
	
	echo implode(",", $icps);
}
public function createCivAccount(){
	//Create an Income Account	
	$this->_model->insertRecord($_POST,"civa");
	
	//Create an Expense Account
		//=>Get Expense Group
		$exp_group_cond = $this->_model->where(array(array("WHERE","accID",$_POST['accID'],"=")));
		$exp_group_arr = $this->_model->getAllRecords($exp_group_cond,"accounts","",array("AccNo"));
		//=>Expense Account
		$exp_group_acc = (integer)$exp_group_arr[0]->AccNo+1000;
		//=>Expense Account ID
		$exp_accID_cond = $this->_model->where(array(array("WHERE","AccNo",$exp_group_acc,"=")));
		$exp_accID_arr = $this->_model->getAllRecords($exp_accID_cond,"accounts","",array("accID"));
		$exp_accID = $exp_accID_arr[0]->accID;
		//=>Expense Array
		$exp_arr=array();
		$exp_arr['accID']=$exp_accID;
		$exp_arr['AccNoCIVA']=$_POST['AccNoCIVA'];
		$exp_arr['AccTextCIVA']=$_POST['AccTextCIVA'];
		$exp_arr['allocate']=$_POST['allocate'];
		$exp_arr['closureDate']=$_POST['closureDate'];
		
		$this->_model->insertRecord($exp_arr,"civa");
		
	echo "Account(s) for {$_POST['allocate']} Created Successfully for {$_POST['AccNoCIVA']}";
}
public function manageCivDate(){
	$flag = $_POST['flag'];
	$AccNo = $_POST['AccNoCIVA'];
	
	$final_flag="";
	if($flag==='1'){
		$final_flag='0';
	}else{
		$final_flag='1';	
	}
	
	//echo $civID;
	$set_civ_update = array("open"=>$final_flag);
	$update_cond = $this->_model->where(array(array("WHERE","AccNoCIVA",$AccNo,"=")));
	
	$this->_model->updateQuery($set_civ_update,$update_cond,"civa");
	
	echo "Account Updated successfully";
	
}
public function viewicpcivacounts($render=2,$path='',$tags=array("All")){
	$data=array();
	$civaID=$_POST['civaID'];
	$AccText = $_POST['AccTextCIVA'];
	
	$cname = Resources::session()->cname;
	$icps_cond = $this->_model->where(array(array("WHERE","cname",$cname,"="),array("AND","department",0,"="),array("AND","userlevel",1,"=")));
	$icps_arr = $this->_model->getAllRecords($icps_cond,"users","",array("fname"));
	$refined_icps_arr = array();
	foreach ($icps_arr as $value) {
		$refined_icps_arr[]=$value->fname;
	}	
	
	$civRs = $this->_model->calcIcpCivAccounts($civaID,$AccText);
	
	$data['icpAc'] = $civRs;
	$data['cap']=$AccText;
	$data['icps']=$refined_icps_arr;
	
	return $data; 
}
public function showcivimpbreakdown($render=2,$path='',$tags=array("All")){
	$data=array();
	$icpNo = $_POST['icpNo'];
	$civaID=$_POST['civaID'];
	$AccText = $_POST['AccTextCIVA'];
	
	$civimp=$this->_model->icpcivimpbreakdown($icpNo,$civaID,$AccText);
	
	$data['imp']=$civimp;
	$data['cap']=$AccText;
	$data['icp']=$icpNo;
	
	return $data;
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
public function reviewcivclosuredate(){
	$AccNoCIVA = $_POST['AccNoCIVA'];
	$closureDate = $_POST['closureDate'];
	$review_cond = $this->_model->where(array(array("WHERE","AccNoCIVA",$AccNoCIVA,"=")));
	$review_set = array("closuredate"=>$closureDate);
	
	$this->_model->updateQuery($review_set,$review_cond,"civa");
	
	echo "Date review successful";
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
	$cond = $this->_model->where(array(array("where","icpNo",$_POST['icpNo'],"="),array("AND","allowEdit","1","=")));
	$qry = $this->_model->getAllRecords($cond,"opfundsbalheader");
	
	$cond_two = $this->_model->where(array(array("where","icpNo",$_POST['icpNo'],"=")));
	$qry_two = $this->_model->getAllRecords($cond_two,"opfundsbalheader");
		
	if(count($qry)===0&&count($qry_two)>0){
		print("You are not allowed to edit this record!");	
	}else{
		//if(date('t',strtotime($_POST['closureDate']))===$day){
		//	print("Choose the last day of the month as the close date.");
		//}else{
		    $header_arr['closureDate']=$_POST['closureDate'];
		    $header_arr['icpNo']=$_POST['icpNo'];
		    $header_arr['totalBal']=$_POST['totalBal'];
		    $header_arr['systemOpening']="1";
		    $bal_chk_cond = $this->_model->where(array(array("where","icpNo",$_POST['icpNo'],"="),array("AND","systemOpening","1","=")));
		    $bal_chk = $this->_model->getAllRecords($bal_chk_cond,"opfundsbalheader");
		 
		    if(count($bal_chk)>0){
		        $balID = $bal_chk[0]->balHdID;
		        $id_cond = $this->_model->where(array(array("where","balHdID",$balID,"=")));
		        $this->_model->deleteQuery($bal_chk_cond,"opfundsbalheader");
		        $this->_model->deleteQuery($id_cond,"opfundsbal");
		    }
		    $cur_icp_num=array_shift($_POST);
		    array_shift($_POST);
			array_shift($_POST);
		    $this->_model->insertRecord($header_arr,"opfundsbalheader");
		    
		    $new_bal_chk_cond = $this->_model->where(array(array("where","icpNo",$cur_icp_num,"=")));
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
	//$icpNo = $_POST['icpNo'];
	
	$icp=array_shift($_POST);
	$rw_arr = $_POST;
	$icpNo=array();
	for($i=0;$i<sizeof($_POST['chqNo']);$i++){
		$icpNo[]=$icp;
	}
	$rw_arr['icpNo']=$icpNo;
	//print_r($rw_arr);
       
	    $chks_cond = $this->_model->where(array(array("where","icpNo",$icp,"=")));
        $chks = $this->_model->getAllRecords($chks_cond,"oschqbf"); 
        if(count($chks)>0){
            $this->_model->deleteQuery($chks_cond,"oschqbf");
        }
        echo $this->_model->insertArray($rw_arr,"oschqbf");
	   
    
}
public function viewBal($render=2,$path="",$tags=array("All")){
	$data=array();
	$cond = "";//$this->_model->where(array(array("where","opfundsbalheader.icpNo",Resources::session()->fname,"=")));
	$qry = $this->_model->viewFundsBal($cond);
	
	//ICP
	$icp_arr=array();
	foreach ($qry as $value) {
		$icp_arr[$value->icpNo][]=$value;
	}
	
	$data['allBal']=$qry;
	$data['mixed_arr']=$icp_arr;
	
	return $data;
}
public function cashBalBf($render=1,$path="",$tags=array("1")){   
      
}

public function addCash(){
	$day = date("t",strtotime($_POST['cjCashOpBal']));	
	
	$cond = $this->_model->where(array(array("where","month",$_POST['cjCashOpBal'],"="),array("AND","icpNo",$_POST['icpNo'],"=")));
	$qry = $this->_model->getAllRecords($cond,"cashbal");
	$cnt = count($qry);
	if($cnt===0){
		if(date("j",strtotime($_POST['cjCashOpBal']))===$day){
			$size = count($_POST['cashBal']);
			$accNos =array("BC","PC");
			$arr=array();
			for ($i=0; $i < $size; $i++) { 
				$arr['month'][]=$_POST['cjCashOpBal'];
				$arr['icpNo'][]=$_POST['icpNo'];
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

public function viewCashBal($render=2,$path="",$tags=array("All")){
	//$cond = $this->_model->where(array(array("where","icpNo",$this->choice[1],"=")));
	$qry = $this->_model->getAllRecords("","cashbal");
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
public function downloadMfr(){
	$html='Hello';
	Resources::import("mpdf/mpdf");
	$mpdf=new mPDF('c'); 
	$mpdf->WriteHTML($html);
	   ob_end_clean();
	$mpdf->Output();
	exit;
}
public function ticket($render=1,$path="",$tags=array("All")){
	$data=array();
	//Get last submitted MFR Month and Year
	$last_mfr_cond=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
	$last_mfr_arr = $this->_model->getAllRecords($last_mfr_cond,"bssubmitted","",array("MAX(bsID)","month"));
	$last_mfr_date = $last_mfr_arr[0]->month;
	
	$next_mfr_month=date('m',strtotime('+1 month',strtotime($last_mfr_date)));
	$next_mfr_year=date('Y',strtotime('+1 month',strtotime($last_mfr_date)));
	
	//Get All Voucher for the Next unsubmitted Transactions
	$next_rec_cond="";
	if($last_mfr_arr[0]->month){
		$next_rec_cond = $this->_model->where(array(array("where","MONTH(TDate)",$next_mfr_month,"="),array("AND","YEAR(TDate)",$next_mfr_year,"="))); 
	}
	$next_rec_arr = $this->_model->getAllRecords($next_rec_cond,"voucher_header","",array("VNumber"));
	
	$data['test']=$next_rec_arr;
	$data['cur_month_vouchers']=$next_rec_arr;
	return $data;
}
public function managefunds($render=1,$path="",$tags=array("All")){
	
}
public function civedit($render=1,$path="",$tags=array("All")){
	
}
public function civfundsschedule($render=1,$path="",$tags=array("All")){
	$data = array();
	
	$curDate = date("Y-m-01");
	if(isset($_POST['Month'])){
		$curDate = $_POST['Month'];
	}
	
	
	//Get Items from Current Month Schedule Without CIV Code
	$non_civ_schedules_cond = $this->_model->where(array(array("WHERE","civCode","","="),array("AND","Month",$curDate,"=")));
	$non_civ_schedules_arr = $this->_model->getAllRecords($non_civ_schedules_cond,"fundsschedule","",array("DISTINCT(AccountDescription):fund"));
	
	$data['funds']=$non_civ_schedules_arr;
	$data['curDate']=$curDate;
	return $data;
	
}
public function addfundtocivschedule(){
	$acDesc = $_POST['AccountDescription'];
	$month = $_POST['Month'];
	$civCode = $_POST['civCode'];
	
	$set_update = array("civCode"=>$civCode);
	$cond_update = $this->_model->where(array(array("WHERE","Month",$month,"="),array("AND","AccountDescription",$acDesc,"=")));
	
	$update_qry = $this->_model->updateQuery($set_update,$cond_update,"fundsschedule");
	
}
public function addicptociv(){
	
	$icps = $_POST['icpNos'];
	$civCode = $_POST['civCode'];
	
	//Find If CIV Code Exists in the Schedules for Each ICP to be added
	
	$icps_arr = explode(",", $icps);
	
	$missing="";
	foreach ($icps_arr as $value) {
		//$chk_code_cond = $this->_model->where(array(array("WHERE","civCode",$civCode,"="),array("AND","KENumber",$value,"=")));
		//$chk_code_arr = $this->_model->getAllRecords($chk_code_cond,"fundsschedule","",array("KENumber"));
		$chk_code_arr = $this->_model->chkicpswithciv($civCode,$value);
		//if(empty($chk_code_arr)){
			//$missing.=$value.", ";
		//}
		print_r($chk_code_arr);
	}
	echo $missing;
	//Extract the existing ICPs List from the Account
	
	//Only for those that pass the step One add the list to the list extracted in step 2 above
	
	//Update the Revenue and Expense Account of the CIV Accout with the list formed in 3 above
	
}

//Start from Here

public function editvoucherview($render=1,$path="",$tags=array("All")){
            //try{
              //  if(isset($_SESSION['username'])){
                	
					//Date Control
					$date_control_cond=$this->_model->where(array(array("where","extraID",6,"=")));
					$date_control=$this->_model->getAllRecords($date_control_cond,"extras");
					$date_control_flag=$date_control[0]->flag;
					
					//Max Voucher - Get Max Date and Voucher Number
					$max_date_cond=$this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
					$max_date=$this->_model->maxICPVoucher($max_date_cond);
					
					$max_close_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
					$max_close=$this->_model->maxCloseBal($max_close_cond);
					
					$max_voucher=array();
					if(!empty($max_close)&&empty($max_date)){
							//$fy=Resources::func("get_financial_year",array(date("Y-m-d",strtotime('next month',strtotime($max_close[0]->closureDate)))));
							$fy=date("y",strtotime('next month',strtotime($max_close[0]->closureDate)));
							$m=date("m",strtotime('next month',strtotime($max_close[0]->closureDate)));					
							$max_voucher['TDate']=date("Y-m-01",strtotime('next month',strtotime($max_close[0]->closureDate)));
							$max_voucher['VNumber']=$fy.$m."00";
					}elseif(!empty($max_date)){
							$max_voucher['TDate']=$max_date[0]->TDate;
							$max_voucher['VNumber']=$max_date[0]->VNumber;
					}else{
								
						$open_bc_bal_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=",array("AND","accNo","BC","="))));
						$open_bc_bal=$this->_model->getAllRecords($open_bc_bal_cond,"cashbal");
						if(empty($open_bc_bal)){
							$fy_begin_date = '2015-06-30';
						}else{
							$fy_begin_date = $open_bc_bal[0]->month;
						}	
								//$fy_begin_date = '2015-06-30';
								//$fy=Resources::func("get_financial_year",array(date("Y-m-d",strtotime('next month',strtotime($fy_begin_date)))));
								$fy=date("y",strtotime('next month',strtotime($fy_begin_date)));
								$m=date("m",strtotime('next month',strtotime($fy_begin_date)));
								$max_voucher['TDate']=	$fy_begin_date;//$open_bc_bal[0]->month;
								$max_voucher['VNumber']=$fy.$m."00";				
					}
					
                    $mth = date('m');
                    $icp = $_SESSION['fname'];
					
					//Check if MFR was submitted
					$max_voucher_month=date("m",strtotime($max_voucher['TDate']));
					$max_voucher_year=date("Y",strtotime($max_voucher['TDate']));
					
					$chk_mfr_cond = $this->_model->where(array(array("where","Month(month)",$max_voucher_month,"="),array("AND","Year(month)",$max_voucher_year,"="),array("AND","icpNo",Resources::session()->fname,"=")));
					$chk_mfr_arr = $this->_model->getAllRecords($chk_mfr_cond,"bssubmitted");
					
					$data['cDate']=$max_voucher['TDate'];
					if(!empty($chk_mfr_arr)){
						$data['cDate']=date('Y-m-d',strtotime("+1 day",strtotime($chk_mfr_arr[0]->month)));
					}
					
					$data['months'] = $this->_model->getMonthByNumber($mth,$icp);
					$data['date_flag']=$date_control_flag;
					$data['maxRec']=$max_voucher;
					$data['test']="";
                    return $data; 
            //    }  else {
              //      throw new customException("Session ID username is not set!");
                //}
            //}catch(customException $e){
              //  echo $e->errorMessage();
            //} 
    }
public function voucheredit(){
	//$userlevel = $_POST['userlevel'];
	$icpNo = $_POST['icpNo'];
	$VNumber = $_POST['VNumber'];
	$cDate = $_POST['TDate'];
	$Payee = $_POST['Payee'];
	$Address = $_POST['Address'];
	$VType = $_POST['VType'];
	$TDesc = $_POST['TDescription'];
	
	//Get Voucher
	$render = 1;
	$path = 'editvoucherview';
	$data['cDate']=$cDate;
	$data['months'] = $this->_model->getMonthByNumber(date('m',strtotime($cDate)),$icpNo);
	$data['date_flag']=1;
	$data['maxRec']=$VNumber;
	$data['Payee']=$Payee;
	$data['Address']=$Address;
	$data['VType']=$VType;
	$data['TDesc'] = $TDesc;
	$data['ChqNo']=$_POST['ChqNo'];
	$data['test']="";
	$tags = array("All");
	
	$this->dispatch($render,$path, $data,$tags);

}
public function editVoucher(){
	//Delete former Voucher
	$icpNo = $_POST['KENo'];
	$VNo = $_POST['VNumber'];
	
	$vch_del_cond = $this->_model->where(array(array("WHERE","icpNo",$icpNo,"="),array("AND","VNumber",$VNo,"=")));
	$vch_del_header_qry = $this->_model->deleteQuery($vch_del_cond,"voucher_header");
	$vch_del_body_qry = $this->_model->deleteQuery($vch_del_cond,"voucher_body");
	
	//Insert New
        $header = array();
        for($i=0;$i<8;$i++){
            $header[]=  array_shift($_POST);
        }
        $header[]=array_pop($_POST);
        $fy = Resources::func("get_financial_year",array(date("Y-m-d")));
        $tm = time();
        $chqState =0;
        
		//Get Bank Bank Code
		$bank_code=0;
		$bank_code_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"=")));
		$bank_code_qry=$this->_model->getAllRecords($bank_code_cond,"projectsdetails");
		if(count($bank_code_qry)>0){
			$bank_code=$bank_code_qry[0]->bankID;
		}
			
		
		$rwChqNo=$header[6];
		if($rwChqNo===""){
			$header[6]="";
		}else{
			$header[6]=ltrim($rwChqNo,'0')."-".$bank_code;
		}
			
		
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
                    
        //Mail Voucher to PF
		$pf_email_cond=$this->_model->where(array(array("where","cname",Resources::session()->cname,"="),array("AND","userlevel","2","=")));
		$pf_email_arr = $this->_model->getAllRecords($pf_email_cond,"users");
		$pf_email="";
		if(count($pf_email_arr)!==0){
			$pf_email = $pf_email_arr[0]->email;
		}else{
			$pf_email="NKarisa@ke.ci.org";
		}
			
	
		
		//Mail Body
		$body = "<b>Voucher Number:</b>".$qry_array['VNumber']."<br>";
		$body.= "<b>Total Amount:</b>".$qry_array['totals']."<br>";
		$body.="<b>Voucher Type:</b>".$qry_array['VType']."<br>";
		$body.="<b>Description:</b>".$qry_array['TDescription']."<br>";
		$body.="<b>Posting Date and Time:</b>".date('Y-m-d H:i:s',strtotime('+9 hours',$qry_array['unixStmp']))."<br>";
		$body.="<b>Transaction Date:</b>".$qry_array['TDate']."<br>";
		$body.="<b>Posted By:</b>".Resources::session()->username."<br>";
		
		
		//Mail Header
		
		$title = $qry_array['icpNo']." Voucher Posting: V# ".$qry_array['VNumber'];
		
		Resources::mailing($pf_email, $title, $body); 
		
		//$action = "Posted voucher Number ".$qry_array['VNumber'];
		//user_history($userid,$langid,$lang="eng",$actionParam=array())
		Resources::user_history(Resources::session()->ID,"post_voucher",$lang="eng",$action=array("VNumber"=>$qry_array['VNumber']));
		
    }
public function allowvoucheredit(){
	$icpNo = $_POST['icpNo'];
	$VNumber = $_POST['VNumber'];
	
	$set_for_edit = array("editable"=>1);
	$set_for_cond= $this->_model->where(array(array("WHERE","icpNo",$icpNo,"="),array("AND","VNumber",$VNumber,"=")));
	
	$update_vch = $this->_model->updateQuery($set_for_edit,$set_for_cond,"voucher_header");
	
	echo "Voucher editing for voucher number ".$VNumber." allowed!";
}

public function fundstransfer($render=1,$path='',$tags=array("2","3","9")){
	//Get Accounts
       $AccGrp = 1;
    
        $cond = $this->_model->where(array(array("where","accounts.AccGrp",$AccGrp,"=")));
        $rst_rw=$this->_model->civaAccountsMerge($cond,"CR");
        $rst=array();
        foreach($rst_rw as $civaAcc):
            if(is_numeric($civaAcc->civaID)&&substr_count($civaAcc->allocate,$_SESSION['fname'])>0){
                $rst[]=$civaAcc;
            }elseif(!is_numeric($civaAcc->civaID)){
                $rst[]=$civaAcc;
            }
        endforeach;
        
		$data =array();
		
		$data['ac']=$rst;
		
		return $data;
}
public function getfundsamount(){
	//print_r($_POST);
	$closureDate = $_POST['monthfrom'];	
	//Get system opening balance
	$sys_open_cond = $this->_model->where(array(array("WHERE","opfundsbalheader.icpNo",Resources::session()->fname,"="),array("AND","opfundsbal.funds",300,"="),array("AND","opfundsbalheader.closureDate",$closureDate,"=")));
	$sys_open_qry = $this->_model->getAllRecords($sys_open_cond,"opfundsbalheader","",array("opfundsbalheader.closureDate:closureDate","opfundsbal.funds:funds","opfundsbal.amount:amount"),array(array("LEFT JOIN","opfundsbalheader"=>"balHdID","opfundsbal"=>"balHdID")));
	
	print_r(json_encode($sys_open_qry));
}
public function fundstransferrequest(){
	$rst['icpNo'] = $_POST['icpNo'];
	$rst['monthfrom'] = $_POST['monthfrom'];
	$rst['acfrom'] = $_POST['acfrom'];
	$rst['acto'] = $_POST['acto'];
	$rst['civaID'] = $_POST['civaID'];
	$rst['amttotransfer'] = $_POST['amttotransfer'];
	$rst['description'] = $_POST['description'];
	
	//Check for unapproved transfer
	$chk_transfer_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","accepted",2,"<>")));
	$chk_transfer_qry = $this->_model->getAllRecords($chk_transfer_cond,"fundstransfersrequests","",array("monthfrom","acfrom","acto","amttotransfer","stmp"));
	
	if(count($chk_transfer_qry)>0){
		echo "You have unapproved transfer of Kes. ".$chk_transfer_qry[0]->amttotransfer." from account R".$chk_transfer_qry[0]->acfrom." to R".$chk_transfer_qry[0]->acto." raised on ".date("Y-m-d",strtotime($chk_transfer_qry[0]->stmp)+32400);
	}else{
		echo $this->_model->insertRecord($rst,"fundstransfersrequests");	
	}
		
}
public function fundstransferapproval($render=1,$path='',$tags=array("2")){
	//Get PF Cluster
	$cst = Resources::session()->cname;
	
	//Get list of transfer requests
	$req_cond = $this->_model->where(array(array("where","users.cname",$cst,"=")));
	$req_qry = $this->_model->getAllRecords($req_cond,"fundstransfersrequests","","",array(array("LEFT JOIN","fundstransfersrequests"=>"icpNo","users"=>"userfirstname")));

	
	$data = array();
	
	$data['req'] = $req_qry;
	
	return $data;

}
public function approvetransfer(){
	$reqID = $_POST['reqID'];
	
	//Get ICP Number/ Approval Request Record
	$approval_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
	$approval_qry = $this->_model->getAllRecords($approval_cond,"fundstransfersrequests");
	$icpNo = $approval_qry[0]->icpNo;
	
	//Get Max voucher_header ID
	$max_vnumber_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
	$max_vnumber_qry = $this->_model->getAllRecords($max_vnumber_cond,"voucher_header","",array("MAX(VNumber):VNumber","TDate"));
	$max_vnumber = $max_vnumber_qry[0]->VNumber;
	$max_tdate = $max_vnumber_qry[0]->TDate;
	//print_r($max_vnumber_qry);
	
	//Get last MFR submitted date
	$last_mfr_date_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
	$last_mfr_date_qry = $this->_model->getAllRecords($last_mfr_date_cond,"opfundsbalheader","",array("MAX(closureDate):closureDate"));
	$last_mfr_date = $last_mfr_date_qry[0]->closureDate;
	//print_r($last_mfr_date_qry);
	
	//Check date of the last submitted MFR is less than max_tdate and set a new voucher number
	$curVNumber_yr = substr($max_vnumber, 0,2);
	$curVNumber_month= substr($max_vnumber, 2,2);
	$max_tdate_month = substr($max_tdate, 5,2);
	$nextVNumber = $max_vnumber+1;
	if(strtotime($last_mfr_date)>strtotime($max_tdate)){
		//Skip voucher numbers
		$max_tdate_month = $max_tdate_month+1;
		if($max_tdate_month===13){
			$curVNumber_yr = $curVNumber_yr+1;
			$nextVNumber = $curVNumber_yr."0101";
		}else{
			if(strlen($max_tdate_month)===1){
				$max_tdate_month = "0".$max_tdate_month;
			}
			$nextVNumber = $curVNumber_yr.$max_tdate_month."01";
		}
	}
	
	
	//Insert a new voucher header
	$voucher_header = array();
	$voucher_header['icpNo'] = $icpNo;
	$voucher_header['TDate'] = $max_tdate;
	$voucher_header['Fy']=$curVNumber_yr;
	$voucher_header['VNumber'] = $nextVNumber;
	$voucher_header['Payee']=$icpNo;
	$voucher_header['Address']=$icpNo;
	$voucher_header['VType'] = "CR";
	$voucher_header['ChqNo'] = 0;
	$voucher_header['ChqState'] = 0;
	$voucher_header['clrMonth'] = "0000-00-00";
	$voucher_header['TDescription'] = $approval_qry[0]->description." (Funds transfer approval from R".$approval_qry[0]->acfrom." to R".$approval_qry[0]->acto." ID: ".$reqID.")";
	$voucher_header['totals'] = 0;
	$voucher_header['editable'] = 0;
	$voucher_header['reqID'] = $reqID;
	$voucher_header['unixStmp']=strtotime(date("Y-m-d H:m:s"));
	
	$this->_model->insertRecord($voucher_header,"voucher_header");
	
	//Get hID
	$hid_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
	$hid_qry = $this->_model->getAllRecords($hid_cond,"voucher_header");
	$hID = $hid_qry[0]->hID;
	
	//Insert a new voucher body
	$voucher_body = array();
	$voucher_body['hID'] = array($hID,$hID);
	$voucher_body['icpNo']=array($icpNo,$icpNo);
	$voucher_body['VNumber']=array($nextVNumber,$nextVNumber);
	$voucher_body['TDate'] = array($max_tdate,$max_tdate);
	$voucher_body['Qty'] = array(1,1);
	$voucher_body['Details'] = array("Funds transfer from R".$approval_qry[0]->acfrom,"Funds Transfer to R".$approval_qry[0]->acto);
	$voucher_body['UnitCost'] = array(-$approval_qry[0]->amttotransfer,$approval_qry[0]->amttotransfer);
	$voucher_body['Cost'] = array(-$approval_qry[0]->amttotransfer,$approval_qry[0]->amttotransfer);
	$voucher_body['AccNo'] = array($approval_qry[0]->acfrom,$approval_qry[0]->acto);
	$voucher_body['civaCode'] = array(0,$approval_qry[0]->civaID);
	$voucher_body['VType'] = array("CR","CR");
	$voucher_body['ChqNo'] = array(0,0);
	$voucher_body['unixStmp']=array(strtotime(date("Y-m-d H:m:s")),strtotime(date("Y-m-d H:m:s")));
	
	$this->_model->insertArray($voucher_body,"voucher_body");
	
	//Flag the record to Approved
	$this->_model->updateQuery(array("accepted"=>2,"VNumber"=>$nextVNumber),$approval_cond,"fundstransfersrequests");
}
public function deltransfer(){
	$reqID = $_POST['reqID'];
	
	$del_transfer_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
	$this->_model->deleteQuery($del_transfer_cond,"fundstransfersrequests");
	
	echo "Request deleted successfully";
}
public function edittransferrequest($render=1,$path='',$tags=array("All")){
	$reqID = $_POST['reqID'];
	//Get Accounts
       $AccGrp = 1;
    
        $cond = $this->_model->where(array(array("where","accounts.AccGrp",$AccGrp,"=")));
        $rst_rw=$this->_model->civaAccountsMerge($cond,"CR");
        $rst=array();
        foreach($rst_rw as $civaAcc):
            if(is_numeric($civaAcc->civaID)&&substr_count($civaAcc->allocate,$_SESSION['fname'])>0){
                $rst[]=$civaAcc;
            }elseif(!is_numeric($civaAcc->civaID)){
                $rst[]=$civaAcc;
            }
        endforeach;
		
		//Get Full Request Record
		$req_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
		$req_qry = $this->_model->getAllRecords($req_cond,"fundstransfersrequests");
        
		$data =array();
		
		$data['ac']=$rst;
		$data['req'] = $req_qry[0];
		
		return $data;
}
public function fundstransferrequestedit(){
  $reqID = $_POST['reqID'];
  
  $update_request_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
  
  //Check if accepted
  $accept_qry = $this->_model->getAllRecords($update_request_cond,"fundstransfersrequests");
  $accepted = $accept_qry[0]->accepted;

  
  $rst =array();
  
	$rst['icpNo'] = $_POST['icpNo'];
	$rst['monthfrom'] = $_POST['monthfrom'];
	$rst['acfrom'] = $_POST['acfrom'];
	$rst['acto'] = $_POST['acto'];
	$rst['civaID'] = $_POST['civaID'];
	$rst['amttotransfer'] = $_POST['amttotransfer'];
	if($accepted==='1'){
		$rst['accepted']=3;
	}
	$rst['description'] = $_POST['description'];
  
  
  $update_request_qry = $this->_model->updateQuery($rst,$update_request_cond,"fundstransfersrequests");
  
  echo "Update successful";
  	
}
public function rejecttransfer(){
	$reqID = $_POST['reqID'];
	$update_request_cond = $this->_model->where(array(array("where","reqID",$reqID,"=")));
	$sets = array("accepted"=>1);
	
	$this->_model->updateQuery($sets,$update_request_cond,"fundstransfersrequests");
	
	echo "Request declined successfully";
}
}