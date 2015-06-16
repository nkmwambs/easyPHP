<?php
class Template{
    
    public $view;
    public $folder;


    public function __construct($fld,$view){
                $this->view=$view;
                $this->folder=$fld;
    }

    public function view($path="",$results="",$deprecate=""){
        $data = $results;
		//if(!defined("DEPRECATE")){
			//$_SESSION['error']="Usage of the view method of the Template class in Controllers is deprecated!";
		//}else{
			//$_SESSION['error']="";
		//}
		//echo $deprecate="False";
	//if($deprecate===FALSE){
		if($path===""){
            include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$this->folder.DS.$this->view.".php";
        }else{
            include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS.'tpl'.DS.$path.".php";
        }
	//}else{
		//include BASE_PATH.DS."system".DS.'logs'.DS."dispatchError".".php";
	//}	
        
        
    }
}