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
		//if(is_array(self::setUser($getid))&&!empty(self::setUser($getid))){

			//$user_arr = self::setUser($getid);
			//$_SESSION['rights']=$user_arr[0]->admin;

			//$_SESSION['rights']=$user_arr[0]->admin;
		//}else{
			$_SESSION['rights']=0;
		//}
		
		return $_SESSION['rights'];
	}
	
	public static function userCredentials($getid){
		//return self::setUser($getid);
		$credentials=array();
		$required_keys = array("username"=>"LogName","fname"=>"RealName","lname"=>"OtherName","email"=>"Contact",
		"admin"=>"AdminRights","userlevel"=>"AccessLevel","delegated_role"=>"Delegation","department"=>"Department",
		"logs_after_register"=>"NumberOfLogs");

		$user_arr =self::setUser($getid); 
		foreach ($user_arr[0] as $key=>$value) {

		foreach ($user_arr[0] as $key=>$value) {

			if(array_key_exists($key, $required_keys)){
				$credentials[$required_keys[$key]]=$value;
			}
		}
		return (object)$credentials;
	}
	}

	public static function log_sessions($results){
                foreach($results[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                    $_SESSION[$key."_backup"]=$value;
                endforeach;
            if($results[0]->admin==="1"){$_SESSION['adm']="2";}		
	}
	
	public static function unset_log_sessions(){
		    session_unset();
            $model = new E_Model("users");
            $cond = $model->where(array(array("where","ID","0","=")));
			$rst = $model->getAllRecords($cond,"users");
            self::log_sessions($rst);
	}


}
?>