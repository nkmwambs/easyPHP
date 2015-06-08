<?php
class Template{
    
    public $view;
    public $folder;


    public function __construct($fld,$view){
                $this->view=$view;
                $this->folder=$fld;
    }

    public function view($path="",$results=""){
        $data = $results;
        if($path===""){
            include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."view".DS.$this->folder.DS.$this->view.".php";
        }else{
            include BASE_PATH.DS."application".DS.$GLOBALS['app'].DS.'tpl'.DS.$path.".php";
        }
        
    }
}