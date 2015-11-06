<?php
class Register_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Register_Model("users");
    }

    public function userRegister($render=1,$path="",$tags=array("All")) {
			//print_r($_POST);  
			$rst = $this->_model->getAllRecords("","securityqueries");
			
			$icp_cond='';
			$clst_cond='';
			if(Resources::session()->userlevel==='2'){
				$icp_cond = $this->_model->where(array(array("where","cname",Resources::session()->cname,"="),array("AND","userlevel",1,"=")));
				$clst_cond=$this->_model->where(array(array("where","cname",Resources::session()->cname,"=")));
			}
			$clst = $this->_model->getAllRecords($clst_cond,"users","GROUP BY cname");
			$icps = $this->_model->getAllRecords($icp_cond,"users");
			
			$data=array();
			
			$data['secQtn']=$rst;
			$data['icps']=$icps;
			$data['clst']=$clst;
			return $data;        
        }

public function submitUsers(){
			$icp = $_POST['fname'];
			
			$arr = array();
            $cond = $this->_model->where(array(array("where","username",$_POST['username'],"=")));
            $rst = $this->_model->getAllRecords($cond,"users");
			
			//Get ICP fullname
			$icp_cond = $this->_model->where(array(array("where","fname",$icp,"=")));
			$icp_arr = $this->_model->getAllRecords($icp_cond,"users","",array("lname"));
			
		    if(count($rst)===0){
		    	$arr['username']=$_POST['username'];	
				$arr['userfirstname']=$_POST['userfirstname'];
				$arr['userlastname']=$_POST['userlastname'];
				$arr['fname']=$_POST['fname'];
				$arr['lname']=$icp_arr[0]->lname;
				$arr['cname']=$_POST['cname'];
				$arr['email']=$_POST['email'];
				$arr['password']=$_POST['password'];
				$arr['admin']=0;
				$arr['userlevel']=1;
				$arr['delegated_role']=0;
				$arr['department']=$_POST['department'];
				$arr['auth']=1;
				$arr['logs_after_register']=0;
				$arr['securityQstnID']=$_POST['securityQstnID'];
				$arr['qAns']=$_POST['qAns'];
				$arr['reffererID']=Resources::session()->ID;
				
               	echo $this->_model->insertRecord($arr,"users");
            }  else {
                echo "The username {$_POST['username']} is already used!";
            }
		    
        }
	public function getICPs(){
		$clst = $_POST['cstName'];
		//echo $clst;
		$icps_cond = $this->_model->where(array(array("where","cname",$clst,"="),array("AND","userlevel",1,"="),array("AND","department","0","=")));
		$icps_arr = $this->_model->getAllRecords($icps_cond,"users");
		echo  json_encode($icps_arr);
	}
    public function changePwd(){
            //print_r($_POST);
        $encrypt_pwd = md5($_POST['oldPassword']);
        $new_encrypt_pwd = md5($_POST['password']);
        $change_cond = $this->_model->where(array("where"=>array("username",$_SESSION['username'],"="),"AND"=>array("password",$encrypt_pwd,"=")));
        $rlst_rec = $this->_model->getAllRecords($change_cond,"users");
        //print_r($rlst_rec);
        if(count($rlst_rec)>0){
            //echo "User with the provided current password is available!";
            $cnd_set =  $this->_model->where(array("where"=>array("username",$_SESSION['username'],"=")));
            $set = array("password"=>$new_encrypt_pwd,"logs_after_register"=>1);
            $resp = $this->_model->updateQuery($set,$change_cond,"users");
            if($resp===1){
                echo "Password changed successfully!";
            }else{
                echo $resp;
            }
        }  else {
            echo "User with the provided current password is unavailable";
        }
    }  
public function forgotPass($render=1,$path='',$tags=array("All")){
	$rst = $this->_model->getAllRecords("","securityqueries");
	return $rst;
}  
}
