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
			return $rst;        
        }

    public function submitUser(){

            array_pop($_POST);
			$arr = $_POST;
            $cond = $this->_model->where(array(array("where","username",$_POST['username'],"="),array("AND","email",$_POST['email'],"=")));
            $rst = $this->_model->getAllRecords($cond,"users");
			//print_r($_POST);
		    if(count($rst)===0){
                $_POST['admin']='0';
				$_POST['cname']=Resources::session()->cname;
				$_POST['userlevel']='1';
				$_POST['delegated_role']='0';
				$_POST['auth']='1';
				$_POST['log_after_register']='0';
				$_POST['securityQstnID']='0';
				$_POST['qAns']='0';
				//$_POST['reffererID']=Resources::session()->ID;
               //echo $this->_model->insertRecord($arr,"users");
               print_r($_POST);
            }  else {
                echo "The username {$_POST['username']} or email {$_POST['uname']} is already used!";
            }
		    
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
