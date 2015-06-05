<?php
function link_tag($links){
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