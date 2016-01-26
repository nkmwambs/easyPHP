<?php
//print_r($data);
echo $data['error'];
if(Resources::session()->userlevel==='1'){
echo "<div id='control' align='center' style='border:2px lightgray groove;padding:5px;'>  | Filter | From: <input style='width:100px;'  type='text' id='frmDate'  value='".$data['fromdate']."'/> To: <input style='width:100px;'  type='text' id='toDate'  value='".$data['todate']."'/> State: <select id='rmkSelect'><option value=''>Select State ...</option><option value='0'>New Claim</option><option value='2'>Checked By PF</option><option value='1'>Rejected By PF</option><option value='4'>Processed By HS</option><option value='3'>Rejected By HS</option></select>".Resources::img("go.png",  array("title"=>"Go","onclick"=>'selectClaims()',"style"=>'cursor:pointer;'))."</div>";
}else{
    if(Resources::session()->userlevel==='2'){$approve = 2;$reject=1;$disapprove=0;}
    elseif(Resources::session()->userlevel==='3'){$approve = 8;$reject=7;$disapprove=6;}
    elseif(Resources::session()->userlevel==='5'){$approve = 4;$reject=3;$disapprove=2;}
    elseif(Resources::session()->userlevel==='6'){$approve = 6;$reject=5;$disapprove=4;}
    elseif(Resources::session()->userlevel==='10'){$approve = 10;$reject=9;$disapprove=8;}
    
    echo "<div id='control' align='center' style='border:2px lightgray groove;padding:5px;'> | Filter | From: <input type='text' style='width:100px;' id='frmDate' value='".$data['fromdate']."'/> To: <input  style='width:100px;' type='text' id='toDate' value='".$data['todate']."'/> State: <select  id='rmkSelect'><option  value=''>Select State ...</option><option value='0'>New Claim</option><option value='2'>Checked By PF</option><option value='1'>Rejected By PF</option><option value='4'>Processed By HS</option><option value='3'>Rejected By HS</option></select>".Resources::img("go.png",  array("title"=>"Go","onclick"=>'selectClaims();',"style"=>'cursor:pointer;'))."</div>";
}

echo "<fieldset>";
echo "<legend style='font-weight:bold;'>Download</legend>";
echo "<span style='font-weight:bold;'>Download Medical Claims: </span><a href='".HOST_NAME."/easyPHP/application/mvc/docs/exceldownloads/medicalclaims.php?from=".strtotime($data['fromdate'])."&to=".strtotime($data['todate'])."&rmk=".$data['rmk']."'>".Resources::img("excel.png")."</a>";
echo "</fieldset>";

//echo "<table class='nav_table' id='viewClaims'>";
$rmk_arr = array("Unchecked By PF","Rejected By PF","Checked By PF","Rejected By HS","Processed By HS","Rejected By PD","Approved By PD/ Unpaid","Rejected By AC","Reimbursed");

echo "<table id='info_tbl' style='margin-top:20px;'>";
//$status="No Records Selected";
//if(is_numeric($rmk_arr[$data['rmk']])){
	$status = $rmk_arr[$data['rmk']];
//}
echo "<caption style='text-align:left;'><b>Claim Status: ".$status."</b></caption>";
    echo "<thead>";
    echo "<col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col>";
    //echo "<caption>".Resources::img("inform.png")." <i><b>Double click a row to view more information for a record in the right pane.</b></i></caption>";
        echo "<tr><th><input type='checkbox' id='chkAll' onclick='chkAll(this);'/></th><th>KE No</th><th>Cluster</th><th>Child No</th><th>Child Name</th><th>Payment Date</th><th>Diagnosis</th><th>Total Amount</th><th>Caregiver Contribution</th><th>N.H.I.F</th><th>Amount Reimbursable</th><th>Facility Name</th><th>Facility Type</th><th>Claim Type</th><th>Claim Date</th><th>Voucher No</th><th>Receipt</th><th>Request Approval Document</th><th>Claim Count</th><th>Status</th></tr>";
    echo "</thead>";
    
    echo "<tbody>";
    $waive="";
       foreach($data['claims'] as $elem):
           // Remarks control
           if($elem->rmks==='0'&&($_SESSION['userlevel']!=='2')){
           		$rmk=Resources::img("new.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Unchecked By PF"));
           }
           if($elem->rmks==='0'&&$_SESSION['userlevel']==='1'){
           		$rmk=Resources::img("edit.png",array("style"=>"border:2px red solid;margin:2px;","title"=>"Edit","onclick"=>"editClaim(\"$elem->rec\");"))."".Resources::img("uncheck.png",array("style"=>"border:2px green solid;margin:2px;","title"=>"Delete Claim","onclick"=>"deleteClaim(this,\"$elem->rec\");"));
		   }
           if($elem->rmks==='0'&&$_SESSION['userlevel']==='2'){
           		$waive = Resources::img("clear.png",array("Title"=>"Waive Caregivers Contribution","style"=>"cursor:pointer;","onclick"=>"waiveparentscontribution(this,\"".$elem->rec."\",\"".$elem->totAmt."\")"));
           		$rmk=Resources::img("waiting.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Unchecked By PF","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,2,$elem->randomID);"))."".Resources::img("reject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Reject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,1,$elem->randomID);"));
		   }

           if($elem->rmks==='1'&&($_SESSION['userlevel']!=='2')){$rmk=Resources::img("uncheck.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Rejected By PF"));}
           if($elem->rmks==='1'&&($_SESSION['userlevel']==='1')){$rmk=Resources::img("edit.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Edit"))."".Resources::img("uncheck.png",array("style"=>"border:2px green solid;margin:2px;","title"=>"Delete Claim","onclick"=>"deleteClaim(this,\"$elem->rec\");"));}
           if($elem->rmks==='1'&&$_SESSION['userlevel']==='2'){$rmk=Resources::img("unreject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approve/ Unreject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,2,$elem->randomID);"));}
 			
 			if($elem->rmks==='1'||$elem->rmks==='3'||$elem->rmks==='5'){
           		$rmk.= " ".Resources::img("info.png",array("Title"=>"View Notes","style"=>"cursor:pointer;","onclick"=>"viewNotes(\"".$elem->rec."\")"));
           	}
           
           if($elem->rmks==='2'&&$_SESSION['userlevel']!=='2'){$rmk=Resources::img("check.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Checked By PF"));}
           if($elem->rmks==='2'&&$_SESSION['userlevel']==='2'){
           		$rmk=Resources::img("approved.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Checked By PF","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,0,$elem->randomID);"));
		   }
           if($elem->rmks==='2'&&($_SESSION['userlevel']=='5')){$rmk=Resources::img("waiting.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Unapproved","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,4,$elem->randomID);"))."".Resources::img("reject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Reject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,3,$elem->randomID);"));}
           
           if($elem->rmks==='3'&&($_SESSION['userlevel']!=='5')){$rmk=$rmk=Resources::img("unprocessed.png",array("style"=>"border:2px green solid;margin:2px;","title"=>"Rejected By HS"));}
           if($elem->rmks==='3'&&($_SESSION['userlevel']=='5')){$rmk=Resources::img("unreject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approve/ Unreject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,4,$elem->randomID);"));}
           
           if($elem->rmks==='4'&&($_SESSION['userlevel']!=='5')){$rmk=Resources::img("processed.png",array("style"=>"border:2px green solid;margin:2px;","title"=>"Processed By HS"));}
           if($elem->rmks==='4'&&($_SESSION['userlevel']==='5')){$rmk=Resources::img("approved.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approved","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,2,$elem->randomID);"));}
           if($elem->rmks==='4'&&($_SESSION['userlevel']==='10')){$rmk="<button style='background-color:red;' onclick='editRemarks(this,6,$elem->randomID);'>Level 1 Approve</button><button style='background-color:pink;'  onclick='editRemarks(this,5,$elem->randomID);''>Reject</button>";}
           
           if($elem->rmks==='5'&&($_SESSION['userlevel']!=='10')){$rmk="<button style='background-color:gray;'>Rejected by TSM</button>";}
           if($elem->rmks==='5'&&($_SESSION['userlevel']==='10')){$rmk="<button style='background-color:pink;' onclick='editRemarks(this,6,$elem->randomID);'>Unreject</button>";}
           
           if($elem->rmks==='6'&&($_SESSION['userlevel']!=='10')){$rmk="<button style='background-color:gray;'>Level 1 Approved</button>";}
           if($elem->rmks==='6'&&($_SESSION['userlevel']==='10')){$rmk="<button onclick='editRemarks(this,4,$elem->randomID);'>Un-approve</button>";}
           if($elem->rmks==='6'&&($_SESSION['userlevel']==='6')){$rmk="<button style='background-color:red;' onclick='editRemarks(this,8,$elem->randomID);'>Level 2 Approve</button>";}
           
           //End of remarks control
           
           //Start Receipt Control
            $rct = "";
            $refNo ="";
            $delRct ="";
			$delRef ="";
            if(!empty($elem->rct)){
            	$grp = "claims";
            	$delRct=Resources::img("diskdel.png",array("title"=>"Delete Receipt","style"=>"border:2px red solid;margin:2px;","onclick"=>"delReceipt(\"".$elem->rct."\",\"".$elem->cluster."\",\"".$elem->proNo."\",\"".$elem->rec."\",\"".$grp."\");"));
       			$rct = "<a href='".HOST_NAME."/easyPHP/application/mvc/docs/downloadfiles.php?file_name=".$elem->rct."&cst=".$elem->cluster."&icp=".$elem->proNo."&grp=claims' target='_blank'>".$elem->rct."</a>".$delRct;
            }else{
            	$rct = "<form method='POST' action='' id='frm-".$elem->rec."' enctype='multipart/form-data'>"
                ."<input type='file' name='rct' id='rct' onchange='uploadRct(\"".$elem->rec."\",\"frm-".$elem->rec."\");'/>"
                ."<input type='hidden' name='pNo' value='".$elem->proNo."'/>"
                ."<input type='hidden' name='clst' value='".$elem->cluster."'/>"
                ."<input type='hidden' name='childNo' value='".$elem->childNo."'/>"
                ."<input type='hidden' name='rec' value='".$elem->rec."'/>"
                ."<input type='hidden' name='docgrp' value='claims'/>"
                . "</form>";

            }	
 			
 			if(!empty($elem->refNo)){
 				$grp = "supportdocs";
       			$delRef=Resources::img("diskdel.png",array("title"=>"Delete Receipt","style"=>"border:2px red solid;margin:2px;","onclick"=>"delReceipt(\"".$elem->refNo."\",\"".$elem->cluster."\",\"".$elem->proNo."\",\"".$elem->rec."\",\"".$grp."\");"));
				$refNo = "<a href='".HOST_NAME."/easyPHP/application/mvc/docs/downloadfiles.php?file_name=".$elem->refNo."&cst=".$elem->cluster."&icp=".$elem->proNo."&grp=supportdocs' target='_blank'>".$elem->refNo."</a>".$delRef;				
            }else{
            	$refNo = "<form method='POST' action='' id='ref-".$elem->rec."' enctype='multipart/form-data'>"
                ."<input type='file' name='refNo' id='refNo' onchange='uploadRct(\"".$elem->rec."\",\"ref-".$elem->rec."\");'/>"
                ."<input type='hidden' name='pNo' value='".$elem->proNo."'/>"
                ."<input type='hidden' name='clst' value='".$elem->cluster."'/>"
                ."<input type='hidden' name='childNo' value='".$elem->childNo."'/>"
                ."<input type='hidden' name='rec' value='".$elem->rec."'/>"
                ."<input type='hidden' name='docgrp' value='supportdocs'/>"
                . "</form>";
            }	

           //End Receipt Control
      
          
      echo "<tr id='rw_".$elem->rec."_".$elem->childNo."'><td><input type='checkbox' id='chk_".$elem->rec."' class='chks'/>".$waive."</td><td>{$elem->proNo}</td><td>{$elem->cluster}</td><td>{$elem->childNo}</td><td>{$elem->childName}</td><td>{$elem->treatDate}</td><td>{$elem->diagnosis}</td><td>".number_format($elem->totAmt,0)."</td><td>".number_format($elem->careContr,0)."</td><td>{$elem->nhif}</td><td>".number_format($elem->amtReim)."</td><td>{$elem->facName}</td><td>{$elem->facClass}</td><td>{$elem->type}</td><td>{$elem->date}</td><td>{$elem->vnum}</td><td id='rct-".$elem->rec."'>{$rct}</td><td id='ref-".$elem->rec."'>{$refNo}</td><td>{$elem->claimCnt}</td><td id='rmk_td_".$elem->rec."'>".$rmk."</td></tr>";
       endforeach;
    
    echo "</tbody>";
echo "</table>";

//Navigation DIV

echo "<div style='margin-top:15px;'>";

	if($data['pageNum']===0){
		for ($i=$data['pageNum']+1; $i < $data['totalPages']+1; $i++) {
			echo Resources::a_href("Claims/viewMedicalClaims/offset/".$i,$i,array("class"=>"nav_button"));
		}
	}elseif($data['pageNum']===$data['totalPages']){
			echo Resources::a_href("Claims/viewMedicalClaims/offset/".$data['pageNum'],"Previous",array("class"=>"nav_button"));
		for ($i=$data['pageNum']+1; $i < $data['totalPages']+1; $i++) {
			echo Resources::a_href("Claims/viewMedicalClaims/offset/".$i,$i,array("class"=>"nav_button"));	
		}	
	}else{
		echo Resources::a_href("Claims/viewMedicalClaims/offset/".$data['pageNum'],"Previous",array("class"=>"nav_button"));
		for ($i=$data['pageNum']+1; $i < $data['totalPages']+1; $i++) {
			echo Resources::a_href("Claims/viewMedicalClaims/offset/".$i,$i,array("class"=>"nav_button"));	
		}
		echo Resources::a_href("Claims/viewMedicalClaims/offset/".$data['totalPages'],"Next",array("class"=>"nav_button"));
	}	 


echo "</div>";

//echo $data['rmk'];