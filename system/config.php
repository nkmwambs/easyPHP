<?php
//Define System Constants
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('BASE_PATH',dirname(dirname(__FILE__)));
define('DS',DIRECTORY_SEPARATOR);
define('PATH',str_replace("/",DIRECTORY_SEPARATOR,dirname(dirname(filter_input(INPUT_SERVER,"SCRIPT_NAME")))));

//Define Default Controller and Controller Method

$default_controller ="welcome";// Overwrite by setting $app_default_controller in the specific application config.php file
$default_view ="logout";// Overwrite by setting $app_default_view in the specific application config.php file

//Define Default Helpers

$default_helpers = array("link","script","url","a","img","approval");

//get_magic_quotes_gpc() ? "OFF" : "ON";


        
