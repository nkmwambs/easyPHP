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
	public function viewPlansHeader($render=2,$path="",$tags=array("9")){
		//print("Hello All Of You");
		$fy = $this->choice[1];
		$cond = $this->_model->where(array(array("where","fy",$fy,"=")));
		$qry = $this->_model->getAllRecords($cond,"plansheader",'ORDER BY icpNo ASC');
		return $qry;
	}
	public function uploadSchedules(){
		//print("Jesus!");
		set_time_limit(3600);
		$fy=$_POST['fy2'];
		//print($fy);
		$cond = $this->_model->where(array(array("where","plansheader.fy",$fy,"=")));
		$qry = $this->_model->fetchSchedulesforFy($cond);
		$cnt = count($qry);
		if($cnt===0){
			$file = $_FILES['plansschedules']['tmp_name'];
			if(empty($file)){
				print("Browse to Upload a file");	
			}else{
				$handle = fopen($file, "r");
				$rec=array();
				$recNum=0;
				while($data=fgetcsv($handle,1000,",","'")){
					$recNum++;
					$rec['planHeaderID']=$data[0];
					$rec['planType']=$data[1];
					$rec['AccNo']=$data[2];
					$rec['details']=$data[3];
					$rec['qty']=$data[4];
					$rec['unitCost']=$data[5];
					$rec['often']=$data[6];
					$rec['totalCost']=$data[7];
					$rec['JulAmt']=$data[8];
					$rec['AugAmt']=$data[9];
					$rec['SepAmt']=$data[10];
					$rec['OctAmt']=$data[11];
					$rec['NovAmt']=$data[12];
					$rec['DecAmt']=$data[13];
					$rec['JanAmt']=$data[14];
					$rec['FebAmt']=$data[15];
					$rec['MarAmt']=$data[16];
					$rec['AprAmt']=$data[17];
					$rec['MayAmt']=$data[18];
					$rec['JunAmt']=$data[19];
					$this->_model->insertRecord($rec,"plansschedule");
				}
				print($recNum ." records uploaded successfully!");
			}
				
			
		}else{
			print("Mass upload aborted because some budget schedules for FY{$fy} have already been uploaded. Please consider deleting them or updating the records!");
		}
	}
}