<?php
function url_tag($url){
    return "http://".filter_input(INPUT_SERVER,"HTTP_HOST")."/easyPHP/".$GLOBALS['app']."/".$url;
}