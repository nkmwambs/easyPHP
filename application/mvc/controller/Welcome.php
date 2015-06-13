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

    public function show(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");    
            if(!isset($_SESSION['username'])){
                $_SESSION['username']="Guest";
                $_SESSION['userlevel']='0';
            }
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view();
            $this->template->view("welcome/footer",$recent); 
         
    }
    public function login() {
	$rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
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
            $this->template->view("Welcome/show",$_SESSION['fname']);
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
            $this->template->view("",$data);
        }
    }else{
        $this->template->view("",$data);
    }
    
    //echo "Karisa"; 
    $this->template->view("welcome/footer",$recent);
}
    
    public function logout(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                    //if(isset($_SESSION['username'])){
                        session_unset();

                    //}
                    $_SESSION['username']="Guest";
                    $_SESSION['userlevel']='0';
                    $_SESSION['ID']='0';
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $this->template->view("welcome/show");
            $this->template->view("welcome/footer",$recent); 
}

    public function profile(){
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            //$data = "User Profile";
            $this->template->view();
            $this->template->view("welcome/footer",$recent); 
         
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
        
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
            $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
            $menu = $this->model->getAllRecords();
            $this->load_menu->menu($menu);
            $cond="";
            if(!isset($_POST)){
                $this->template->view();
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
                    
                    $this->template->view("",$_SESSION['fname']);
            }
              
            $this->template->view("welcome/footer",$recent);         
    }
    
    public function searchUser(){
        $_SESSION['search_user'] =  $this->choice[1];
        $username = $_SESSION['search_user'];
        //$search_cond = $this->_model->where(array("where"=>array("username",$username,"=")));
        //$search=  $this->_model->getAllRecords($search_cond,"users");
        $search=  $this->_model->searchUsers($username);
        
        //print_r($search);
        if(count($search)===0){
            echo "No match Found";
        }else{
             print_r($search);
        }
        //$this->template->view("",$data);
    }
	public function testChoice(){
		print($this->choice[1]);
	}
}