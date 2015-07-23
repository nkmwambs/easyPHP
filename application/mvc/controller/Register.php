<?php
class Register_Controller extends E_Controller{
private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Register_Model("users");
    }

    public function userRegister($render=1,$path="",$tags=array("0","All")) {
		//$menu=$this->model->getAllRecords("","menu");
		//$this->load_menu->menu($menu);
		//$this->template->view();
		//$this->template->view("Welcome/footer");            
        }

    public function submitUser(){

            //foreach($_POST as $key=>$value):
              //  if($key==='password'){
                //    $_POST[$key]=  md5($value);
                //}
            //endforeach; 
            array_pop($_POST);
			$arr = $_POST;
            $cond = $this->_model->where(array(array("where","username",$_POST['username'],"="),array("AND","uname",$_POST['uname'],"=")));
            $rst = $this->_model->getAllRecords($cond,"users");
            if(count($rst)===0){
                
                echo $this->_model->insertRecord($arr,"users");
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
}