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
	//Update number of logs after register	
	$log_calc=0;
	$log_cond = $this->_model->where(array(array("where","username",Resources::session()->username,"=")));
	$logs = $this->_model->getAllRecords($log_cond,"users");
	$log_calc=$logs[0]->logs_after_register+1;
	
	$log_set = array("logs_after_register"=>$log_calc);
	$this->_model->updateQuery($log_set,$log_cond,"users");
	
	//Check there is the current user active session
	$this->end_session();
	
	//Record a Session
	$sess_arr = array();
	$sess_arr['user_id']=Resources::session()->ID;
	if(Resources::session()->userfirstname===""){
		$sess_arr['user_fname']=Resources::session()->fname;
	}else{
		$sess_arr['user_fname']=Resources::session()->userfirstname;
	}
	$sess_arr['sess_start']=time();
	$sess_arr['sess_end']=0;
	$sess_arr['sess_state']=1;
	if(Resources::session()->ID!=='0'){
		$this->_model->insertRecord($sess_arr,"user_sessions");
	}
	
}
public function end_session(){
	$set = array("sess_state"=>0,"sess_end"=>time());
	$sess_cond = $this->model->where(array(array("where","user_id",Resources::session()->ID,"="),array("AND","sess_state",1,"=")));
	$this->_model->updateQuery($set,$sess_cond,"user_sessions");
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
				
				$subject="Password Reset";
				
				$datetime = date("Y_m_d_H_i_s");
				
				$msg=Resources::load_mail_template("passResetAfterLog.html",array("username"=>Resources::session()->username,"password"=>$_POST['password'],"firstname"=>Resources::session()->userfirstname,"datetime"=>$datetime));
			
				echo Resources::mailing(Resources::session()->email, $subject, $msg);
				
				echo "Password Reset Successful!";
            }else{
            	echo "Error Occurred!";
            }
}
public function login($render=2,$path='',$tags=array("0")){
	users::unset_log_sessions();
	
}

    
public function logout($render=1,$path="show",$tags=array("0")){
		$this->end_session();
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
            if(isset($this->choice[1])){
            	 $cond_users = $this->model->where(array(array("where","username",$this->choice[1],"=")));
				  $results = $this->_model->getAllRecords($cond_users,"users");
        
                    if(is_array($results)&&sizeof($results)>0){
                            foreach($results[0] as $key=>$value):
                                $_SESSION[$key]=$value;
                            endforeach;
                    }

                    
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
public function forgotPass($render=1,$path='',$tags=array("0")){
	$data=array();
	
	//Security Questions
	$qstns = $this->_model->getAllRecords("","securityqueries");
	
	$data['qstns']=$qstns;
	$data['test']="";
	return $data;
}
public function forgotPassReset(){
	//print_r($_POST);
	$email = $_POST['email'];
	$qstn = $_POST['securityQstnID'];
	$qAns = $_POST['qAns'];
	$fPassword = $_POST['password'];
	$newPass="";
	$sets="";
	
	if($email){
		//echo "Email Present";
		$email_cond = $this->_model->where(array(array("where","email",$email,"="),array("AND","auth",1,"=")));
		$email_arr = $this->_model->getAllRecords($email_cond,"users");
		if(!empty($email_arr)){
			$newPass=Resources::func("generateRandomString");
			$sets = array("password"=>$newPass);
			$this->_model->updateQuery($sets,$email_cond,"users");
			//$subject = "New Login details";
			//$msg="You have been provided with new login details as follows:<br>";
			//$msg.="Username: ".$email_arr[0]->username."<br>";
			//$msg.="Password: ".$newPass."<br>";
						
			//$msg = file_get_contents(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."docs/mail_templates".DS.'resetPass.html');
			//$msg = str_replace('%username%', $email_arr[0]->username, $msg);
			//$msg = str_replace('%password%', $newPass, $msg);
			//$msg = str_replace('%firstname%', $email_arr[0]->userfirstname, $msg);
			
			$subject="Password Reset";
			
			$msg=Resources::load_mail_template("resetPass.html",array("username"=>$email_arr[0]->username,"password"=>$newPass,"firstname"=>$email_arr[0]->userfirstname));
			
			Resources::mailing($email, $subject, $msg);
			
			echo "<div id='error_div'>A new password has been mailed to you.</div>";
			
		}else{
			echo "<div id='error_div'>Email Missing</div>";
		}
	}elseif($qstn){
		echo "<div id='error_div'>This feature is not functional:- Use Email option only!</div>";
	}elseif($fPassword){
		echo "<div id='error_div'>This feature is not functional:- Use Email option only!</div>";
	}else{
		echo "<div id='error_div'>Please provide atmost one item or User blocked</div>";
	}
	
}
public function notifyPassChange($render=1,$path='',$tags=array("0")){
			
			$data=array();
				
			$username=$this->choice[1];
			$datetime=$this->choice[3];
			$subject="Anonymous Password Change Notification";
			
			$msg=Resources::load_mail_template("anonymousPassReset.html",array("username"=>$username,"datetime"=>$datetime));
			
			Resources::mailing("NKarisa@ke.ci.org", $subject, $msg);
			
			$data="<div id='error_div'>A notice has been mailed to the administrator</div>";
			
			return $data;
}
public function test($render=1,$path='',$tags=array("0","All")){

}
public function filterschedule(){
	//$cond_users =  Resources::create_condition($_POST);
	//$qry = $this->_model->getAllRecords($cond_users,"fundsschedule");
	//print_r(json_encode($qry));
	
	$this->create_grid($_POST,"fundsschedule");
}
public function editgrid(){
	//$id = $_POST['id'];
	//$field = $_POST['field'];
	//$newVal = $_POST['newVal'];
	
	//$update_set = array($field=>$newVal);
	//$update_cond = $this->_model->where(array(array("where","ID",$id,"=")));
	//$update_qry = $this->_model->updateQuery($update_set,$update_cond,"fundsschedule");
	
	//echo "Update Successfully!";
	$this->editable_grid($_POST,"fundsschedule","ID");
}
}