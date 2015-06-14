<?php 
class Welcome_Controller extends E_Controller{
public $_model;
//public $__model;
    public function __construct(){
        parent::__construct();
        $this->helper->load("img");
        $this->_model=new Welcome_Model("users");
        //$this->__model=new Welcome_Model("extras");
    }
    public function popup(){
    $this->template->view();
    }
    public function error(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10"); 
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $data = $_SESSION['error_msg'];
            $this->template->view("Welcome/error",$data);
            $this->template->view("welcome/footer",$recent);  
    }

    public function show($render=1,$tags=array("0")){
			if(!isset($_SESSION['username'])){
                $_SESSION['username']="Guest";
                $_SESSION['userlevel']='0';
            }
         
    }
    public function login() {
        if(isset($_POST)){
        $cond = $this->model->where(array("where"=>array("username",trim(filter_input(INPUT_POST,"username")),"="),
            "AND"=>  array("password",filter_input(INPUT_POST,"password"),"=")));
       
        $results = $this->_model->getAllRecords($cond,"Users");
        
        if(is_array($results)&&sizeof($results)>0){
                foreach($results[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                    $_SESSION[$key."_backup"]=$value;
                endforeach;
            if($results[0]->admin==="1"){$_SESSION['adm']="2";}
            $this->dispatch("Welcome/show",$_SESSION['fname'],array("0"));
        }  else {
                    $data="";  
                    if(!isset($_SESSION['cnt'])){
                        $_SESSION['cnt']=0;
                    }else{
                        $_SESSION['cnt']++;
                        $data = "Log in Error : Empty or wrong Username or Password!";

                    }
           
            $_SESSION["username"]="Guest";
            $_SESSION["userlevel"]='0';
            $this->dispatch("",$data,array("0"));
        }
    }else{
        $this->dispatch("",$data,array("0"));
    }
}
    
    public function logout($render=1,$path="welcome/show",$tags=array("0")){
            session_unset();
            $_SESSION['username']="Guest";
            $_SESSION['userlevel']='0';
            $_SESSION['ID']='0';
}

    public function profile($render=1){
         
    }
	
    function newRecent(){
        $record['itemTitle']=  $this->choice[1];
        $record['url']=  $directory = str_replace("_", "/", $this->choice[3]);
        $record['userid']=  $this->choice[5];
        $record['link_img']=  $this->choice[7];
        $cnd = $this->_model->where(array(array("where","itemTitle",$this->choice[1],"="),array("AND","userid",$_SESSION['ID'],"=")));
        $cn = $this->_model->getAllRecords($cnd,"recent");
        if(count($cn>0)){
            $this->_model->deleteQuery($cnd,"recent");
        }
        if(substr_count($this->choice[7],".")>0&&substr_count($this->choice[7],"png")>0){
            $this->_model->insertRecord($record,"recent");
        }
        
        
    }
    public function switchUser(){
            $cond="";
            if(!isset($_POST)){
                $this->dispatch("","",array("9"));
            }else{
                if(isset($_POST['username'])){
                    $cond = $this->model->where(array("where"=>array("username",trim(filter_input(INPUT_POST,"username")),"=")));
                }elseif(isset ($this->choice[1])){
                    $cond = $this->model->where(array("where"=>array("username",  $this->choice[1],"=")));
                    
                }
                    $results = $this->_model->getAllRecords($cond,"Users");
        
                    if(is_array($results)&&sizeof($results)>0){
                            foreach($results[0] as $key=>$value):
                                $_SESSION[$key]=$value;
                            endforeach;
                    }
                    
                    $this->dispatch("",$_SESSION['fname'],array("9"));
            }
                     
    }
    
    public function searchUser(){
        $_SESSION['search_user'] =  $this->choice[1];
        $username = $_SESSION['search_user'];
        $search=  $this->_model->searchUsers($username);
        
        if(count($search)===0){
            echo "No match Found";
        }else{
             print_r($search);
        }
    }

}