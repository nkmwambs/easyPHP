<?php
//Improved Urls
function img_tag($path,$properties=""){
    
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