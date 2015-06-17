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
                header("location:".Resources::url($GLOBALS['app_default_controller']."/".$GLOBALS['app_default_view']));
            }
            
        }

        
    }
    
	protected function dispatch($path="",$results="",$tags=array()){
<<<<<<< HEAD
		//	define("DEPRECATE", 1);
			if(in_array($_SESSION['userlevel'], $tags)||(in_array("All", $tags)&&$_SESSION['userlevel']!=='0')||
				in_array("0", $tags)){
				Resources::render($path,$results);
			}else{
				Resources::render($path="welcome/dispatchError",$results="");
			} 
=======
		    $rec_cond=  $this->model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");    
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
			//echo $_SESSION['userlevel'];
			//$cur_menu_cond = $this->model->where(array(array("where","url",$this->Con."/".$this->Met,"=")));
			//$cur_menu = $this->model->getAllRecords($cur_menu_cond,"menu");
			
			//$ulvl_arr = explode(",",$cur_menu[0]->userlevel);
			if(in_array($_SESSION['userlevel'], $tags)||(in_array("All", $tags)&&$_SESSION['userlevel']!=='0')||
			in_array("0", $tags)){
				$this->template->view($path,$results);
			}else{
				$this->template->view($path="welcome/dispatchError",$results="");
			}
			
            
            $this->template->view("welcome/footer",$recent); 
>>>>>>> master
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
		    	}elseif($param->getName()==='tags'){
		    		$tags = $param->getDefaultValue();
		    	}
			}
			if($this->{$this->Met}()!==""){
				$results=$this->{$this->Met}();
			}else{
				$results="";
			}
			$this->dispatch($path,$results,$tags);
		}
		
	}
}
