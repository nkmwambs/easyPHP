<?php
class Finance_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Finance_Model("voucher_header");  
        $this->helper->get_func(array("get_financial_year","test","get_month_number_array"));
    }
    public function switchboard(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $cluster = $this->_model->getClusters();
        $this->template->view("",$cluster);
        $this->template->view("welcome/footer",$recent); 
    }

    public function viewAll(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            //$data = "Finance Module View";
            $this->template->view();
            $this->template->view("welcome/footer",$recent); 
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

    public function voucher(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            //$data = "Voucher View";
            try{
                if(isset($_SESSION['username'])){
                    $mth = date('m');
                    $icp = $_SESSION['username'];
                    $data = $this->_model->getMonthByNumber($mth,$icp);
                    $this->template->view("",$data);
                }  else {
                    throw new customException("Session ID username is not set!");
                }
            }catch(customException $e){
                echo $e->errorMessage();
            }
            $this->template->view("welcome/footer",$recent); 
    }
    public function ecjOther(){
       $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");  
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        if(isset($_POST['icpSelector'])){
                    $cond = $this->model->where(array("where"=>array("username",trim(filter_input(INPUT_POST,"icpSelector")),"=")));
        }elseif(isset ($this->choice[1])) {
            $cond = $this->model->where(array("where"=>array("username",  $this->choice[1],"=")));
        }
                    $results = $this->_model->getAllRecords($cond,"Users");
                foreach($results[0] as $key=>$value):
                    $_SESSION[$key."_backup"]=$value;
                endforeach;
            //if(isset($this->choice[1])){
            //    $cds = $this->_model->where(array("where"=>array("icpNo",$_SESSION['username'],"="),"AND"=>array("Month(`TDate`)",date('m', strtotime($this->choice[1])),"=")));
            //}  else {
              $cds = $this->_model->where(array("where"=>array("icpNo",$_SESSION['username_backup'],"="),"AND"=>array("Month(`TDate`)",date('m'),"=")));  
            //}
            $data[]=$this->_model->accounts();
            $data[] = $this->_model->getVoucherForEcj($cds);
            $this->template->view("",$data);
    //}

            $this->template->view("welcome/footer",$recent); 
                
}   

    public function ecj(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");  
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
            
            if(isset($this->choice[1])){
                $cds = $this->_model->where(array("where"=>array("icpNo",$_SESSION['username'],"="),"AND"=>array("Month(`TDate`)",date('m', strtotime($this->choice[1])),"=")));
            }  else {
              $cds = $this->_model->where(array("where"=>array("icpNo",$_SESSION['username'],"="),"AND"=>array("Month(`TDate`)",date('m'),"=")));  
            }
              
            
            $data[]=$this->_model->accounts();
            $data[] = $this->_model->getVoucherForEcj($cds);
            if($_SESSION['userlevel']==="1"){
                $this->template->view("",$data);
            }elseif($_SESSION['userlevel']==="2"){
                $selector_cond_pf = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
                $selector_pf = $this->_model->getAllRecords($selector_cond_pf,"users");
                $cluster = $selector_pf[0]->cname;
                $selector_cond_icps = $this->_model->where(array(array("where","cname",addslashes($cluster),"="),array("AND","userlevel","1","=")));
                $selector_icps = $this->_model->getAllRecords($selector_cond_icps,"users");
                $this->template->view("Welcome/icpSelector",$selector_icps);
            }
            
            $this->template->view("welcome/footer",$recent); 
    }
    
    public function ppbf(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            if($_SESSION['userlevel']==="1"){
                $this->template->view();    
            }elseif($_SESSION['userlevel']==="2"){
                $cluster_cond = $this->_model->where(array(array("where","cname",$_SESSION['cname'],"="),array("AND","userlevel","2","<>")));
                $cluster_arr = $this->_model->getAllRecords($cluster_cond,"users");
                $this->template->view("Welcome/icpSelectorForPpbf",$cluster_arr);
            }  else {
                
            }
            $this->template->view("welcome/footer",$recent); 
    }
    public function ppbfOther(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        
        if(isset($this->choice[1])){
            $icp_cond = $this->_model->where(array(array("where","icpNo",  $this->choice[1],"=")));
        }else{
           $icp_cond = $this->_model->where(array(array("where","icpNo",$_POST['icpSelector'],"="))); 
        }
        
        $icp_arr = $this->_model->getAllRecords($icp_cond,"plansHeader");
        
        $this->template->view("",$icp_arr);
        
        $this->template->view("welcome/footer",$recent);
    }

        public function getPpbf(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        if($_SESSION['userlevel']==="1"){ 
            if($this->choice[1]==='1'||$this->choice[1]==='2'){
                $plan_cond = $this->_model->where(array(array("WHERE","plansheader.icpNo",$_SESSION['username'],"="),array("AND","plansheader.fy",$this->choice[3],"="),array("AND","plansheader.planType",  $this->choice[1],"=")));
            }
            }elseif ($_SESSION['userlevel']==="2") {
                $plan_cond = $this->_model->where(array(array("AND","plansheader.planHeaderID",$this->choice[1],"=")));
                
            }else{
                $plan_cond = $this->_model->where(array(array("AND","plansheader.planHeaderID",$this->choice[1],"=")));
                
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
                    $this->template->view("",$data);
                 }
             } catch (customException $e) {
                    echo $e->errorMessage();
             }            

        $this->template->view("welcome/footer",$recent);         
    }

    public function newPlan(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            
            $acc_cond=$this->_model->where(array("where"=>array("AccGrp","0","="),"AND"=>array("AccNo","100","<")));
            $acc = $this->_model->getAllRecords($acc_cond,"accounts");
            $this->template->view("",$acc);
            $this->template->view("welcome/footer",$recent); 
    }
    
    public function searchPlan(){
                $chk_cond = $this->_model->where(array(array("where","plansheader.icpNo",$_SESSION['username'],"="),array("AND","plansheader.planType",$this->choice[1],"="),array("AND","plansheader.fy",$this->choice[3],"=")));
                //$chk =  $this->_model->getAllRecords($chk_cond,"plans");
                $chk =  $this->_model->getPpbfModel($chk_cond);
                //echo $this->choice[3];
                //print_r($chk);
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
        $chk_header_exists = $this->_model->getAllRecords($chk_header_cond,"plansHeader");
         
        $approved = $chk_header_exists[0]->approved;
        if($approved==="1"){
            echo "The plan your attempting to Update is locked! Please Contact your PF!";
        }else{
                $cur_planid = $chk_header_exists[0]->planHeaderID;

                if(count($chk_header_exists)>0){
                    $this->_model->deleteQuery($chk_header_cond,"plansHeader");
                }
                    //echo $this->_model->insertRecord($header_arr,"plansHeader");
                    $this->_model->insertRecord($header_arr,"plansHeader");

                $cur_plan = $this->_model->getAllRecords($chk_header_cond,"plansHeader");
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
        $rst = $this->_model->updateQuery($approve_set,$approve_cond,"plansheader");
        if($rst===1){
            echo $msg;
        }  else {
            echo 0;
        }
    }
    
    public function schedules(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);  
            
            $acc_cond=  $this->_model->where(array(array("where","AccGrp","0","="),array("AND","AccNo",100,"<")));
            $acc = $this->_model->getAllRecords($acc_cond,"accounts");

            $fy = get_financial_year(date('Y-m-d'));
            
            $data[]=$fy;
            $data[]=$acc;
            if($_SESSION['userlevel']==="1"){
                $this->template->view("",$data);
            }else{
                $this->template->view("welcome/pfPlansSchedulesView",$data);
            }
            $this->template->view("welcome/footer",$recent); 

            }       
    public function pfSchedules(){
        //if($this->choice[2]==="scheduleID"){
          //  $scheduleID=  $this->choice[3];
            //$del_cond = $this->_model->where(array(array("where","scheduleID",$scheduleID,"=")));
            //$this->_model->deleteQuery($del_cond,"plansschedule");
        //}
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);  
            
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
        $this->template->view("",$data);
        
        $this->template->view("welcome/footer",$recent); 

    }
    public function showNewPlansItems(){
        $fy = $this->choice[1];
        $new_item_cond = $this->_model->where(array(array("where","plansschedule.approved",1,"="),array("AND","users.cname",$_SESSION['cname'],"="),array("AND","planheader.fy",$fy,"=")));  
        $new_item = $this->_model->countNewSchedules($new_item_cond);
        $data[] =$fy;
        $data[]=$new_item;
        $this->template->view("",$data);
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
    public function pfPlansView(){
        $fy = $this->choice[1];
        $all_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","users.cname",$_SESSION['cname'],"=")));
        $all = $this->_model->countNewSchedules($all_cond);
        $data[]=$fy;
        $data[]=$all;
        $this->template->view("",$data);
    }

    public function checkSchedule(){
        $fy = $this->choice[1];
        $AccNo = $this->choice[3];
        
        $schedule_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","plansschedule.AccNo",$AccNo,"="),array("AND","icpNo",$_SESSION['fname'],"=")));
        $schedule = $this->_model->getSchedule($schedule_cond);
        print_r(json_encode($schedule));
    }
    public function viewAllSchedules(){
        //echo "Budget Schedules View for FY".$this->choice[1];
        if($this->choice[2]==="scheduleID"){
            $scheduleID=  $this->choice[3];
            $del_cond = $this->_model->where(array(array("where","scheduleID",$scheduleID,"=")));
            $this->_model->deleteQuery($del_cond,"plansschedule");
        }
        $fy = $this->choice[1];
        $schedules_cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$_SESSION['fname'],"=")));
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
        $this->template->view("",$data);
    }
    public function viewPlanSummary(){
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
        $this->template->view("",$data);
    }
    public function viewPlanSummaryByPf(){
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
        $this->template->view("",$data);
    }
    public function postSchedule(){
        $AccNo = array_shift($_POST);
        $fy=  array_shift($_POST);
        
        $chk_plan_cond = $this->_model->where(array(array("where","icpNo",$_SESSION['fname'],"="),array("AND","fy",$fy,"=")));        
        
        $chk_plan=  $this->_model->getAllRecords($chk_plan_cond,"planHeader");
        if(count($chk_plan)===0){
            $header_arr = array('fy'=>$fy,'icpNo'=>$_SESSION['fname']);
            $this->_model->insertRecord($header_arr,"planHeader");
        }
        
        $chk_plan_two=  $this->_model->getAllRecords($chk_plan_cond,"planHeader");
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
    public function submitNewPlanItem(){
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
                $this->template->view("welcome/viewAllSchedules",$data);
                
        }else{
            echo "0";
        }
        
    }
    public function massSubmitPlanItems(){
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
                $this->template->view("welcome/viewAllSchedules",$data);
        
    }

    public function mfr(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            
            $acc_cond = $this->_model->where(array(array("where","voucher_body.icpNo",$_SESSION['fname'],"="),array("AND","Year(voucher_body.TDate)",date('Y'),"="),array("AND","Month(voucher_body.TDate)",date('m'),"=")));
            $acc = $this->_model->accountsForMfr($acc_cond);
            
            if(date('m')-1===0){
                $year = date('Y')-1;
                $month=12;
            }else{
                $year = date('Y');
                $month=date('m')-1;
            }
            
            $balBf_cond = $this->_model->where(array(array("where","opfundsbalheader.icpNo",$_SESSION['fname'],"="),array("AND","Year(opfundsbalheader.closureDate)",$year,"="),array("AND","Month(opfundsbalheader.closureDate)",$month,"="),array("AND","totalBal","0","<>")));
            $balBf = $this->_model->balFundsBf($balBf_cond);
            
            
            //$balBf=0;
            $data[]=$balBf;
            $data[]=$acc;
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }
    
    public function statements(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = "View Bank Statements";
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent); 
    }

    public function disbursement(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view();
            $this->template->view("welcome/footer",$recent); 
    } 
    public function uploadFundsList(){
        set_time_limit(3600); 
        $lists = $_POST['lists'];
        $file = $_FILES['csv']['tmp_name'];
        //$handle = fopen($file,"r");
        $this->_model->uploadFunds($lists,$file);
    }
    public function advicePerICP(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $cluster_cond = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
            $cluster = $this->_model->getAllRecords($cluster_cond,"users");
            
            //$cst_cond = $this->_model->where(array(array("where","cname",$cluster[0]->cname,"="),array("AND","userlevel","2","<>")));
            $cst = $this->_model->fundsPerICP($cluster[0]->cname);
            
            $this->template->view("",$cst);
            $this->template->view("welcome/footer",$recent);         
    }

    public function fundsCategories(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view();
            $this->template->view("welcome/footer",$recent);         
    }

    public function fundsUpload(){
              $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view();
            $this->template->view("welcome/footer",$recent);   
    }

    public function viewSlip(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $funds_cond = $this->_model->where(array(array("where","KENumber",$_SESSION['fname'],"="),array("AND","Month",date('Y-m-01'),"=")));
            $funds = $this->_model->getAllRecords($funds_cond,"fundsschedule");
            $this->template->view("",$funds);
            $this->template->view("welcome/footer",$recent);  
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
    
    public function postVoucher(){
        //print_r(filter_input_array(INPUT_POST));
        $header = array();
        for($i=0;$i<8;$i++){
            $header[]=  array_shift($_POST);
        }
        $header[]=array_pop($_POST);
        $fy = 15;
        $tm = time();
        $chqState =0;
        
        $fld_header_arr = array("icpNo","TDate","Fy","VNumber","Payee","Address","VType","ChqNo","ChqState","TDescription","totals","unixStmp");
        $header_one = array_splice($header,0,2);
        $header_two = array_splice($header,0,5);
        array_push($header_two, $chqState);
        array_push($header, $tm);
        array_push($header_one,$fy);
        $new_header = array_merge($header_one, $header_two,$header);
        $qry_array = array_combine($fld_header_arr, $new_header);
        //print_r($qry_array);
        $qry_array['totals']=  str_replace(",","",$qry_array['totals']);
        $this->_model->insertRecord($qry_array,"voucher_header");
        
        $hID_cond=  $this->_model->where(array("where"=>array("VNumber",$qry_array['VNumber'],"="),"AND"=>array("icpNo",$qry_array['icpNo'],"=")));
        $hID_rst = $this->_model->getAllRecords($hID_cond,"voucher_header");
        
        //print_r($_POST);
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
            echo $this->_model->insertRecord($value,"voucher_body");
        endforeach;
        
    }
    public function showVoucher(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 
        
        $VNum=  $this->choice[1];
        if($_SESSION['userlevel']==="1"){
            $icpNo = $_SESSION['username'];
        }  elseif ($_SESSION['userlevel']==="2") {
            $icpNo = $_SESSION['username_backup'];
        }  else {
            
        }
        
        $data = $this->_model->showVoucher($VNum,$icpNo);
        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view("",$data);
            $this->template->view("welcome/footer",$recent);
    }
    public function getFlds(){
        $arr_tables=$this->_model->dbTables();
        $flds = $this->_model->getVoucherTableFields($arr_tables[$this->choice[1]]);
        print_r(json_encode($flds));
    }
    public function searchResults(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 
                $data = $this->_model->searchResultsQuery($_POST);
                if(is_array($data)){
                    $rst = $data;
                }  else {
                    $rst = $data;
                }
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("",$rst);
		$this->template->view("Welcome/footer",$recent); 

    }
public function civ(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 
        
        $civa_cond = $this->_model->where(array(array("where","civa.open","1","="),array("AND","accounts.AccGrp","0","=")));
        //$civa = $this->_model->getAllRecords($civa_cond,"civa");
        $civa[] = $this->_model->civaExpenseAccounts($civa_cond);

            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view("",$civa);
            $this->template->view("welcome/footer",$recent); 
}
public function AddCIVA(){
          $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 

            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view();
            $this->template->view("welcome/footer",$recent);   
}

public function viewFunds(){
    
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $funds_cond=  $this->_model->where(array(array("where","Month",date('Y-m-01'),"=")));
            $funds = $this->_model->getAllRecords($funds_cond,"fundsschedule","LIMIT 0,100");
            $this->template->view("",$funds);
            $this->template->view("welcome/footer",$recent);  
}
public function fundsOpBal(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);

            $this->template->view();
            $this->template->view("welcome/footer",$recent);     
}
public function getExpAccounts(){
            $acc_cond=  $this->_model->where(array(array("where","AccGrp","1","=")));
            $acc = $this->_model->getAllRecords($acc_cond,"accounts");
            print_r(json_encode($acc));
}
public function addFundBal(){
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
    
    
}
public function pfSettings(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
                $selector_cond_pf = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
                $selector_pf = $this->_model->getAllRecords($selector_cond_pf,"users");
                $cluster = $selector_pf[0]->cname;
                $selector_cond_icps = $this->_model->where(array(array("where","cname",addslashes($cluster),"="),array("AND","userlevel","1","=")));
                $selector_icps = $this->_model->getAllRecords($selector_cond_icps,"users");
                $this->template->view("Welcome/icpSelectorForBal",$selector_icps);
        $this->template->view("welcome/footer",$recent);       
}
public function showOpeningBal(){
        
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        
        if(isset($_POST['icpSelector'])){
            $icpNo = $_POST['icpSelector'];
        }else{
            $icpNo=$_SESSION['fname'];
        }
        $icp_cond = $this->_model->where(array(array("where","icpNo",$icpNo,"=")));
        $icp = $this->_model->getAllRecords($icp_cond,"opfundsbalheader");
        $this->template->view("",$icp);
        $this->template->view("welcome/footer",$recent);
}
public function oustChqBf(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);    
        $this->template->view();
        $this->template->view("welcome/footer",$recent);        
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
public function cashBalBf(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);    
        $this->template->view();
        $this->template->view("welcome/footer",$recent);
}
public function opRecon(){
         $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);    
        $this->template->view();
        $this->template->view("welcome/footer",$recent);   
}


}