<?php
class Claims_Controller extends E_Controller
{
    public $_model;
    public function __construct(){
        parent::__construct();

        $this->_model=new Claims_Model("claims");

    }
    
    public function viewClaims($render=1,$path="",$tags=array("All")) {

    }
	public function waiveparentscontribution(){
		$rec = $_POST['rec'];
		$careContr = $_POST['careContr'];
		$amtReim = $_POST['amtReim'];
		
		$set_arr = array("careContr"=>$careContr,"amtReim"=>$amtReim);
		$waive_cond = $this->_model->where(array(array("WHERE","rec",$rec,"=")));
		
		$this->_model->updateQuery($set_arr,$waive_cond,"claims");
		
		echo "Waive Successful";	
	}
	public function claimCnt(){
		$childNo = $_POST['childNo'];
		//echo $childNo;
		$cnt_cond = $this->_model->where(array(array("WHERE","childNo",$childNo,"=")));
		$cnt_qry = $this->_model->getAllRecords($cnt_cond,"claims","",array("childNo"));
		
		$cnt=1;
		if(count($cnt_qry)>0){
			$cnt += count($cnt_qry); 
		}
		echo $cnt;
	}
  public function viewMedicalClaims($render=1,$path='',$tags=array("1","2","5")){
		$data=array();
		$error="";
		$limit=50;//Records Per Page
		$offset=0;
		$pageNum = $offset*$limit;
		
		 if(isset($_POST['offset'])){
		 	$offset=$_POST['offset']-1;
			$pageNum = $offset*$limit;
		 }
		
		//Set Date Conditions
		$frmDate = date("Y-m-01");
		$toDate = date("Y-m-t");
		if(isset($_POST['frmDate'])||isset($_POST['toDate'])){
			$frmDateRaw = $_POST['frmDate'];
			$toDateRaw = $_POST['toDate'];
			if(($frmDateRaw===""&&$toDateRaw!=="")||($frmDateRaw!==""&&$toDateRaw==="")){
				$error='<div id="error_div">Date fields should be filled in pairs</div>';
			}else{
				$frmDate = $frmDateRaw;
				$toDate = $toDateRaw;
			}
		}
		
		
		//Active Claims
		$rmk=0;
		if(isset($_POST['rmk'])){
				$rmk=$_POST['rmk'];
		}
			$cond_claim = $this->_model->where(array(array("WHERE","rmks",$rmk,"="),array("AND","date",$frmDate,">="),array("AND","date",$toDate,"<=")));
		if(Resources::session()->userlevel==='1'){
			if(isset($_POST['rmk'])){
				$rmk=$_POST['rmk'];
			}
			$cond_claim = $this->_model->where(array(array("WHERE","proNo",Resources::session()->fname,"="),array("AND","rmks",$rmk,"="),array("AND","date",$frmDate,">="),array("AND","date",$toDate,"<=")));
		}elseif(Resources::session()->userlevel==='2'){
			if(isset($_POST['rmk'])){
				$rmk=$_POST['rmk'];
			}
			$cond_claim = $this->_model->where(array(array("WHERE","cluster",Resources::session()->cname,"="),array("AND","rmks",$rmk,"="),array("AND","date",$frmDate,">="),array("AND","date",$toDate,"<=")));
		}elseif(Resources::session()->userlevel==='5'){
			$rmk=2;
			if(isset($_POST['rmk'])){
				$rmk=$_POST['rmk'];
			}
			$cond_claim = $this->_model->where(array(array("WHERE","rmks",$rmk,"="),array("AND","date",$frmDate,">="),array("AND","date",$toDate,"<=")));
		}
		
		$claim_arr = $this->_model->getAllRecords($cond_claim,"claims","LIMIT $pageNum,$limit");
		
		//Total Pages
		$totalPages_arr = $this->_model->getAllRecords($cond_claim,"claims");
		$cnt=count($totalPages_arr)/$limit;
		
		$data['claims']=$claim_arr;
		$data['totalPages']=ceil($cnt);
		$data['pageNum']=$offset;
		$data['rmk']=$rmk;
		$data['error']=$error;
		$data['fromdate']=$frmDate;
		$data['todate']=$toDate;
		$data['btn']=$offset+1;
		$data['rmk']=$rmk;
		
		return $data;
        
    }
public function postRejectionNotes(){
	$rec['recid'] = $_POST['recid'];
	$rec['rson'] = $_POST['rson'];
	$rec['userid'] = Resources::session()->ID;
	
	//Get Child Details
	$child_cond = $this->_model->where(array(array("WHERE","rec",$_POST['recid'])));
	$child_qry = $this->_model->getAllRecords($child_cond,"claims","","childNo");
	$childNo = $child_qry[0]->childNo;
	
	$this->_model->insertRecord($rec,"detail");
	
	//Mail a notification
	$icp_mail_cond = $this->_model->where(array(array("WHERE","username",$icpNo,"=")));
	$icp_mail_arr=$this->_model->getAllRecords($icp_mail_cond,"users","",array("email"));
	$email = $icp_mail_arr[0]->email;
	 
	$title = "Medical Claim Declining comment for ".$childNo;
	
	$body = "You a medical claim declining comment from ".Resources::session()->fname." for beneficiary ".$childNo.":\n\n {$_POST['rson']}";
	 
	Resources::mailing($email, $title, $body); 
	
	echo "Post successful for record ID".$_POST['recid'];
	
}
public function viewNotes(){
	$rec = $this->choice[1];
	
	//Get All Notes
	$notes_cond = $this->_model->where(array(array("WHERE","detail.recid",$rec,"=")));
	$notes_qry = $this->_model->getAllRecords($notes_cond,"detail","",array("users.fname:username","detail.rson:reason"),array("LEFT JOIN"=>array("detail"=>"userid","users"=>"ID")));
	
	if(empty($notes_qry)){
		echo "0";
	}else{
		print_r(json_encode($notes_qry));
	}
	
	
	}
public function newMedicalClaim($render=1,$path='',$tags=array("1")){
  	$data=array();
  	//Check if ICP has CSP
  	$icpNo = Resources::session()->fname;
  	$chk_csp_cond = $this->_model->where(array(array("WHERE","icpNo",$icpNo,"=")));
	$chk_csp_arr = $this->_model->getAllRecords($chk_csp_cond,"csp_projects","",array("cspNo"));
	
	if(!empty($chk_csp_arr)){
		$data['csp']=$chk_csp_arr;
	}
	
	return $data;
    }
    public function getCname() {
        $claim_cond = $this->_model->where(array(array("where","childNo",$_POST['cNo'],"=")));
        $rst = $this->_model->getAllRecords($claim_cond,"childdetails");
        if(count($rst)!==0){
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
    public function viewReceipt(){
        $rct = $_POST['rct'];
		$icpNo= $_POST['icp'];
		$clst = $_POST['cst'];
		$grp = $_POST['grp'];

        $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$grp.DS.$clst.DS.$icpNo.DS.$rct;
        header('Content-type: application/force-download');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($file));
        header('Accept-Ranges: bytes');
        @readfile($file);
    }
public function otherftpupload($cst,$icpNo,$file,$filegrp,$i=""){
  		$cname = $cst;//filter_input(INPUT_POST,"clst");
       	$icpNo = $icpNo;//filter_input(INPUT_POST,"pNo");
       	$file = $file;//filter_input(INPUT_POST,"childNo");
       
       	if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname)){
        	mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname);
        	if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo)){
            	mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo);
        	}
        }elseif(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo)) {
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo);
        }
       
       $target_dir = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo.DS;
      
       $newfilename = $file;
       $target_dir = $target_dir . $newfilename; 
		
		if($i!==""){			
	        if (move_uploaded_file($_FILES['refNo']["tmp_name"][$i], $target_dir)) {
				$data['info']= 1;	
	        } else {
	            $data['info']= 0;
	        }
		}else{
			if (move_uploaded_file($_FILES['refNo']["tmp_name"], $target_dir)) {
				$data['info']= 1;	
	        } else {
	            $data['info']= 0;
	        }
		}
		
		return $data;
}    	
public function ftpupload($cst,$icpNo,$file,$filegrp,$i=""){
  		$cname = $cst;//filter_input(INPUT_POST,"clst");
       	$icpNo = $icpNo;//filter_input(INPUT_POST,"pNo");
       	$file = $file;//filter_input(INPUT_POST,"childNo");
       
       	if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname)){
        	mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname);
        	if(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo)){
            	mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo);
        	}
        }elseif(!is_dir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo)) {
            mkdir(BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo);
        }
       
       $target_dir = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$filegrp.DS.$cname.DS.$icpNo.DS;
      
       $newfilename = $file;
       $target_dir = $target_dir . $newfilename; 
		
		if($i!==""){			
	        if (move_uploaded_file($_FILES['rct']["tmp_name"][$i], $target_dir)) {
				$data['info']= 1;	
	        } else {
	            $data['info']= 0;
	        }
		}else{
			if (move_uploaded_file($_FILES['rct']["tmp_name"], $target_dir)) {
				$data['info']= 1;	
	        } else {
	            $data['info']= 0;
	        }
		}
		
		return $data;
}    
public function attachReceipt(){
       $cname = filter_input(INPUT_POST,"clst");
       $icpNo = filter_input(INPUT_POST,"pNo");
       $childNo = filter_input(INPUT_POST,"childNo");
       $rec = filter_input(INPUT_POST,"rec");
	   $docgrp = filter_input(INPUT_POST,"docgrp");
	   $randNo = rand(1000,99999);
	   
	   $filename_arr="";
	   if($docgrp==="claims"){
	   		//$filename_arr = explode(".",$_FILES['rct']['name']);
	   }else{
	   		//$filename_arr = explode(".",$_FILES['refNo']['name']);
	   }
	   print_r($_POST);
	   /*
		$file_ext = $filename_arr[1];
		$file = $childNo."_".$randNo.".".$file_ext;
		//$filegrp = "claims";
	   $upload="";
	   if($docgrp==="claims"){
	   	$upload = $this->ftpupload($cname, $icpNo, $file,$docgrp);
	   }else{
	   	 $upload = $this->otherftpupload($cname, $icpNo, $file,$docgrp);
	   }

	   
	   if ($upload) {

            if($this->_model->uploadReceipt($randNo,$rec,$file,$docgrp)===1){
                echo "<a href='".PATH.DS.$GLOBALS['app'].DS."Claims".DS."viewReceipt/rct/".$file."/clst/".$cname."/icpNo/".$icpNo."/grp/".$docgrp."' target='_blank'><div style='color:green;'>Available:- ".$childNo."_".$randNo.".".$file_ext."</div></a>";
            }  else {
                echo $this->_model->uploadReceipt($randNo,$rec,$file,$docgrp);
            }

       } else {
            echo "Upload Error!";
       }
	 */
    }
public function attachRef(){
       $cname = filter_input(INPUT_POST,"clst");
       $icpNo = filter_input(INPUT_POST,"pNo");
       $childNo = filter_input(INPUT_POST,"childNo");
       $rec = filter_input(INPUT_POST,"rec");
	   $randNo = rand(1000,99999);
	   
	   //check if random number exists
	   $rand_cond = $this->_model->where(array(array("WHERE","rec",$rec,"=")));
	   $rand_qry = $this->_model->getAllRecords($rand_cond,"claims","",array("randomID"));
	   if(!empty($rand_qry)){
	   	$randNo = $rand_qry[0]->randomID;
	   }
	   
	   $filename_arr = explode(".",$_FILES['refNo']['name']);
		$file_ext = $filename_arr[1];
		$file = $childNo."_".$randNo.".".$file_ext;
		$filegrp = "supportdocs";
	   
	   $upload = $this->otherftpupload($cname, $icpNo, $file,$filegrp);
	   
	   if ($upload) {

            if($this->_model->uploadRef($randNo,$rec,$file)===1){
                echo "<a href='".PATH.DS.$GLOBALS['app'].DS."supportdocs".DS."viewReceipt/rct/".$file."/clst/".$cname."/icpNo/".$icpNo."/grp/supportdocs' target='_blank'><div style='color:green;'>Available:- ".$childNo."_".$randNo.".".$file_ext."</div></a>";
            }  else {
                echo $this->_model->uploadReceipt($randNo,$rec,$file);
            }

       } else {
            echo "Upload Error!";
       }
	 
    }
public function medicalClaimEntry(){
		$entry = $_POST;
		
		//Format Receipt file name and Assign Random ID
		$rec_cnt = count($_POST['childNo']);
		for ($i=0; $i < $rec_cnt; $i++) {
			$rand = rand(1000, 99999); 
			$file_ext_arr = explode(".",$_FILES['rct']['name'][$i]);
			$file_ext = $file_ext_arr[1];
			$entry['rct'][]=$entry['childNo'][$i]."_".$rand.".".$file_ext;
			$entry['randomID'][]=$rand;	
			
			//Format Approval document file name and Assign Random ID if any
			if($_FILES['refNo']['error'][$i]===0||$_FILES['refNo']['size'][$i]!==0){
				$support_file_ext_arr = explode(".",$_FILES['refNo']['name'][$i]);
				$support_file_ext = $support_file_ext_arr[1];	
				$entry['refNo'][]=$entry['childNo'][$i]."_".$rand.".".$support_file_ext;				
			}
		}
		
		//print_r($_FILES['refNo']);
		
		
		//Upload receipts to the server
		for ($i=0; $i < $rec_cnt; $i++) { 
				$filegrp = "claims";
				$file = $entry['rct'][$i];
				$icpNo = Resources::session()->fname;
				$cst = Resources::session()->cname;
				$this->ftpupload($cst, $icpNo, $file,$filegrp,$i);
				
				//Upload approval support document
				if($_FILES['refNo']['error'][$i]===0||$_FILES['refNo']['size'][$i]!==0){
					$support_filegrp = "supportdocs";
					$support_file = $entry['refNo'][$i];
					$this->otherftpupload($cst, $icpNo, $support_file,$support_filegrp,$i);
				}
		}
	
		
		//Insert to database
		
	    $this->_model->insertArray($entry,"claims");
		
	    //Mail Voucher to PF
		$pf_email_cond=$this->_model->where(array(array("where","cname",Resources::session()->cname,"="),array("AND","userlevel","2","=")));
		$pf_email_arr = $this->_model->getAllRecords($pf_email_cond,"users","",array("email"));
		$pf_email="";
		if(count($pf_email_arr)!==0){
			$pf_email = $pf_email_arr[0]->email;
		}else{
			$pf_email="NKarisa@ke.ci.org";
		}
					
		//Mail Body
		$body = "<br>You have new claim(s) posted by ".Resources::session()->fname;		
		
		//Mail Header
		
		$title = Resources::session()->fname." Medical Claims";
		
		Resources::mailing($pf_email, $title, $body); 

        echo "Claims(s) Posted successfully";
	
}
    
public function remarkMedicalClaim(){
	 	$rnd = $this->choice[5];
        $c_set = array("rmks"=>$this->choice[1]);
        $c_cond = $this->_model->where(array(array("where","rec",$this->choice[3],"=")));
        $rlst = $this->_model->updateQuery($c_set,$c_cond,"claims");
		
		//Update approvers
		
		$flds = array();
		$flds['recID']=$this->choice[3];
		$flds['rmkCode'] = $this->choice[1];
		$flds['userLvl'] = Resources::session()->userlevel;
		$flds['appName'] = Resources::session()->ID;
		$flds['addDate'] = date("Y-m-d");
		$this->_model->insertRecord($flds,"appovers");
		
        //Change Remark Icons
        
        if($rlst===1&&$this->choice[1]==='0'&&$_SESSION['userlevel']==='2'){echo Resources::img("waiting.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Unchecked By PF","id"=>"rmk_".$this->choice[3],"onclick"=>"editRemarks(this,2,$rnd);"))."".Resources::img("reject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Reject","id"=>"rmk_".$this->choice[3]."","onclick"=>"editRemarks(this,1,$rnd);"));} 

        elseif ($rlst===1&&$this->choice[1]==='1') {echo Resources::img("unreject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approve/ Unreject","id"=>"rmk_".$this->choice[3]."","onclick"=>"editRemarks(this,2,$rnd);"));}
        
        elseif ($rlst===1&&$this->choice[1]==='2'&&$_SESSION['userlevel']==='2') {echo Resources::img("approved.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Checked By PF","id"=>"rmk_".$this->choice[3],"onclick"=>"editRemarks(this,0,$rnd);"));}
        
        elseif ($rlst===1&&$this->choice[1]==='2'&&$_SESSION['userlevel']==='5') {echo "<button style='background-color:red;' onclick='editRemarks(this,4,$rnd);'>Process</button><button style='background-color:pink;' onclick='editRemarks(this,3,$rnd);'>Reject</button>";}
        
        elseif ($rlst===1&&$this->choice[1]==='3') {echo "<button  style='background-color:pink;' onclick='editRemarks(this,4,$rnd);'>Unreject</button>";}
        
        elseif ($rlst===1&&$this->choice[1]==='4'&&$_SESSION['userlevel']==='5') {echo "<button  onclick='editRemarks(this,2,$rnd);'>Unprocess</button>";}
        
        elseif ($rlst===1&&$this->choice[1]==='4'&&$_SESSION['userlevel']==='10') {echo "<button style='background-color:red;' onclick='editRemarks(this,6,$rnd);'>Level 1 Approve</button><button    style='background-color:pink;' onclick='editRemarks(this,5,$rnd);'>Reject</button>";}
        
        elseif ($rlst===1&&$this->choice[1]==='6') {echo "<button onclick='editRemarks(this,4,$rnd);'>Un-approve</button>";}
        
        elseif ($rlst===1&&$this->choice[1]==='5') {echo "<button  style='background-color:pink;' onclick='editRemarks(this,4,$rnd);'>Unreject</button>";}
        
        else {
            echo $rlst;
        }
    }
    public function deleteClaim(){
    	$rec = $_POST['rec'];
		
		$claim_del_cond = $this->_model->where(array(array("WHERE","rec",$rec,"=")));
		
		$delete_qry = $this->_model->getAllRecords($claim_del_cond,"claims","",array("cluster","proNo","rct"));
		$clst = $delete_qry[0]->cluster;
		$icp = $delete_qry[0]->proNo;
		$rct = $delete_qry[0]->rct;
		
		$reffile = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."refNo".DS.$clst.DS.$icp.DS.$rct;
		$rctfile = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$clst.DS.$icp.DS.$rct;
		
		if(file_exists($reffile)){
			unlink($reffile);
		}
		if(file_exists($rctfile)){
			unlink($rctfile);
		}
		
		$claim_del_qry = $this->_model->deleteQuery($claim_del_cond,"claims");
		
		echo "Deleted Sucessful";
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
        $frmID = $_SESSION['ID'];
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

    
    public function delReceipt(){
        $icp = $_POST['icp'];//substr($this->choice[1],0,5);
        $rec = $_POST['rec'];//$this->choice[5];
        $rct =  $_POST['rct'];//$this->choice[1];
        $clst = $_POST['clst'];//$this->choice[3];
        $docgrp=$_POST['docgrp'];
        
        //Check if Approval support Documents is available
        $support_doc_cond = $this->_model->where(array(array("WHERE","rec",$rec,"=")));
		$support_doc_qry = $this->_model->getAllRecords($support_doc_cond,"claims","",array("refNo"));
		
		$cnd = $this->model->where(array(array("where","rec",$rec,"=")));
		if(count($support_doc_qry)===0){
			$set = array("randomID"=>0);
        	$rst = $this->model->updateQuery($set,$cnd,"claims");
		}
        
		$set_rct="";
		if($docgrp==="claims"){
			$set_rct = array("rct"=>"");
		}else{
			$set_rct = array("refNo"=>"");
		}
		
		$rst_rct = $this->model->updateQuery($set_rct,$cnd,"claims");
		
        $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS.$docgrp.DS.$clst.DS.$icp.DS.$rct;
        if (!unlink($file))
          	{
               	echo "Error deleting ".$rct;
           	}
           	else
           	{
                echo "Deleted ".$rct." successfully";
            }
 
    }
   public function newTVSClaim($render=1,$path='',$tags=array("All")){
        
    }
   public function newMedicalRequest($render=1,$path='',$tags=array("All")){

    }
   public function newHVCCPRClaim($render=1,$path='',$tags=array("All")){

    }    
}