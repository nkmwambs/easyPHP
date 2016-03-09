<?php
class Login_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Login_Model("users");
    }
	public function home($render=1,$path='',$tags=array("All"))
	{

	}
	public function confirm($render=1,$path='',$tags=array("All")){
	$data = array();
	$url = $this->choice;
	//Remove the first GET variable in the pathname
	array_shift($url);
	array_shift($url);
	
	$data['url']=implode("/",$url);
	$data['test']="";//implode("/",$this->choice);
	return $data;
}
		
	public function login($render=1,$path='',$tags=array("All"))
	{

	}
        
	public function show_login()
    {

    }
        
   public function logged($render=1,$path='',$tags=array("All")){
     
            $encrypted_pwd = md5($_POST['txtPassword']);
            $conds = $this->_model->where(array(array("where","username",$_POST['txtusername'],"="),array("AND","password",$encrypted_pwd,"=")));
            $rst = $this->_model->getAllRecords($conds,"users");
            if(count($rst)>0){
                foreach($rst[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                endforeach;		
                
            }  else {
                echo 1;
        }
            
    }
        
public function logout($render=1,$path="login",$tags=array("0")){
	Users::unset_log_sessions();
}
        
public function userProfile($render=1,$path='',$tags=array("All")){
                $pos_cond = $this->_model->where(array(array("where","posID",$_SESSION['userlevel'],"=")));
                $pstn = $this->_model->getAllRecords($pos_cond,"positions");
                
                $cnd = $this->_model->where(array(array("where","username",$_SESSION['username'],"=")));
                $data = $this->_model->getAllRecords($cnd,"users");
                $raw = (array)$data[0];
                array_splice($raw,5,1);
                $raw['userlevel']=$pstn[0]->title;
                if($raw['admin']==='1'){$raw['admin']="Yes";}  else {$raw['admin']="No";}
                if($raw['auth']==='1'){$raw['auth']="Yes";}  else {$raw['auth']="No";}
                //$final[] = json_decode(json_encode($raw));
				
				return $raw;
		
        }
        
        public function forgotPass($render=1,$path='',$tags=array("All")){

            $data = $this->_model->getAllRecords("","securityqueries");
			return $data;
        }
        public function passReset($render=1,$path='',$tags=array("All")){
            $email = $_POST['email'];
            $qstn = $_POST['qstn'];
            $qAns = $_POST['qAns'];
            $password=  md5($_POST['password']);
            if($qAns!==""){
                $reset_cond = $this->_model->where(array(array("where","qAns",$qAns,"="),array("AND","securityQstnID",$qstn,"=")));
                $rst_arr = $this->_model->getAllRecords($reset_cond,"users");
                if(count($rst_arr)>0){
                    $ans = 1;
                }else{
                    $ans = 0;
                }
            }  elseif($password!=="") {
                $reset_cond = $this->_model->where(array(array("where","pwd",$password,"=")));
                $rst_arr = $this->_model->getAllRecords($reset_cond,"pwdbackup","=");
                if(count($rst_arr)>0){
                    $ans = 1;
                }  else {
                    $ans = 0;    
                }
            }  else {
                $ans = 0; 
            }
            //echo $ans;
            
            if($ans===1){
               
                
                
		
		
		
            }else{
                echo $ans;
            }

        }
        
        public function newPassReset(){
            $pwd=  md5($_POST['password']);
            $sets = array('password'=>$pwd);
            $newPwd_cond = $this->_model->where(array(array("where","ID",$_SESSION['ID'],"=")));
            $newPwd_rst = $this->_model->updateQuery($sets,$newPwd_cond,"users");
            echo $newPwd_rst;
        }
        
        public function aboutus($render=1,$path='',$tags=array("All")){

        }
        
                
        public function contacts($render=1,$path='',$tags=array("All")){

        }
	
        public function notices($render=1,$path='',$tags=array("All")){

        }
        
        public function help($render=1,$path='',$tags=array("All")){

        }
		public function resource($render=1,$path='',$tags=array("All")){

        }
}
