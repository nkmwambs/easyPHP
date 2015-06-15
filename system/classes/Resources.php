<?php
class Resources{
	 public static function import($path){
		$path_arr = explode(".", $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;
		$fPath = BASE_PATH.DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."libs".$path_str.".class.php";
		require_once $fPath;
	}
	 
public static function url($url){
    return "http://".filter_input(INPUT_SERVER,"HTTP_HOST")."/easyPHP/".$GLOBALS['app']."/".$url;
}
public static function a_href($path,$text,$properties=""){
    //property array example - array("width"=>"80px","heigth"=>"90px","title"=>"Petty","style"=>"margin-top:10px;border:5px solid black;")
    //$str  = "<a href='http://".filter_input(INPUT_SERVER,"HTTP_HOST")."/easyPHP/".$GLOBALS['app']."/".$path."' ";
    if($path===""){
    	$str  = "<a href='#' ";
    }else{
    	$str  = "<a href='".PATH.DS.$GLOBALS['app'].DS.$path."' ";
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
public static function link_tag($links){
        //Load single default Controller level css
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['Controller'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['Controller'].".css'>\n";
    }
    
        //Load single default app level js
    
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['app'].".css")){
        print "<link rel='stylesheet' type='text/css' href='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['app'].".css'>\n";
    }
    
    
        //Load grouped default app level css
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<link rel='stylesheet' type='text/css' href='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['app'].DS.$file."'>\n";
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
                print "<link rel='stylesheet' type='text/css' href='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$GLOBALS['Controller'].DS.$file."'>\n";
            }
        }
        closedir($dh);
    }
    }
    
    //Load specified css file in css folders. App level css has high preference    
    
    foreach($links as $value){
        if(!file_exists(BASE_PATH.DS.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'css'.DS.$value)){
            print "<link rel='stylesheet' type='text/css' href='".PATH.DS."system".DS."scripts".DS."css".DS.$value."'>\n";
        }  else {
            print "<link rel='stylesheet' type='text/css' href='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."css".DS.$value."'>\n";
        }
    }
}
public static function script_tag($scripts){
    
    //Load grouped default app level js
    
    $dir = BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['app'];
    
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                print "<script src='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['app'].DS.$file."'></script>\n";
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
                print "<script src='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['Controller'].DS.$file."'></script>\n";
            }
        }
        closedir($dh);
    }
    }
    
    
    //Load specified js file in js folders. App level js has high preference
    foreach ($scripts as $value) {
        if(!file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$value)){
            print "<script src='".PATH.DS."system".DS."scripts".DS."js".DS.$value."'></script>\n";
        }  else {
            print "<script src='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$value."'></script>\n";
        }
    }
    
      //Load single default app level js
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['app'].".js")){
        print "<script src='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['app'].".js'></script>\n";
    }
    
    //Load single default Controller level js
    if(file_exists(BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'scripts'.DS.'js'.DS.$GLOBALS['Controller'].".js")){
        print "<script src='".PATH.DS."application".DS.$GLOBALS['app'].DS."scripts".DS."js".DS.$GLOBALS['Controller'].".js'></script>\n";
    }

}
}
?>