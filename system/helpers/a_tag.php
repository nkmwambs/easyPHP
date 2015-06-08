<?php
function a_tag($path,$text,$properties=""){
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