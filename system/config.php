<?php
//Define System Constants
define('DB_HOST','localhost');
define('DB_PASSWORD','');
define('BASE_PATH',dirname(dirname(__FILE__)));
define('DS',DIRECTORY_SEPARATOR);
define('PATH',str_replace("/",DIRECTORY_SEPARATOR,dirname(dirname(filter_input(INPUT_SERVER,"SCRIPT_NAME")))));
define('DB_PREFIX','');
define('DB_USER',DB_PREFIX.'root');
define("HOST_NAME",'http://localhost');

$theme = "coolblue";

//Define Default Controller and Controller Method

$default_controller ="welcome";// Overwrite by setting $app_default_controller in the specific application config.php file
$default_view ="logout";// Overwrite by setting $app_default_view in the specific application config.php file

//Default Language
//$_SESSION['lang']='eng';
        
