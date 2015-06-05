<?php
class E_Helpers{
    
    public $global_helpers;
    
    public function __construct(){
        
        $this->global_helpers = $GLOBALS['default_helpers'];

    }
    
    public function load($param) {
        if(realpath(BASE_PATH.DS.'system'.DS.'helpers'.DS.$param."_tag.php"))
            {
                require_once BASE_PATH.DS.'system'.DS.'helpers'.DS.$param."_tag.php";
            }  else {
                require_once BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'helpers'.DS.$param."_tag.php";
            }
    }
    public function get_func($param){
        if(is_array($param)){
            foreach ($param as $func_name):
                if(realpath(BASE_PATH.DS.'system'.DS.'functions'.DS.$func_name.".php"))
                    {
                        require_once BASE_PATH.DS.'system'.DS.'functions'.DS.$func_name.".php";
                    }  else {
                        require_once BASE_PATH.DS.'application'.DS.$GLOBALS['app'].DS.'functions'.DS.$func_name.".php";
                    }
            endforeach;
        }        
    }
}

