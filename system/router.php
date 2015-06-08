<?php
//if(isset($_GET['url])){}
if(filter_has_var(INPUT_GET, "url")){
    $app_folder_arr = explode("/",filter_input(INPUT_GET,"url"));
    $app_folder = $app_folder_arr[0];
   if(file_exists(BASE_PATH.DS.'application'.DS.$app_folder.DS."config.php")){
    require_once (BASE_PATH.DS.'application'.DS.$app_folder.DS."config.php");
        if(!empty($app_default_controller)&&!empty($app_default_view)){
            $default_controller = $app_default_controller;
            $default_view=$app_default_view;
        }elseif (empty($app_default_controller)&&!empty($app_default_view)) {
            $default_view=$app_default_view;
        }elseif (!empty($app_default_controller)&&empty($app_default_view)) {
            $default_controller = $app_default_controller;
        }
   }
   
}else{
    print 'Application is not set in the URL';
}

//Set Url 

if(filter_has_var(INPUT_GET, "url")){
      $new_arr = explode("/",filter_input(INPUT_GET,"url"));
        if(sizeof($new_arr)<3){
          $app = array_shift($new_arr);
          $url = $app.'/'.$default_controller.'/'.$default_view;
        }else{
      $url= filter_input(INPUT_GET,"url");
   }
}

//Define Controller, Method and Arguments Array

   $url_array = explode("/",$url);
   $app = array_shift($url_array);
   $Controller = array_shift($url_array);
   $rawController = ucfirst($Controller)."_Controller";
   $Method=array_shift($url_array);
   
   if(isset($url_array)){
     $args =  array();
      for($i=0;$i<sizeof($url_array);$i++){
        array_push($args,$url_array[$i]);
      }
       
   }else{
       $args="";
   }
// Load all classes in the Classes system folder
   $dir = BASE_PATH.DS.'system'.DS.'classes';
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != ".."){
                require_once (BASE_PATH.DS.'system'.DS.'classes'.DS.$file);
            }
        }
        closedir($dh);
    }
    }   
   

function __autoload($class_name){
    $Con = explode("_",$class_name);
    $app = $GLOBALS['app'];
    if(file_exists(BASE_PATH.DS.'application'.DS.$app.DS.'model'.DS.$Con[0].'.php'))
        {
            require_once BASE_PATH.DS.'application'.DS.$app.DS.'model'.DS.$Con[0].'.php';   
        }  else {
            $_SESSION['error_msg']= "Sorry! Application model class missing!<br>";
            header("location:http://".filter_input(INPUT_SERVER,'HTTP_HOST')."/easyPHP/".$GLOBALS['app']."/".$GLOBALS['$default_controller']."/".$GLOBALS['error_view']);
        }
    if(file_exists(BASE_PATH.DS.'application'.DS.$app.DS.'controller'.DS.$Con[0].'.php'))
        {
            require_once BASE_PATH.DS.'application'.DS.$app.DS.'controller'.DS.$Con[0].'.php';
            
        }else{
            $_SESSION['error_msg']="Sorry! Application controller class missing!<br>";
            header("location:http://".filter_input(INPUT_SERVER,'HTTP_HOST')."/easyPHP/".$GLOBALS['app']."/".$GLOBALS['$default_controller']."/".$GLOBALS['error_view']);
        }

}
 
$controller = new $rawController();
$controller->$Method();
