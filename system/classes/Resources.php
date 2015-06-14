<?php
class Resources{
	 public static function import($path){
		$path_arr = explode(".", $path);
		$path_str="";
		foreach($path_arr as $value):
			$path_str.=DIRECTORY_SEPARATOR.$value;
		endforeach;
		$fPath = BASE_PATH.DIRECTORY_SEPARATOR."system".DIRECTORY_SEPARATOR."libs".$path_str.".class.php";
		require_once $fPath;
	}
}
?>