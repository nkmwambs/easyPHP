<?php
class Settings_Controller extends E_Controller
{
public $_model;
public function __construct() {
        parent::__construct();
        $this->_model=new Settings_Model("recent");
            
    }
    
    public function viewSettings($render=1,$path="",$tags=array("All")){
		
}
   // Users Methods
    
public function userslist($render=1,$path='',$tags=array("9")){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        if(empty($this->choice)){
            $cond = $this->model->where(array("where"=>array("userlevel",filter_input(INPUT_POST,"userlevel"),"="),
                "AND"=>array("cname",'%'.filter_input(INPUT_POST,"cname").'%',"LIKE")));
        }else{
            $cond = $this->model->where(array("where"=>array("userlevel",  $this->choice[1],"="),
                "AND"=>array("cname",'%'.$this->choice[3].'%',"LIKE")));
        }
        $data = $this->model->getAllRecords($cond,"Users");
		return $data;
    }
    
    public function newUser($render=1,$path='',$tags=array("9")){
 
    }
    
    public function addUser($render=1,$path='',$tags=array("9")){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $data = $this->model->insertRecord(filter_input_array(INPUT_POST),"Users");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    //Positions Methods
    
    public function lists($render=1,$path='',$tags=array("9")){       
        $data = $this->_model->getAllRecords("","Positions");
		return $data;         
    }
    
    public function newPosition($render=1,$path='',$tags=array("9")) {
     
    }
    
    public function getEntry(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $data = $this->model->insertRecord(filter_input_array(INPUT_POST),"Positions");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu); 
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);         
        
    }
    
    public function deletePosition(){
        $cond = $this->model->where(array("where"=> array("dsgn",$this->choice[1],"=")));
        $data = $this->model->deleteQuery($cond);
        //$menu = $this->model->getAllRecords("","menu");
        //$this->load_menu->menu($menu); 
        $this->template->view("",$data);
        //$this->template->view("welcome/footer");  
    }
    
    // Menu Settings
    public function addMenu($render=1,$path='',$tags=array("9")){
         
     }
     
     public function getMenu(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
         
         $data = $this->model->insertRecord(filter_input_array(INPUT_POST));
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view("",$data);
         $this->template->view("welcome/footer",$recent);
     }
     
     public function showAll($render=1,$path="",$tags=array("All")){
         $menu = $this->model->getAllRecords("","menu");
			return $menu;
     }
	 public function financeSettings($render=1,$path="",$tags=array("All")){
	 	$data=array();
		
		//if(Resources::session()->userlevel!==1){		
			//Date Control
			$date_control_cond=$this->_model->where(array(array("where","info","date_control","=")));
			$date_control = $this->_model->getAllRecords($date_control_cond,"extras");
			$date_control_flag=$date_control[0]->flag;
		
			//Dollar and Exchange Rate

			$fy = Resources::func("get_financial_year",array(date('Y-m-d')));
			if(isset($this->choice[1])){
				$fy = $this->choice[1];
			}
			$rate_cond = $this->_model->where(array(array("where","fy",$fy,"="))); 
			$rate_qry = $this->_model->getAllRecords($rate_cond,"fundparameters");
			$rates = array();
			$cnt=0;
			foreach($rate_qry as $value):
					if($rate_qry[$cnt]->param === 'dollar_rate'){
						$rates['dollar_rate']=$rate_qry[$cnt]->paramVal;
					}
					if($rate_qry[$cnt]->param === 'exchange_rate'){
						$rates['exchange_rate']=$rate_qry[$cnt]->paramVal;
					}
				$cnt++;
			endforeach;
			$rates['fy']=$fy;
			
			
		 //}
		
		
		if(Resources::session()->userlevel==='1'){
			//ICP Population	
			$icp_population_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","fy",$fy,"=")));
			$icp_population = $this->_model->getAllRecords($icp_population_cond,"icppopulation");
			$pop=array();
			foreach($icp_population[0] as $key=>$value):
				$pop[$key]=$value;
			endforeach;
			$data['icpPopulation']=$pop;
		}
		
		$data['date_flag']=$date_control_flag;
		$data['rates']=$rates;
		$data['test']="";
	 	return $data;
	 }
public function changeICPPopulation(){
			$pop = $this->choice[1];
			$fy = $this->choice[3];
			$noOfMonths = $this->choice[5];
			$icp_population_cond = $this->_model->where(array(array("where","icpNo",Resources::session()->fname,"="),array("AND","fy",$fy,"=")));
			$icp_population = $this->_model->getAllRecords($icp_population_cond,"icppopulation");
			if(count($icp_population)>0&&$icp_population[0]->editAllowed==='1'){
				//Update
				//print("Update");
				$set = array("noOfBen"=>$pop,"noOfMonths"=>$noOfMonths);
				$qry = $this->_model->updateQuery($set,$icp_population_cond,"icppopulation");
				if($qry===1){
					echo "Update Successfully!";
				}else{
					echo "Update failed!";
				}
			}elseif(count($icp_population)>0&&$icp_population[0]->editAllowed==='0'){
				//Edit not allowed
				print("Edit not allowed. Contact the administrator!");
			}else{
				//Insert
				$popArr =array();
				$popArr['icpNo']=Resources::session()->fname;
				$popArr['noOfBen']=$pop;
				$popArr['noOfMonths']=$noOfMonths;
				$popArr['fy']=$fy;
				$popArr['editAllowed']=1;
				echo $this->_model->insertRecord($popArr,"icppopulation");
			}
}
	 public function dateControl(){
		$flag = $this->choice[1];
		$flagging_cond = $this->_model->where(array(array("where","info","date_control","=")));
		$set = array("flag"=>$flag);
		$this->_model->updateQuery($set,$flagging_cond,"extras");
		if($this->choice[1]==='1'){
			print("Date control OFF");
		}else{
			print("Date control ON");
		}
	 }
public function changeDollarRate(){
	 	$dollar_rate = $this->choice[1];
		$fy=$this->choice[3];
		
		$dollar_rate_chk_cond = $this->_model->where(array(array("where","param",'dollar_rate',"="),array("AND","fy",$fy,"=")));
		$dollar_rate_chk = $this->_model->getAllRecords($dollar_rate_chk_cond,"fundparameters");
		if(count($dollar_rate_chk)>0){
			//print("Update");
			$set = array("paramVal"=>$dollar_rate);
			$update_qry = $this->_model->updateQuery($set,$dollar_rate_chk_cond,"fundparameters");
			if($update_qry===1){
				echo "Record Updated successfully!";
			}else{
				echo "Update failed!";
			}
		}else{
			//print("New Record");
			$paramArr = array();
			$paramArr['param']="dollar_rate";
			$paramArr['paramVal']=$dollar_rate;
			$paramArr['fy']=$fy;
			echo $this->_model->insertRecord($paramArr,"fundparameters");
		}
		
	 }
public function changeExchangeRate(){
	 	$exchange_rate = $this->choice[1];
		$fy=$this->choice[3];
		
		$exchange_rate_chk_cond = $this->_model->where(array(array("where","param",'exchange_rate',"="),array("AND","fy",$fy,"=")));
		$exchange_rate_chk = $this->_model->getAllRecords($exchange_rate_chk_cond,"fundparameters");
		if(count($exchange_rate_chk)>0){
			//print("Update");
			$set = array("paramVal"=>$exchange_rate);
			$update_qry = $this->_model->updateQuery($set,$exchange_rate_chk_cond,"fundparameters");
			if($update_qry===1){
				echo "Record Updated successfully!";
			}else{
				echo "Update failed!";
			}
		}else{
			//print("New Record");
			$paramArr = array();
			$paramArr['param']="exchange_rate";
			$paramArr['paramVal']=$exchange_rate;
			$paramArr['fy']=$fy;
			echo $this->_model->insertRecord($paramArr,"fundparameters");
		}
		
	 }
     public function editMenu(){
        $cond = $this->model->where(array("where"=> array("mnID",$this->choice[3],"=")));
        $sets = array($this->choice[0]=>$this->choice[1]);
        $data = $this->model->updateQuery($sets,$cond);
        //$menu = $this->model->getAllRecords();
        //$view_arr = array($data,$menu);
        //$this->load_menu->menu($menu); 
        $this->template->view("",$data);
        //$this->template->view("welcome/footer");  
     }
     public function profile($render=1,$path="",$tags=array("All")){

     }
	 public function editUserProfile(){
	 	 $uname = $this->choice[1];
         $pass = $this->choice[3];
         $cond = $this->_model->where(array(array("where","username",$uname,"=")));
		 $sets = array("password"=>$pass);
		 $qry = $this->_model->updateQuery($sets,$cond,"users");
		 //print($qry);
		 if($qry===1){
		 	echo "Update Successful!";
		 }else{
		 	echo "Error Occured: Update unsuccessful!";
		 }
	 }
     
     public function confirmUserExist(){
         $uname = $this->choice[1];
         $pass = $this->choice[3];
         $cond = $this->_model->where(array(array("where","username",$uname,"="),array("AND","password",$pass,"=")));
         $qry = $this->_model->getAllRecords($cond,"users");
		 $cnt = count($qry);
		 
		 print($cnt);
     }
	public function plansHeaderUpload($render=1,$path="",$tags=array("3","9")){
		$cond  = $this->_model->where(array(array("where","userlevel",1,"=")));
		$qry=$this->_model->getAllRecords($cond,"users",'ORDER BY fname ASC');
		return $qry;
		
	}
	public function uploadplansheader(){
        set_time_limit(3600); 
        $fy=$_POST['fy'];
        $cond = $this->_model->where(array(array("where","fy",$fy,"=")));
		$qry = $this->_model->getAllRecords($cond,"planheader");
		$cnt = count($qry);
		if($cnt>0){
			print("Budgets for the FY{$fy} have already been initiated. Please consider deleting them or updating the records!");
		}else{
	        $file = $_FILES['plansheader']['tmp_name'];
			$handle = fopen($file,"r");
	    	$rec=array();
			$recNums=0;
			while($data = fgetcsv($handle,1000,",","'")){
				$recNums++;
				$rec['fy']=$data[0];
				$rec['icpNo']=$data[1];
				$this->_model->insertRecord($rec,"planheader");
			}
			print($recNums." records uploaded successfully!");
			
		}
        
    }
	public function uploadfundsbalances($render=1,$path='',$tags=array("All")){
		//return "Hello";
		$cond_icps = $this->_model->where(array(array("where","userlevel",1,"=")));
		$icps_qry = $this->_model->getAllRecords($cond_icps,"users");
		return $icps_qry;
	}
	public function massFundsUpload(){
		$closureDate = $_POST['closureDate'];
		$file = $_FILES['fundsCsv']['tmp_name'];
		$handle = fopen($file, "r");
				$rec=array();
				$rec_body=array();
				$recNum=0;

				$this->_model->deleteQuery("","opfundsbalheader");
				$this->_model->deleteQuery("","opfundsbal");					
				
				while($data=fgetcsv($handle,1000,",","'")){
						$rec['icpNo']=$data[0];
						$rec['totalBal']=$data[8];
						$rec['closureDate']=$closureDate;
						$rec['allowEdit']=1;
						$rec['systemOpening']=1;
						$this->_model->insertRecord($rec,"opfundsbalheader");
						$hd_cond = $this->_model->where(array(array("where","icpNo",$data[0],"=")));
						$hd=$this->_model->getAllRecords($hd_cond,"opfundsbalheader");
						if(count($hd>0)){
							$acc = array("100","200","300","330","351","410","510");
							for ($i=1; $i <8 ; $i++) { 								
								$rec_body['balHdID']=$hd[0]->balHdID;
								$rec_body['funds']=$acc[$i-1];
								$rec_body['Amount']=$data[$i];
								$this->_model->insertRecord($rec_body,"opfundsbal");
							}
							
						}					
					}
				print_r("Upload successful!");
				//print_r($rec_body);
		
	}
	public function viewPlansHeader($render=2,$path="",$tags=array("3","9")){
		$fy = $this->choice[1];
		$cond = $this->_model->where(array(array("where","fy",$fy,"=")));
		$qry = $this->_model->getAllRecords($cond,"planheader",'ORDER BY icpNo ASC');
		return $qry;
	}
	public function uploadSchedules(){
		//print("Jesus!");
		set_time_limit(3600);
		$fy=$_POST['fy2'];
		$icpNo = $_POST['icpNo'];
		$planType=$_POST['planType'];
		//print($fy);
		//$cond = $this->_model->where(array(array("where","planheader.fy",$fy,"="),array("AND","planheader.icpNo",$icpNo,"=")));
		$cond = $this->_model->where(array(array("where","fy",$fy,"="),array("AND","icpNo",$icpNo,"=")));
		//$qry = $this->_model->fetchSchedulesforFy($cond);
		$qry=$this->_model->getAllRecords($cond,"planheader");
		$planHeaderID=$qry[0]->planHeaderID;
		
		$cond_schedules = $this->_model->where(array(array("where","planHeaderID",$planHeaderID,"="),array("AND","planType",$planType,"=")));
		$qry_schedules = $this->_model->getAllRecords($cond_schedules,"plansschedule");
		
		
		$cnt = count($qry_schedules);
		if($cnt>0){
			$this->_model->deleteQuery($cond_schedules,"plansschedule");
			print("Budget schedules for {$icpNo} for  FY{$fy} had already been uploaded. The previous schedules have been deleted!\n");
			//print("Budget header not available!");
		}
		$file = $_FILES['plansschedules']['tmp_name'];
			if(empty($file)){
				print("Browse to Upload a file");	
			}else{
				$handle = fopen($file, "r");
				$rec=array();
				$recNum=0;
				while($data=fgetcsv($handle,1000,",","'")){
					$recNum++;
					$rec['planHeaderID']=$planHeaderID;
					$rec['planType']=$planType;
					$rec['AccNo']=$data[0];
					$rec['details']=$data[1];
					$rec['qty']=$data[2];
					$rec['unitCost']=$data[3];
					$rec['often']=$data[4];
					$rec['totalCost']=$data[5];
					$rec['JulAmt']=$data[6];
					$rec['AugAmt']=$data[7];
					$rec['SepAmt']=$data[8];
					$rec['OctAmt']=$data[9];
					$rec['NovAmt']=$data[10];
					$rec['DecAmt']=$data[11];
					$rec['JanAmt']=$data[12];
					$rec['FebAmt']=$data[13];
					$rec['MarAmt']=$data[14];
					$rec['AprAmt']=$data[15];
					$rec['MayAmt']=$data[16];
					$rec['JunAmt']=$data[17];
					$rec['notes']=$data[18];
					$this->_model->insertRecord($rec,"plansschedule");
				}
				$del_cond = $this->_model->where(array(array("where","details","","="),array("OR","totalCost",0,"=")));
				$del = $this->_model->deleteQuery($del_cond,"plansschedule");
				print($recNum ." records uploaded successfully!");
			}

}

public function general($render=1,$path='',$tags=array("All")){
	$siteOff_cond = $this->_model->where(array(array("where","info","offline","=")));
	$siteOff_arr = $this->_model->getAllRecords($siteOff_cond,"extras");
	$siteOff_flag = $siteOff_arr[0]->flag;
	$msg = $siteOff_arr[0]->other;
	
	$data=array();
	$data['siteOff']=$siteOff_flag;
	$data['msg']=$msg;
	
	return $data;
}

public function getOfflineMsg(){
	echo $this->choice[1];
}

public function siteOff(){
	$state = $this->choice[1];
	$siteOff_cond = $this->_model->where(array(array("where","info","offline","=")));
	$sets = array("flag"=>$state);
	$rst = $this->_model->updateQuery($sets,$siteOff_cond,"extras");
	if($state==='1'&&$rst===1){
		echo "Offline Mode ON";
	}else{
		echo "Offline Mode OFF";
	}	
}

public function showUsersList($render=2,$path='',$tags=array("All")){
	$grp =  $this->choice[1];
	$cond = $this->_model->where(array(array("where","users.userlevel",$grp,"=")));
	$qry = $this->_model->getUsersByPosition($cond);
	
	$data = array();
	$data['users']=$qry;
	$data['cat']=$grp;
	
	return $data;
}

public function addUserToCategory($render=2,$path='',$tags=array("All")){
	$cat = $this->choice[1];
	$cond_users = $this->_model->where(array(array("where","userlevel",$cat,"=")));
	$qry_users = $this->_model->getAllRecords($cond_users,"users");
	
	$data = array();
	$data['users']=$qry_users;
	
	return $data;
	
}

}