<?php
class Claims_Controller extends E_Controller
{
    public $pagination;
    public $limit;
    public $offset;
    public $_model;
    public function __construct(){
        parent::__construct();

        $this->_model=new Claims_Model("chat");

    }
    
    public function viewClaims() {
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords();
        $this->load_menu->menu($menu);
        $this->template->view("welcome/views");
        $this->template->view("welcome/footer",$recent);
    }
    
    public function viewMedicalClaims(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $this->limit = 4;
        $this->pagination=new Paginator("claims",$this->limit);
        $this->offset = $this->pagination->set_offset();
        
        echo "Records #: ".$this->pagination->get_num_records()."<br>";
        echo "Page No: ".$this->pagination->set_page()."<br>";
        echo "Offset: ".$this->pagination->set_offset();
        
        if($_SESSION['userlevel']==='1'){
            $cond = $this->model->where(array("where"=>array("proNo",$_SESSION['username'],"=")));
            $dt = $this->model->getAllRecords($cond,"claims","LIMIT $this->offset,$this->limit");
        }elseif($_SESSION['userlevel']==='2'){
            $cond = $this->model->where(array("where"=>array("cluster",$_SESSION['cst'],"=")));
            $dt = $this->model->getAllRecords($cond,"claims","LIMIT $this->offset,$this->limit");
        }  else {
            
            $dt = $this->model->getAllRecords("","claims","LIMIT $this->offset,$this->limit");
        }
        $pages = $this->pagination->paginate();
        $data = array($dt,$pages);
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
        
    }
    public function newMedicalClaim(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);   
    }
    public function getCname() {
        $_cond = $this->model->where(array("where"=> array("childNo",$this->choice[1],"=")));
        $rst = $this->model->getAllRecords($_cond,"childdetails");
        if(sizeof($rst)!==0){
            foreach ($rst as $value) {
                $data = $value->childName;
                $data .= ",";
                $data .= $value->sex;
                $data .= ",";
                $data .= $value->dob;
            }
        }else{
                $data = "Name not found!";;
                $data .= ",";
                $data .= "Gender Missing!";
                $data .= ",";
                $data .= "Date of Birth Missing!";
        }
        echo $data;
    }
    
    function medicalClaimEntry(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $data=$this->model->insertArray(filter_input_array(INPUT_POST),"claims");
        $this->template->view("",$data);
        $this->template->view("welcome/footer",$recent);
    }
    
    function remarkMedicalClaim(){
        if($this->choice[5]>0){
            $del=img_tag("diskdel.png",array("title"=>"Delete Receipt","style"=>"border:2px red solid;margin:2px;"));
            $rnd =$this->choice[5];      
        }else{
            $del="";
            $rnd=0;
        }
        $set = array("rmks"=>$this->choice[1]);
        $cond = $this->model->where(array("where"=>  array("rec",  $this->choice[3],"=")));
        $rlst = $this->model->updateQuery($set,$cond,"claims");
        
        if($rlst===1&&$this->choice[1]==='0'&&$_SESSION['userlevel']==='2'){echo img_tag("waiting.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Unapproved","id"=>"rmk_".$this->choice[3],"onclick"=>"editRemarks(this,2,$rnd);"))."".img_tag("reject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Reject","id"=>"rmk_".$this->choice[3]."","onclick"=>"editRemarks(this,1,$rnd);"))."".$del;} 

        elseif ($rlst===1&&$this->choice[1]==='1') {echo img_tag("unreject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approve/ Unreject","id"=>"rmk_".$this->choice[3]."","onclick"=>"editRemarks(this,2,$rnd);"))."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='2'&&$_SESSION['userlevel']==='2') {echo img_tag("approved.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approved","id"=>"rmk_".$this->choice[3],"onclick"=>"editRemarks(this,0,$rnd);"))."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='2'&&$_SESSION['userlevel']==='5') {echo "<button style='background-color:red;' onclick='editRemarks(this,4,$rnd);'>Process</button><button style='background-color:pink;' onclick='editRemarks(this,3,$rnd);'>Reject</button>"."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='3') {echo "<button  style='background-color:pink;' onclick='editRemarks(this,4,$rnd);'>Unreject</button>"."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='4'&&$_SESSION['userlevel']==='5') {echo "<button  onclick='editRemarks(this,2,$rnd);'>Unprocess</button>"."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='4'&&$_SESSION['userlevel']==='10') {echo "<button style='background-color:red;' onclick='editRemarks(this,6,$rnd);'>Level 1 Approve</button><button    style='background-color:pink;' onclick='editRemarks(this,5,$rnd);'>Reject</button>"."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='6') {echo "<button onclick='editRemarks(this,4,$rnd);'>Un-approve</button>"."".$del;}
        
        elseif ($rlst===1&&$this->choice[1]==='5') {echo "<button  style='background-color:pink;' onclick='editRemarks(this,4,$rnd);'>Unreject</button>"."".$del;}
        
        else {
            echo $rlst;
        }
    }
    function notesHistory(){      
        $cond = $this->model->where(array("where"=>array("tIndx",$this->choice[1],"="),"AND"=>  array("tbl","claims","=")));
        $rst = $this->model->getAllRecords($cond,"chat","ORDER BY stmp DESC");
        if(sizeof($rst)>0){
            foreach ($rst as $value) {
                $sender = $this->_model->chatFrmUsersNames($value->frmID);
                $recepient = $this->_model->chatFrmUsersNames("",$value->toID);
                echo "<b>From: ".$sender." To: ".$recepient."</b><br>";
                echo "Message: ".$value->msg."<br>";
                echo "<hr>";
                echo "|";
            }
        }else {

            echo "No Conversation found!";
        }
    }
    
    function postNote(){
        $frmID = $_SESSION['userid'];
        $msg = $this->choice[3];
        $tbl = "claims";
        $tIdFld = "rec";
        $recid =  $this->choice[5];
        $toID = $this->_model->chatToUserId($this->choice[1]);
        if($toID!==0){
                $sender = $this->_model->chatFrmUsersNames($frmID);
                $recepient = $this->_model->chatFrmUsersNames("",$toID);
                $arr = array("tbl"=>$tbl,"tIdFld"=>$tIdFld,"tIndx"=>$recid,"frmID"=>$frmID,"toID"=>$toID,"msg"=>$msg);      
                $this->model->insertRecord($arr,"chat");
                echo "<b>From: ".$sender." To: ".$recepient."</b><br>";
                echo "Message: ".$msg."<br>";
        }else{
            echo "User {$this->choice[1]} was not found! Your message has not been delivered!";
        }
        
    }
    
    public function batchMedicalRemarks(){
        $rec_str = $this->choice[3];
        $rmk = $this->choice[1];
        
        $rec_arr_raw =explode(",",$rec_str);
        $rec_arr = array();
        foreach($rec_arr_raw as $rec_vals):
            if($rec_vals!=='0'){
                $rec_arr[]=$rec_vals;
            }
        endforeach;
        echo $this->_model->batchUpdateMedical($rmk,$rec_arr);
        
    }
    
    public function editClaim(){
        $fld = $this->choice[1];
        $val =  $this->choice[3];
        $contr = $this->choice[5];
        $rec = $this->choice[7];
        $sts = array($fld=>$val,"careContr"=>$contr);
        $cd = $this->model->where(array("where"=>  array("rec",$rec,"=")));
        echo $this->model->updateQuery($sts,$cd,"claims");
    }
    
    public function viewReceipt(){
        $rct_raw = $this->choice[1];
        $clst= $this->choice[3];
        $icpNo = $this->choice[5];
        $childno_rand = substr($rct_raw,5);
        $rct = $icpNo."-".$childno_rand.".pdf";

        $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$clst.DS.$icpNo.DS.$rct;
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
    }
    public function attachReceipt(){

       $cname = filter_input(INPUT_POST,"clst");
       $icpNo = filter_input(INPUT_POST,"pNo");
       $childNo = filter_input(INPUT_POST,"childNo");
       $rec = filter_input(INPUT_POST,"rec");
       
       if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname)){
        mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname);
        if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname.DS.$icpNo)){
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname.DS.$icpNo);
        }
        }elseif(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname.DS.$icpNo)) {
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname.DS.$icpNo);
        }
       
       $target_dir = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$cname.DS.$icpNo.DS;
       $randNo = rand(1,99999);
       $newfilename = $childNo.'_'.$randNo;
       $target_dir = $target_dir . $newfilename.".pdf"; 

        if (move_uploaded_file($_FILES["rct-".$rec]["tmp_name"], $target_dir)) {

            if($this->_model->uploadReceipt($randNo,$rec,$newfilename)===1){
                echo "<a href='".PATH.DS.$GLOBALS['app'].DS."Claims".DS."viewReceipt/rct/".str_replace("-","",$childNo)."_".$randNo."/clst/".$cname."/icpNo/".$icpNo."' target='_blank'><div style='color:green;'>Available:- ".$childNo."_".$randNo.".pdf</div></a>";
            }  else {
                echo $this->_model->uploadReceipt($randNo,$rec,$newfilename);
            }

        } else {
            echo "Upload Error!";
        }
    }
    
    public function delReceipt(){
        $icp = substr($this->choice[1],0,5);
        $rec = $this->choice[5];
        $rct =  $this->choice[1];
        $clst = $this->choice[3];
        $set = array("randomID"=>0);
        $cnd = $this->model->where(array("where"=>array("rec",$rec,"=")));
        $rst = $this->model->updateQuery($set,$cnd,"claims");
        if($rst===1){
                $fileName = $rct;
                $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."/ftp/medical/claims/".$clst."/".$icp."/".$rct;
                if (!unlink($file))
               {
                echo "Error deleting ".$fileName;
               }
                else
               {
                   $getRst = $this->model->getAllRecords($cnd,"claims");
                   foreach($getRst as $rstVal):
                        echo $rstVal->rmks."*";
                   endforeach;
                        echo "Deleted ".$fileName." successfully";
               }
        }  else {
            echo $rst;
        }

    }
    public function newTVSClaim(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);
    }
   public function newMedicalRequest(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);
    }
   public function newHVCCPRClaim(){
        $rec_cond=  $this->_model->where(array("where"=>array("userid",$_SESSION['ID'],"=")));
        $recent = $this->_model->getAllRecords($rec_cond,"recent"," ORDER BY recID DESC LIMIT 0,10");        
        $menu = $this->model->getAllRecords("","menu");
        $this->load_menu->menu($menu);
        $this->template->view();
        $this->template->view("welcome/footer",$recent);
    }    
}