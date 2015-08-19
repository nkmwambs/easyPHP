<?php 
class Welcome_Controller extends E_Controller{
public $_model;
//public $__model;
    public function __construct(){
        parent::__construct();
        //$this->helper->load("img");
        $this->_model=new Welcome_Model("users");
        //$this->__model=new Welcome_Model("extras");
    }
    public function popup($render=1){
    }
    public function error($render=1,$path="Welcome/error"){
            $data = $_SESSION['error_msg'];
            return $data;
    }
	public function offline($render=1,$path='',$tags=array("0","All")){
		
	}
public function updateLogs(){
	$log_calc=0;
	$log_cond = $this->_model->where(array(array("where","username",Resources::session()->username,"=")));
	$logs = $this->_model->getAllRecords($log_cond,"users");
	$log_calc=$logs[0]->logs_after_register+1;
	
	$log_set = array("logs_after_register"=>$log_calc);
	$this->_model->updateQuery($log_set,$log_cond,"users");
}
public function show(){
		$siteOff_cond = $this->_model->where(array(array("where","info","offline","=")));
		$siteOff_arr = $this->_model->getAllRecords($siteOff_cond,"extras");
		$siteOff_flag = $siteOff_arr[0]->flag;
		$msg = $siteOff_arr[0]->other;
	
    	$offline_cond = $this->model->where(array(array("where","info","offline","="),array("AND","flag",1,"=")));
		$offline_arr = $this->model->getAllRecords($offline_cond,"extras");
		
		//print_r($offline_arr);
		$msg='';
		$render="";
		$path="";
		$data['return']="";
		$data['msg']="<div id='error_div'>".$msg."</div>";
		if(count($offline_arr)>0&&empty($_POST)){
			$data['return']='';
			$path='offline';
			$render=2;
		}elseif(isset($_POST)&&!empty($_POST)){
			$cond = $this->_model->where(array(array("where","username",$_POST['username'],"="),array("AND","password",$_POST["password"],"="),array("AND","auth","1","=")));
			$results = $this->_model->getAllRecords($cond,"users");
					if(is_array($results)&&count($results)>0){
						users::log_sessions($results);
			            $data['return'] ="";
			        }  else{
			        	$data['return']="<div id='error_div'>Error in Login. Username or Password Mismatch or User Blocked</div>";
			        }
					
					if((count($offline_arr)>0&&Resources::session()->admin==='1')||(count($offline_arr)===0)){
						$render=1;
						if(Resources::session()->logs_after_register==='0'&&$data['return']===""){
							$path='passReset';	
						}else{
							$path='show';
							$this->updateLogs();
						}
						
					}else{
						$path='offline';
						$render=2;
						$data['return']="Only Admin Allowed";
					}
				
		}else{
					$render=1;
					$path="show";
					$data['return']='';
		}
		
		$this->dispatch($render,$path,$data['return'],$tags=array("0","All"));
         
    }
	
public function logging() {

}
public function newPassReset(){
           // $pwd=  md5($_POST['password']);
            $sets = array('password'=>$_POST['password']);
            $newPwd_cond = $this->_model->where(array(array("where","username",Resources::session()->username,"=")));//"where"=>array("ID",$_SESSION['ID'],"=")
            $newPwd_rst = $this->_model->updateQuery($sets,$newPwd_cond,"users");
            if($newPwd_rst===1){
            	$sets_log = array("logs_after_register"=>1);
            	$this->_model->updateQuery($sets_log,$newPwd_cond,"users");
				
				$getPost=array();
				$getPost['userID']=Resources::session()->ID;
				$getPost['pwd']=$_POST['password'];
				$getPost['changedBy']=Resources::session()->username;
				
				$this->_model->insertRecord($getPost,"pwdbackup");
				
				echo "Password Reset Successful!";
            }else{
            	echo "Error Occurred!";
            }
}
public function login($render=1,$path='',$tags=array("0")){
	users::unset_log_sessions();
}
    
public function logout($render=1,$path="show",$tags=array("0")){
		users::unset_log_sessions();
		$siteOff_cond = $this->_model->where(array(array("where","info","offline","=")));
		$siteOff_arr = $this->_model->getAllRecords($siteOff_cond,"extras");
		$siteOff_flag = $siteOff_arr[0]->flag;
		$msg = $siteOff_arr[0]->other;
		
		$data['msg']="<div id='error_div'>".$msg."</div>";
		return $data;
}

public function profile($render=1){
         
    }
	
public function newRecent(){
        $record['itemTitle']=  $this->choice[1];
        $record['url']=  $directory = str_replace("_", "/", $this->choice[3]);
        $record['userid']=  $this->choice[5];
        $record['link_img']=  $this->choice[7];
        $cnd = $this->_model->where(array(array("where","itemTitle",$this->choice[1],"="),array("AND","userid",$_SESSION['ID'],"=")));
        $cn = $this->_model->getAllRecords($cnd,"recent");
        if(count($cn>0)){
            $this->_model->deleteQuery($cnd,"recent");
        }
        if(substr_count($this->choice[7],".")>0&&substr_count($this->choice[7],"png")>0){
            $this->_model->insertRecord($record,"recent");
        }
  
    }

public function switchUser($render=1,$path="",$tags=array("All")){	
            if(!isset($_POST)){
                 $cond = $this->model->where(array(array("where","username",$this->choice[1],"=")));
            }else{
            	 $cond = $this->model->where(array(array("where","username",$_POST["username"],"=")));
             }
			      
                    $results = $this->_model->getAllRecords($cond,"users");
        
                    if(is_array($results)&&sizeof($results)>0){
                            foreach($results[0] as $key=>$value):
                                $_SESSION[$key]=$value;
                            endforeach;
                    }

                    return $_SESSION['fname'];                     
    }
    
public function searchUser(){
        $_SESSION['search_user'] =  $this->choice[1];
        $username = $_SESSION['search_user'];
        $search=  $this->_model->searchUsers($username);
        
        if(count($search)===0){
            echo "No match Found";
        }else{
             print_r($search);
        }
    }
public function passwordReset($render=1,$path='',$tags=array("0","All")){ 
	
}
}