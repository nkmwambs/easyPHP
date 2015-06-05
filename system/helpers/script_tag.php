<?php
function script_tag($scripts){
    
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
