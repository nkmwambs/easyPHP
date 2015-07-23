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
    
   public function userslist(){
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
        //Set menu Top Menu Items
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        
        //Call views
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    public function newUser(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);  
    }
    
    public function addUser(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        $data = $this->model->insertRecord(filter_input_array(INPUT_POST),"Users");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    //Positions Methods
    
    public function lists(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $data = $this->_model->getAllRecords("","Positions");
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);      
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);          
    }
    
    public function newPosition() {
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);        
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
    public function addMenu(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
        
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view();
         $this->template->view("welcome/footer",$recent);
         
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
     
     public function showAll(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
         
         $menu = $this->model->getAllRecords();
         $this->load_menu->menu($menu);
         $this->template->view("",$menu);
         $this->template->view("welcome/footer",$recent);
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
     
     public function confirmUserExist(){
         
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
}