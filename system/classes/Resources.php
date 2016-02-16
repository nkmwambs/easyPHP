<?php
class Resources{
	
public static function import($path){
		$path_arr = explode(".", $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;

		if(file_exists(BASE_PATH."/"."system"."/"."libs".$path_str.".class.php")){
			$fPath = BASE_PATH."/"."system"."/"."libs".$path_str.".class.php";
		}else{
			$fPath = BASE_PATH."/"."system"."/"."libs".$path_str.".php";
		}
		
		require_once $fPath;
}
public static function includes($path,$separator="."){
		$path_arr = explode($separator, $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;

		if(file_exists(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."includes".$path_str.".php")){
			$fPath = BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."includes".$path_str.".php";
		}
		
		require_once $fPath;
}
public static function load_mail_template($url,$params=array()){
			$msg = file_get_contents(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."docs/mail_templates"."/".$url);
			foreach($params as $key=>$value):
				$msg = str_replace('%'.$key.'%', $value, $msg);
			endforeach;
			return $msg;
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
	
	//return "<div id='error_div'>A new password has been mailed to you.</div>";
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
    return HOST_NAME."/".ROOT_FOLDER."/".$GLOBALS['app']."/".$url;
}
public static function a_href($path,$text,$properties=""){
    //property array example - array("width"=>"80px","heigth"=>"90px","title"=>"Petty","style"=>"margin-top:10px;border:5px solid black;")
    //$str  = "<a href='http://".filter_input(INPUT_SERVER,"HTTP_HOST")."/easyPHP/".$GLOBALS['app']."/".$path."' ";
    if($path===""){
    	$str  = "<a href='#' ";
    }else{
    	$str  = "<a href='".HOST_NAME."/".ROOT_FOLDER."/".$GLOBALS['app']."/".$path."' ";
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
    
    if(file_exists(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."images"."/".$path)){
        $str = "<img src='http://".$_SERVER['HTTP_HOST']."/".ROOT_FOLDER."/application/".$GLOBALS['app']."/images/".$path."'";

    }  else {
        $str = "<img src='http://".$_SERVER['HTTP_HOST']."/".ROOT_FOLDER."/system/images/".$path."'"; 
    }
    

    if(is_array($properties)){
        foreach ($properties as $key => $value) {
                $str .= " ".$key. "= '".$value ."' ";
        }
    }
    $str .="/>";
    return $str;
}
public static function get_logo($param=array()){
	$model = new E_Model("logos");	
	$cond = $model->where(array(array("WHERE","viewable",1,"=")));
	$logo_qry = $model->getAllRecords($cond,"logos");
	$url = self::img("logos/".$logo_qry[0]->url,$param);
	
	return $url;
}
public static function get_logo_text(){
	$model = new E_Model("logos");	
	$logo_qry = $model->getAllRecords("","logos");
	$title = $logo_qry[0]->title;
	
	return $title;
}
public static function table_filters($fieldset,$filter_fields,$callbackjsfunc,$callbackforedit="",$contentdiv='rst'){
	self::import("filterTables.filterTables");
	$instance = new filterTables($fieldset,$filter_fields,$callbackjsfunc,$callbackforedit,$contentdiv);
	
	$rst = $instance->filter();
	return $rst;
}
public static function create_condition($multi_array){
	//return $multi_array;
	$str = " WHERE ";
	if(is_array($multi_array)){
		for ($i=0; $i < sizeof($multi_array['fields'])-1; $i++) { 
			$str .= $multi_array['fields'][$i].$multi_array['operators'][$i]."'".$multi_array['criteriaval'][$i]."' AND ";
		}
		
		$str .= $multi_array['fields'][sizeof($multi_array['fields'])-1].$multi_array['operators'][sizeof($multi_array['fields'])-1]."'".$multi_array['criteriaval'][sizeof($multi_array['fields'])-1]."'";
	}
	
	return $str;
}
public static function smart_grid($gridArray){
	
	foreach ($gridArray as $key => $value) {
		$cnt=1;
		
		
		$grid = "<fieldset class='smart_fieldset'>";
		
		$grid .= "<span id='smart_viewall' onclick='viewallfields()'>View All Fields<INPUT TYPE='checkbox' id='smart_viewall_chk'/></span>";
		
		$grid .= "<legend class='smart_legend'><b>".$key." <span onclick='smartmainexpand()' id='smart_main_expand'>&nabla;</span></b></legend>";
		
		foreach ($value as $ky => $val) {
			//Fields documentation	
			$title="No Documentation available";
			if(isset($value['Documented'])){
				if(array_key_exists($ky, $value['Documented'])){
					$title = $value['Documented'][$ky];
				}
			}	
			
			if($ky!=='Documented'){
				$grid .= "<div class='smart_hr_heading'>".Resources::img("information.png",array("style"=>"width:15px;cursor:pointer;","Title"=>$title))." <b>".$ky." <span class='smart_expand' onclick='smartexpand(\"smart_".$cnt."\",this)'>&nabla;<span></b><hr class='smart_hr'></div><br>";
	
				$grid .= "<div class ='smart_body' id='smart_".$cnt."'>";
					foreach ($val as $v) {
						$grid .= $v;
					}
				$grid .= "</div>";
			
				$cnt++;
			}
		}
		
		$grid .= "<div id='smart_rst'></div>";
	}

	$grid .= "</fieldset>";
	$grid .= Resources::a_href($GLOBALS['Controller']."/".$GLOBALS['Method'],"<INPUT TYPE='button' value='Refresh Page'/>");
	
	
	/*

	$grid .= "<legend class='smart_legend'><b>Create Class</b></legend>";
 
	$grid .= "<div class='smart_hr_heading'><b>Class Details <span class='smart_expand' onclick='smartexpand(\"smart_1\",this)'>&nabla;<span></b></div><hr class='smart_hr'><br>";

	$grid .= "<div class ='smart_body' id='smart_1'><INPUT TYPE='text' placeholder='Class Name'/><SELECT><OPTION>Select Grade</OPTION></SELECT><INPUT TYPE='text' placeholder='Class Teacher'/><INPUT TYPE='text' placeholder='Academic Year'/></div>";

	$grid .= "<br><div class='smart_hr_heading'><b>Add Students <span class='smart_expand' onclick='smartexpand(\"smart_2\",this)'>&nabla;<span></b></div><hr class='smart_hr'><br>";

	$grid .= "<div class ='smart_body' id='smart_2'><INPUT TYPE='text' placeholder='Search Student'/><span>[Search] [Add]</span></div>";

	*/
	
	
	return $grid;
}
public static function load_message(){
	
	$getMsg = ""; 
	
	$model = new E_Model("messages");
	
	$cntl = $GLOBALS['Controller'];
	$mthd = $GLOBALS['Method'];
	
	$pnt = $cntl."_".$mthd;
	$msg_type ="2";
	
	$cnd = $model->where(array(array("WHERE","pointer",$pnt,"=")));
	$qry = $model->getAllRecords($cnd,"messages","",array("msg","msg_type"));
	
	if(count($qry)>0){
		if($qry[0]->msg_type==="1"){
			$getMsg = "";
		}
			$getMsg .= $qry[0]->msg;
			$msg_type = $qry[0]->msg_type;
	}else{
		$getMsg .="Module description not available";
	}
	
	$fin = "";
	
	if($msg_type==='2'){
		$fin = Resources::img("help.png",array("style"=>"cursor:pointer;","title"=>"Click to view Module Description","onclick"=>"moduledesc(\"".$getMsg."\")"))."<br>";
	}else{
		$fin = "<div id='moduledesc".$msg_type."'>".$getMsg."</div><br>";
	}
	 
	return $fin;
}
public static function db_table($array,$action=0){
	
	$keys = array_keys($array);
	$caption = $keys[0];
	
	$tbl = "";//"<INPUT TYPE='button' VALUE='Promote'/>";
	
	if(isset($array[$caption]['Resources'])){
		foreach ($array[$caption]['Resources'] as $value) {
			$tbl .= $value;
		}
	}
	
	$tbl .= "<table id='info_tbl' style='margin-top:20px;max-width:95%;min-width:50%;'>";

	$tbl .= "<caption>".$caption."</caption>";
	
	if(count($array[$caption]['records'])===0){
		$tbl .= "<tr><td><div id='error_div'>No results found for the search</div></td></tr>";
	}else{
	
			$hdr = array_keys((Array)$array[$caption]['records'][0]);
			
			$func = "func";
			
			$tbl .= "<tr>";
			
			if($action===1){
				$tbl .="<th>Action</th>";
			}
			
			foreach ($hdr as $value) {
				$tbl .= "<th>".$value."</th>";
			}
			$tbl .= "</tr>";
			
			
			foreach ($array[$caption]['records'] as $value) {
				$tbl .= "<tr>";
				
				if($action===1){
					$tbl .="<td><INPUT TYPE='checkbox' class='db_table_chkbx'/></td>";
				}
				
				$cnt_rws = 0;
				$style = "color:#0000FF;";
					foreach ($value as $k => $v) {
						
					if(isset($array[$caption]['functions'])){
						if(array_key_exists($cnt_rws,$array[$caption]['functions'])){
							$func = $array[$caption]['functions'][$cnt_rws];
							$style = "color:violet;cursor:pointer;";
						}
					}	
						
						
						$tbl .= "<td style='".$style."' onclick=".$func."(this)>".$v."</td>";
						$cnt_rws++;
					}
				$tbl .= "</tr>";
			}
	}
	
	$tbl .= "</table>";

return $tbl;

}
public static function link($links=array()){
    
        //Load grouped default app level css

if(file_exists(BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'css'."/".$GLOBALS['Controller'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."css"."/".$GLOBALS['Controller'].".css'>\n";
    }
    
        //Load single default app level js
    
    if(file_exists(BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'css'."/".$GLOBALS['app'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."css"."/".$GLOBALS['app'].".css'>\n";
    }
    
    
        //Load grouped default app level css
    
    $dir = BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'css'."/".$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."css"."/".$GLOBALS['app']."/".$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load grouped default Controller level css
    
    $dir = BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'css'."/".$GLOBALS['Controller'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."css"."/".$GLOBALS['Controller']."/".$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load specified css file in css folders. App level css has high preference    
    
    foreach($links as $value){
        if(!file_exists(BASE_PATH."/".DS.'application'."/".$GLOBALS['app']."/".'scripts'."/".'css'."/".$value)){
            print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."system"."/"."scripts"."/"."css"."/".$value."'>\n";
        }  else {
            print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."css"."/".$value."'>\n";
        }
    }
	
    
    $dir = BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."scripts"."/"."css";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."scripts"."/"."css"."/".$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
	
	$dir = BASE_PATH."/"."system"."/"."scripts"."/"."css";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".HOST_NAME."/".ROOT_FOLDER."/"."system"."/"."scripts"."/"."css"."/".$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    	
}
public static function script($scripts){
    
    //Load grouped default app level js
    
    $dir = BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'js'."/".$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."js"."/".$GLOBALS['app']."/".$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load grouped default Controller level js
    
    $dir = BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'js'."/".$GLOBALS['Controller'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."js"."/".$GLOBALS['Controller']."/".$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
	
	
    
    
    //Load specified js file in js folders. App level js has high preference
    foreach ($scripts as $value) {
        if(!file_exists(BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'js'."/".$value)){
            print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."system"."/"."scripts"."/"."js"."/".$value."'></script>\n";
        }  else {
            print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."js"."/".$value."'></script>\n";
        }
    }
    
      //Load single default app level js
    if(file_exists(BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'js'."/".$GLOBALS['app'].".js")){
        print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."js"."/".$GLOBALS['app'].".js'></script>\n";
    }
    
    //Load single default Controller level js
    if(file_exists(BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'scripts'."/".'js'."/".$GLOBALS['Controller'].".js")){
        print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."application"."/".$GLOBALS['app']."/"."scripts"."/"."js"."/".$GLOBALS['Controller'].".js'></script>\n";
    }
	$dir = BASE_PATH."/".'system'."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/".'scripts'."/"."js";
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".HOST_NAME."/".ROOT_FOLDER."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."scripts"."/"."js"."/".$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
    
	
	$dir2 = BASE_PATH.DS."system".DS."scripts".DS."js";
    
    if (is_dir($dir2)) {
    if ($dh2 = opendir($dir2)) {
        while (($file2 = readdir($dh2)) !== false) {
            if ($file2 != "." && $file != ".."){
             print "<script src='".HOST_NAME.DS.'easyPHP'.DS."system".DS."scripts".DS."js".DS.$file2."'></script>\n";
            }
        }
        closedir($dh2);
    }
    }
    

}
    public static function func($func_name,$var = array()){
        //if(is_array($param)){
            //foreach ($param as $func_name):
                if(realpath(BASE_PATH."/".'system'."/".'functions'."/".$func_name.".php"))
                    {
                        require_once BASE_PATH."/".'system'."/".'functions'."/".$func_name.".php";
                    }  else {
                        require_once BASE_PATH."/".'application'."/".$GLOBALS['app']."/".'functions'."/".$func_name.".php";
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
				$inner['langid']=$value->langid;
                array_push($menu_data,$inner);
                
            }  else {
                $chk_parent_array = explode("_",$value->selfID);
                if(ucfirst($chk_parent_array[1])===ucfirst($GLOBALS['Controller'])){
                $inner_side['name']=  ucfirst($value->selfTitle);
                $inner_side['url']=  ucfirst($value->url);
                $inner_side['img']=$value->link_img;
				$inner_side['langid']=$value->langid;
                array_push($side_menu_data,$inner_side);
                }
               
            }
        }
		
		if($render===1){
			if(file_exists(BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."header.php")){
				$data = $menu_data;		
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."header.php";
			}else{
				$data = $menu_data;		
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."header.php";
			}
	        if(file_exists(BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."side_bar.php")){
				$data['side'] = $side_menu_data;
				$data['users']=$users_online_arr;
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."side_bar.php";
			}else{
				$data['side'] = $side_menu_data;
				$data['users']=$users_online_arr;
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."side_bar.php";
			}
		}
			if($path===""&&file_exists(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."view"."/".$GLOBALS['Controller']."/".$GLOBALS['Method'].".php")){
				$data = $results;
	            include BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."view"."/".$GLOBALS['Controller']."/".$GLOBALS['Method'].".php";
				
			}elseif(file_exists(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."view"."/".$GLOBALS['Controller']."/".$path.".php")){
				$data = $results;
				include BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."view"."/".$GLOBALS['Controller']."/".$path.".php";
			}else{
				if($path==="err"){
					$data = self::img("error.png")." Error Log:<br>".$results;
				}else{
					$data = self::img("error.png")." Error Log:<br>View <i><span style='color:blue;'>{$path}</span></i> not found in Method <i><span style='color:blue;'>{$GLOBALS['Method']}</span></i> of <i><span style='color:blue;'>{$GLOBALS['Controller']}</span></i> controller!";
				
				}
				
				include BASE_PATH."/"."system"."/"."logs"."/"."error.php";
			}
		if($render===1){
			if(file_exists(BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."footer.php")){
				$data = $recent;
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['app_default_theme']."/"."footer.php";
			}else{
				$data = $recent;
				include BASE_PATH."/"."system"."/"."extensions"."/"."themes"."/".$GLOBALS['theme']."/"."footer.php";
			}
		}
		//return $recent;
    }

public static function session(){
	return (object)$_SESSION;
}
public static function load_language($lang,$langid,$content=array()){
	$cont = file_get_contents(BASE_PATH."/"."application"."/".$GLOBALS['app']."/"."docs"."/"."lang"."/".$lang.".lang");
	$arr = (array)json_decode($cont);
	$action_arr = $arr[$langid]; 
	$action="";
	if(!empty($content)){
		foreach($content as $key=>$value):
				$action = str_replace('%'.$key.'%', $value, $action_arr);
			endforeach;
	}else{
		$action	=$action_arr;
	}
	return $action;
}
public static function user_history($userid,$langid,$lang="eng",$actionParam=array()){
	$action = self::load_language($lang,$langid,$actionParam);
			
	$model = new E_Model("users");
	$name_cond = $model->where(array(array("where","ID",$userid,"=")));
	$user_arr = $model->getAllRecords($name_cond,"users");
	$user_full_name = $user_arr[0]->userfirstname." ".$user_arr[0]->userlastname;
	$icpNo = $user_arr[0]->fname;
	
	$new_array=array();
	
	$new_array['UserID']=$userid;
	$new_array['user_full_name']=$user_full_name;
	$new_array['user_tbl_fname']=$icpNo;
	$new_array['action']=$action;
	
	
	$model->insertRecord($new_array,"history");
}
public static function translate_item($langid){
	$item=self::load_language($lang=$_SESSION['lang'], $langid);
	return $item;
}
}
?>