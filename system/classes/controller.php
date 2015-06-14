<?php 
/**
class E_Controller {
     public $model;	
     public $template;
     public $choice;
     public $helper;
     public $Con;
     public $Met;
     public $Args;
     public $session;
     public $load_menu;
     private $_model;

    public function __construct(){
        $this->Con = $GLOBALS['Controller'];
        $this->Met = $GLOBALS['Method'];
        $this->Args = $GLOBALS['args'];
        $this->template=new Template($this->Con,  $this->Met);
        $this->load_menu=new E_Menu;
        $this->helper=new E_Helpers();
        $this->choice=  $this->Args;
        $this->session=session_start();
        $this->model=new E_Model($table="menu");
        $this->_model=new E_Model($table="extras");
        
        if(!empty($this->helper->global_helpers)){
            foreach ($this->helper->global_helpers as $value) {
              $this->helper->load("$value");  
            }
            
        }

        //if(!isset($_SESSION['username'])||empty($_SESSION)){
          //  $_SESSION['username']="Guest";
            //$_SESSION['userlevel']='0';
            //$_SESSION['ID']='0';
        //}
		
       
      //  if(!isset($_SESSION['adm'])){$this->offline();}
            
        //$url = $this->Con."/".$this->Met;
        //$cond = $this->model->where(array("where"=>array("public",'1',"="),"AND"=>array("url",$url,"=")));
        //$rst = $this->model->getAllRecords($cond);
		
	   /** 
        if(count($rst)===0&&$_SESSION["username"]==="Guest"){
            if($this->choice[0]!=='public'&&$this->choice[1]!=='1'){
                header("location:".url_tag($GLOBALS['app_default_controller']."/".$GLOBALS['app_default_view']));
            }
        }
      
      
}

public function offline(){
    
    $offline_cond = $this->_model->where(array("where"=>array("info","offline","="),"AND"=>array("flag","1","=")));  
    $offline = $this->_model->getAllRecords($offline_cond,"extras");
    //print_r($offline);
    if(sizeof($offline)>0&&(!isset($_SESSION['administrator'])||isset($_POST))){
        $cond = $this->model->where(array("where"=>array("username",trim(filter_input(INPUT_POST,"username")),"="),
        "AND"=>  array("password",filter_input(INPUT_POST,"password"),"=")));
        
        $results = $this->_model->getAllRecords($cond,"Users");
        //print_r($results);
        if(sizeof($results)>0&&$results[0]->admin==='1'){
                $_SESSION['adm']="1";
                    foreach($results[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                    $_SESSION[$key."_backup"]=$value;
                endforeach;
        }  else {
                 $this->template->view("Welcome/headerOut");
                $this->template->view($GLOBALS['app_default_tpl_folder']."/".$GLOBALS['offline']);
                die();            
        }          
    }     
}

public function __call($method,$arguments){
        //$_SESSION['error_msg'] = 'Error: Missing method <i>'.$method.'()</i> in the application controller class <i>'.$this->Con."_Controller</i>";
        //header("location:".url_tag($GLOBALS['app_default_controller']."/".$GLOBALS['error_view']));
        
    }
    
}
**/

/**
 * System Controller Class
 * 
 * This class instatiates the following classes:
 * <ol>
 * <li>E_Template Class</li>
 * <li>E_Menu Class</li>
 * <li>E_helper Class</li>
 * <li>E_model Class</li>
 * </ol>
 * 
 * @author Nicodemus Karisa <nkmwambs@gmail.com>
 * @version 2.0.1
 * @copyright Copyright (c) 2015, COmpassion Kenya
 */
class E_Controller {
     protected $model;	
     protected $template;
     protected $choice;
     protected $helper;
     private $Con;
     private $Met;
     private $Args;
     private $session;
     protected $load_menu;
	 private $method_args_count;
	 //public static $RENDER=1;

    public function __construct(){
        $this->Con = $GLOBALS['Controller'];
        $this->Met = $GLOBALS['Method'];
        $this->Args = $GLOBALS['args'];
        $this->template=new Template($this->Con,  $this->Met);
        $this->load_menu=new E_Menu;
        $this->helper=new E_Helpers();
        $this->choice=  $this->Args;
        $this->session=session_start();
        $this->model=new E_Model($table="menu");
		//$reflection = new ReflectionClass($this);
        
        if(!empty($this->helper->global_helpers)){
            foreach ($this->helper->global_helpers as $value) {
              $this->helper->load("$value");  
            }
            
        }
		//print($_SESSION['ID']);
        if(!isset($_SESSION['username'])||empty($_SESSION)){
            $_SESSION['username']="Guest";
            $_SESSION['userlevel']='0';
            $_SESSION['ID']='0';
			//define("USERID",$_SESSION['ID']);
        }
		
		define("USERID",$_SESSION['ID']);
		//define("USERNAME",$_SESSION['username']);
		
        $url = $this->Con."/".$this->Met;
        $cond = $this->model->where(array("where"=>array("public",'1',"="),"AND"=>array("url",$url,"=")));
        $rst = $this->model->getAllRecords($cond);
        if(count($rst)===0&&$_SESSION["username"]==="Guest"){
            if($this->choice[0]!=='public'&&$this->choice[1]!=='1'){
                header("location:".url_tag($GLOBALS['app_default_controller']."/".$GLOBALS['app_default_view']));
            }
            
        }

        
    }
    
	protected function dispatch($path="",$results=""){
		    $rec_cond=  $this->model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");    
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
			
			$this->template->view($path,$results);
            $this->template->view("welcome/footer",$recent); 
	}
	


    /**
	 * Error control
	 * @param string $var
	 * @param string $val
	 * @return void
	 */
    
    public function __call($var,$val){
        print 'Error: Missing method <i>'.$var.'()</i> in the application controller class <i>'.$this->control."_Controller</i>";
    }
    
	public function __destruct(){
		$reflection=new ReflectionClass($this);
		$num_args = $reflection->getMethod($this->Met)->getNumberOfParameters();
		if($num_args!==0){
			$param_arr = $reflection->getMethod($this->Met)->getParameters();
			
			$path="";
			foreach ($param_arr as $param) {
		    	if($param->getName()==='path'){
		    		$path = $param->getDefaultValue();
		    	}
			}
			if($this->{$this->Met}()!==""){
				$results=$this->{$this->Met}();
			}else{
				$results="";
			}
			$this->dispatch($path,$results);
		}
		
	}
}
