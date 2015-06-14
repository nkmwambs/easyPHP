<?php
class Users{
	private static $model;

	public function __construct(){
		
	}
	
	private static function setUser($id){
		self::$model=new E_Model("users");
		$cond = self::$model->where(array(array("where","ID",$id,"=")));
		$rst = self::$model->getAllRecords($cond,"users");
		return $rst;		
	}
	
	public static function userRights($getid){
		if(is_array(self::setUser($getid))&&!empty(self::setUser($getid))){
			$_SESSION['rights']=self::setUser($getid)[0]->admin;
		}else{
			$_SESSION['rights']=0;
		}
		
		return $_SESSION['rights'];
	}
	
	public static function userCredentials($getid){
		//return self::setUser($getid);
		$credentials=array();
		$required_keys = array("username"=>"LogName","fname"=>"RealName","lname"=>"OtherName","email"=>"Contact",
		"admin"=>"AdminRights","userlevel"=>"AccessLevel","delegated_role"=>"Delegation","department"=>"Department",
		"logs_after_register"=>"NumberOfLogs");
		foreach (self::setUser($getid)[0] as $key=>$value) {
			if(array_key_exists($key, $required_keys)){
				$credentials[$required_keys[$key]]=$value;
			}
		}
		return (object)$credentials;
	}

}
?>