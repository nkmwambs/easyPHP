<?php
function img_tag($path,$properties=""){
    
    if(file_exists(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."images".DS.$path)){
        $str = "<img src='".PATH.DS."application".DS.$GLOBALS['app'].DS."images".DS.$path."'";

    }  else {
        $str = "<img src='".PATH.DS."system".DS."images".DS.$path."'"; 
    }
    

    if(is_array($properties)){
        foreach ($properties as $key => $value) {
                $str .= " ".$key. "= '".$value ."' ";
        }
    }
    $str .="/>";
    return $str;
}