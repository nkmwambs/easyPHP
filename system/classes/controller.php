<?php 
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
     //protected $template;
     protected $choice;
     //protected $helper;
     private $Con;
     private $Met;
     private $Args;
     private $session;
     //protected $load_menu;
	 private $method_args_count;
	 //public $deprecate;
	 //public static $RENDER=1;

    public function __construct(){
        $this->Con = $GLOBALS['Controller'];
        $this->Met = $GLOBALS['Method'];
        $this->Args = $GLOBALS['args'];
        //$this->template=new Template($this->Con,  $this->Met);
        //$this->load_menu=new E_Menu;
        //$this->helper=new E_Helpers();
        $this->choice=  $this->Args;
        $this->session=session_start();
        $this->model=new E_Model($table="menu");
		//$reflection = new ReflectionClass($this);
        
       // if(!empty($this->helper->global_helpers)){
         //   foreach ($this->helper->global_helpers as $value) {
           //   $this->helper->load("$value");  
            //}
            
        //}
		
        if(!isset($_SESSION['username'])&&empty($_SESSION)){
            		$cond = $this->model->where(array(array("where","ID","0","=")));
					$rst = $this->model->getAllRecords($cond,"users");
					foreach($rst[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                    $_SESSION[$key."_backup"]=$value;
                	endforeach;
        }
		
		
 		$url = $this->Con."/".$this->Met;        
		if(isset($this->choice[0])){
	        if((($this->choice[0]==='public'&&$this->choice[1]!=='1'))&&Resources::session()->username==='Guest'){
	        	header("location:".Resources::url($GLOBALS['app_default_controller']."/".$GLOBALS['app_default_view']));
	        }
		}

        
    }

	protected function dispatch($render="1",$path,$results,$tags=array()){
			if(in_array($_SESSION['userlevel'], $tags)||(in_array("All", $tags)&&$_SESSION['userlevel']!=='0')||
				in_array("0", $tags)){
				Resources::render($render,$path,$results);
								
			}

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
		/**
		 * Destruct run only when the method has parameters passed in
		 */
		if($num_args!==0){
				$param_arr = $reflection->getMethod($this->Met)->getParameters();
				
				$path="";
				foreach ($param_arr as $param) {
			    	if($param->getName()==='path'){
			    		$path = $param->getDefaultValue();
			    	}elseif($param->getName()==='tags'){
			    		$tags = $param->getDefaultValue();
			    	}elseif($param->getName()==='render'){
			    		$render = $param->getDefaultValue();
			    	}
				}
					if($this->{$this->Met}()!==""){
						$results=$this->{$this->Met}();
					}else{
						$results="";
					}
					
					if(!isset($tags)){
						$results = "View <i><span style='color:blue;'>{$this->Met}</span></i> of <i><span style='color:blue;'>{$GLOBALS['Controller']}</span></i> controller is not tagged!";
						$this->dispatch($render=2,$path="err",$results,$tags=array("0"));
					}else{
						$this->dispatch($render,$path,$results,$tags);
				}
				
			}
		
	}
}
