<?php
class Resources{


public static function import($path){
		$path_arr = explode(".", $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;

		if(file_exists(BASE_PATH.DS."system".DS."libs".$path_str.".class.php")){
			$fPath = BASE_PATH.DS."system".DS."libs".$path_str.".class.php";
		}else{
			$fPath = BASE_PATH.DS."system".DS."libs".$path_str.".php";
		}
		
		require_once $fPath;
	}
public static function includes($path,$separator="."){
	//if(file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."includes".DS.$url)){
		//	include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."includes".DS.$url.".php";
		//}
		$path_arr = explode($separator, $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;

		if(file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."includes".$path_str.".php")){
			$fPath = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."includes".$path_str.".php";
		}
		
		require_once $fPath;
}

public static function mailing($mailto,$subject,$msg){

 	// use wordwrap() if lines are longer than 70 characters
 	$msg = wordwrap($msg,70);
	//Headers
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n"; 
	$headers .= "From: admin@compassionkenya.com";
 	// send email
 	mail($mailto,$subject,$msg,$headers);
}	 
public static function ie_detect()
{
	$x=1;
	//strpos($_SERVER['HTTP_USER_AGENT'], ' rv:11.0')
	 if ($x===1){
        //header( 'Location: http://www.domain.com' ) ;
        return 1;
    }else{
    	return 0;
    }
}	 
	 
public static function url($url){
    return HOST_NAME.DS."easyPHP/".$GLOBALS['app']."/".$url;
}
public static function a_href($path,$text,$properties=""){
    //property array example - array("width"=>"80px","heigth"=>"90px","title"=>"Petty","style"=>"margin-top:10px;border:5px solid black;")
    //$str  = "<a href='http://".filter_input(INPUT_SERVER,"HTTP_HOST")."/easyPHP/".$GLOBALS['app']."/".$path."' ";
    if($path===""){
    	$str  = "<a href='#' ";
    }else{
    	$str  = "<a href='".HOST_NAME.DS.'easyPHP'.DS.$GLOBALS['app'].DS.$path."' ";
    }
    
    
    if(is_array($properties)){
        foreach ($properties as $key => $value) {
                $str .= " ".$key. "= '".$value ."' ";
        }
    }
    
    $str .="/>$text</a>";
    return $str;
}
public static function img($path,$properties=""){
    
    if(file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."images".DS.$path)){
        $str = "<img src='http://".$_SERVER['HTTP_HOST']."/easyPHP/application/".$GLOBALS['app']."/images/".$path."'";

    }  else {
        $str = "<img src='http://".$_SERVER['HTTP_HOST']."/easyPHP/system/images/".$path."'"; 
    }
    

    if(is_array($properties)){
        foreach ($properties as $key => $value) {
                $str .= " ".$key. "= '".$value ."' ";
        }
    }
    $str .="/>";
    return $str;
}
public static function link($links=array()){
    
        //Load grouped default app level css

if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['Controller'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['Controller'].".css'>\n";
    }
    
        //Load single default app level js
    
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['app'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['app'].".css'>\n";
    }
    
    
        //Load grouped default app level css
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['app'].DS.$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load grouped default Controller level css
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['Controller'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['Controller'].DS.$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load specified css file in css folders. App level css has high preference    
    
    foreach($links as $value){
        if(!file_exists(BASE_PATH.DS.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$value)){
            print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."system".DS."scripts".DS."css".DS.$value."'>\n";
        }  else {
            print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$value."'>\n";
        }
    }
	
    
    $dir = BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."scripts".DS."css";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."scripts".DS."css".DS.$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
	
	$dir = BASE_PATH.DS."system".DS."scripts".DS."css";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME.DS.'easyPHP'.DS."system".DS."scripts".DS."css".DS.$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    	
}
public static function script($scripts){
    
    //Load grouped default app level js
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['app'].DS.$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load grouped default Controller level js
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['Controller'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['Controller'].DS.$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
	
	
    
    
    //Load specified js file in js folders. App level js has high preference
    foreach ($scripts as $value) {
        if(!file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$value)){
            print "<script src='".HOST_NAME.DS.'easyPHP'.DS."system".DS."scripts".DS."js".DS.$value."'></script>\n";
        }  else {
            print "<script src='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$value."'></script>\n";
        }
    }
    
      //Load single default app level js
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['app'].".js")){
        print "<script src='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['app'].".js'></script>\n";
    }
    
    //Load single default Controller level js
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['Controller'].".js")){
        print "<script src='".HOST_NAME.DS.'easyPHP'.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['Controller'].".js'></script>\n";
    }
	$dir = BASE_PATH.DS.'system'.DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS.'scripts'.DS."js";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME.DS.'easyPHP'.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."scripts".DS."js".DS.$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }

}
    public static function func($func_name,$var = array()){
        //if(is_array($param)){
            //foreach ($param as $func_name):
                if(realpath(BASE_PATH.DS.'system'.DS.'functions'.DS.$func_name.".php"))
                    {
                        require_once BASE_PATH.DS.'system'.DS.'functions'.DS.$func_name.".php";
                    }  else {
                        require_once BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'functions'.DS.$func_name.".php";
                    }
					
					if(count($var)===0){
						return $func_name();
					}else{
						$str = implode(",",$var);
						return $func_name($str);
					}
					
            //endforeach;
        //}        
    }
public static function menuItems(){
			$model = new E_Model("menu");
			//$rec_cond=  $model->where(array("where"=>array("userid",self::session()->ID,"=")));
			$rec_cond= $model->where(array(array("where","userid",self::session()->ID,"=")));
            $recent = $model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");    
            return $recent;
}
public static function render($render="1",$path="",$results=""){
		$model = new E_Model("menu");
		$recent = self::menuItems();
		$menu = $model->getAllRecords();
		
		$users_online_arr=array();
		if(self::session()->ID!=='0'){
			$users_online_cond = $model->where(array(array("where","sess_state",1,"=")));
			$users_online_arr = $model->getAllRecords($users_online_cond,"user_sessions","ORDER BY sess_id DESC LIMIT 0,10");
		}
			
		
		
        /**
         * $menu - A multi-dimensional array with all rows of the menus table
         * This part of the function makes an array of the string found in the exception field of each row of the menu table using the explode function
         * with delimiter comma(,). Each element of this array represents a user excepted.
         * Each of the array above is then exploded into an array delimited by Equals(=). The first element of this array is the username and the second
         * is the menus field the whose rules the user is excepted from
         */
        foreach($menu as $exc){ 
            $exc_key_arr = explode(",",$exc->exception);
            foreach($exc_key_arr as $exc_key_split){
                $key_splitter  = explode("=",$exc_key_split);
                if($key_splitter[0]===$_SESSION['username']){
                    $ex_key =  $key_splitter[1];
                }  else {
                    $ex_key=null;
                }
            }
        }
        
        //Check Visibility by Userlevel
        $final_userlevel=  array();
        foreach($menu as $value_usr){
            $vis = explode(",",$value_usr->userlevel);
            //print_r($vis);
            foreach($vis as $vis_value){
                if($vis_value===$_SESSION['userlevel']){
                    $final_userlevel[]=$value_usr;
                }
            }
        }
        
        //Allow visibility for items by todate field
        $final_dates=  array();
        foreach ($final_userlevel as $value_dates_null){
            if($value_dates_null->todate==='0=0000-00-00'){
                $final_dates[]=$value_dates_null;
            }  else {
                $vis_date_null_outer = explode(",",$value_dates_null->todate);
                    foreach($vis_date_null_outer as $vis_date_null_outer_value){
                        $vis_date_null_inner = explode("=",$vis_date_null_outer_value);
                            if($vis_date_null_inner[0]===$_SESSION['userlevel'] && (strtotime(date('Y-m-d'))<=strtotime($vis_date_null_inner[1]) || $vis_date_null_inner[1]==='0000-00-00')){
                                $final_dates[]=$value_dates_null;
                            }
                    }
                
            }
            
        }
        
        //Allow visibility for items by reoccur
        $reoccur = array();
        foreach($final_dates as $reoccur_day){
            if($reoccur_day->reoccur==="0=0-0"){
                $reoccur[] = $reoccur_day;
                
            }else{
                 $reoccur_day_outer = explode(",",$reoccur_day->reoccur);
                 
                 foreach($reoccur_day_outer as $reoccur_day_value){
                     $reoccur_day_inner = explode("=",$reoccur_day_value);
                        if($reoccur_day_inner[0]===$_SESSION['userlevel']){
                            $reoccur_day_inner_two = explode("-",$reoccur_day_inner[1]);
                            if($reoccur_day_inner_two[0]>$reoccur_day_inner_two[1]){
                                $current_reoccur_start_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[0]));
                                $current_reoccur_end_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[1],'+ 1 month'));
                            }else{
                                $current_reoccur_start_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[0]));
                                $current_reoccur_end_date = strtotime(date('Y-m-'.$reoccur_day_inner_two[1]));
                            }
                            //echo date('Y-m-'.$reoccur_day_inner_two[0]);
                            if((strtotime(date('Y-m-d'))>=$current_reoccur_start_date && strtotime(date('Y-m-d'))<=$current_reoccur_end_date) || $reoccur_day_inner_two[0]==='0'){
                                $reoccur[] = $reoccur_day;
                            }
                            
                            
                        }
                 }
            }
            
        }
        
        //$admin = array();
        for($i=0;$i<count($reoccur);$i++){
            if($reoccur[$i]->admin==='1'&&$_SESSION['admin']!=='1'){
                array_splice($reoccur,$i,1);
            }
        }
        
        
        $menu_data=  array();
        $side_menu_data=  array();
        foreach ($reoccur as $value) {
            if(strpos($value->selfID,"_")==false){
                $inner['name']=  ucfirst($value->selfTitle);
                $inner['url']=  ucfirst($value->url);
                $inner['img']=$value->link_img;
                array_push($menu_data,$inner);
                
            }  else {
                $chk_parent_array = explode("_",$value->selfID);
                if(ucfirst($chk_parent_array[1])===ucfirst($GLOBALS['Controller'])){
                $inner_side['name']=  ucfirst($value->selfTitle);
                $inner_side['url']=  ucfirst($value->url);
                $inner_side['img']=$value->link_img;
                array_push($side_menu_data,$inner_side);
                }
               
            }
        }
		
		//$rec_cond=  $model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        //$recent = $model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 
		//echo $render;
		if($render===1){
			if(file_exists(BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."header.php")){
				$data = $menu_data;		
				include BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."header.php";
			}
	        if(file_exists(BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."side_bar.php")){
				$data['side'] = $side_menu_data;
				$data['users']=$users_online_arr;
				include BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."side_bar.php";
			}
		}
			if($path===""&&file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$GLOBALS['Controller'].DS.$GLOBALS['Method'].".php")){
				$data = $results;
	            include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$GLOBALS['Controller'].DS.$GLOBALS['Method'].".php";
				
			}elseif(file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$GLOBALS['Controller'].DS.$path.".php")){
				$data = $results;
				include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$GLOBALS['Controller'].DS.$path.".php";
			}else{
				if($path==="err"){
					$data = self::img("error.png")." Error Log:<br>".$results;
				}else{
					$data = self::img("error.png")." Error Log:<br>View <i><span style='color:blue;'>{$path}</span></i> not found in Method <i><span style='color:blue;'>{$GLOBALS['Method']}</span></i> of <i><span style='color:blue;'>{$GLOBALS['Controller']}</span></i> controller!";
				
				}
				
				include BASE_PATH.DS."system".DS."logs".DS."error.php";
			}
		if($render===1){
			if(file_exists(BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."side_bar.php")){
				$data = $recent;
				include BASE_PATH.DS."system".DS."extensions".DS."themes".DS.$GLOBALS['theme'].DS."footer.php";
			}
		}
		//return $recent;
    }

public static function session(){
	return (object)$_SESSION;
}

}
?>