<?php
class Login_Controller extends E_Controller
{
    private $_model;
    public function __construct(){
        parent::__construct();
        $this->_model=new Login_Model("users");
    }

		
	public function login($render=1,$path='',$tags=array("All"))
	{
                
        $setup_cond = $this->_model->where(array(array("where","url","Login/login","=")));
        $rlst_setup = $this->_model->getAllRecords($setup_cond,"setup");
	}
        
	public function show_login()
            {
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
		$menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("Basic/login");
		$this->template->view("Basic/footer",$recent);
            }
        
        public function logged(){
            
            $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
            $encrypted_pwd = md5($_POST['txtPassword']);
            $conds = $this->_model->where(array("where"=>array("username",$_POST['txtusername'],"="),"AND"=>array("password",$encrypted_pwd,"=")));
            $rst = $this->_model->getAllRecords($conds,"users");
            //$new_arr = array_splice($rst,7,1);
            if(count($rst)>0){
                //echo "You are Allowed!";
                foreach($rst[0] as $key=>$value):
                    $_SESSION[$key]=$value;
                endforeach;
                //echo $_SESSION['email'];
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
                if($_SESSION['logs_after_register']==='0'){
                    $this->template->view("Basic/changePwd");
                }  else {
                    $this->template->view();
                }
		$this->template->view("Basic/footer",$recent);
                
            }  else {
                echo 1;
                //print_r($new_arr);
            }
            
        }
        
	public function logout()
	{
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                if(isset($_SESSION['username'])){
                    session_unset();
                    
                }
                $_SESSION['username']="Guest";
                $_SESSION['usrlvl']='0';
		$_SESSION['ID']='0';
                //print_r($recent);
		$menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("Basic/welcome");
		$this->template->view("Basic/footer",$recent);
	}
        
        public function userProfile(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
                $pos_cond = $this->_model->where(array("where"=>array("posID",$_SESSION['usrlvl'],"=")));
                $pstn = $this->_model->getAllRecords($pos_cond,"positions");
                
                $cnd = $this->_model->where(array("where"=>array("username",$_SESSION['username'],"=")));
                $data = $this->_model->getAllRecords($cnd,"users");
                $raw = (array)$data[0];
                array_splice($raw,5,1);
                $raw['usrlvl']=$pstn[0]->title;
                if($raw['admin']==='1'){$raw['admin']="Yes";}  else {$raw['admin']="No";}
                if($raw['auth']==='1'){$raw['auth']="Yes";}  else {$raw['auth']="No";}
                $final[] = json_decode(json_encode($raw));
		$this->template->view("",$final);
		$this->template->view("Basic/footer",$recent);
        }
        
        public function forgotPass(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $data = $this->_model->getAllRecords("","securityqueries");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view("",$data);
		$this->template->view("Basic/footer",$recent);
        }
        public function passReset(){
            $email = $_POST['email'];
            $qstn = $_POST['qstn'];
            $qAns = $_POST['qAns'];
            $password=  md5($_POST['password']);
            if($qAns!==""){
                $reset_cond = $this->_model->where(array("where"=>array("qAns",$qAns,"="),"AND"=>array("securityQstnID",$qstn,"=")));
                $rst_arr = $this->_model->getAllRecords($reset_cond,"users");
                if(count($rst_arr)>0){
                    $ans = 1;
                }else{
                    $ans = 0;
                }
            }  elseif($password!=="") {
                $reset_cond = $this->_model->where(array("where"=>array("pwd",$password,"=")));
                $rst_arr = $this->_model->getAllRecords($reset_cond,"pwdbackup","=");
                if(count($rst_arr)>0){
                    $ans = 1;
                }  else {
                    $ans = 0;    
                }
            }  else {
                $ans = 0; 
            }
            //echo $ans;
            
            if($ans===1){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);
            }else{
                echo $ans;
            }

        }
        
        public function newPassReset(){
            $pwd=  md5($_POST['password']);
            $sets = array('password'=>$pwd);
            $newPwd_cond = $this->_model->where(array("where"=>array("ID",$_SESSION['ID'],"=")));
            $newPwd_rst = $this->_model->updateQuery($sets,$newPwd_cond,"users");
            echo $newPwd_rst;
        }
        
        public function aboutus(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);  
        }
        
                
        public function contacts(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);  
        }
	
        public function notices(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);  
        }
        
        public function help(){
                $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
                $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");
                $menu=$this->model->getAllRecords("","menu");
		$this->load_menu->menu($menu);
		$this->template->view();
		$this->template->view("Basic/footer",$recent);  
        }
}
