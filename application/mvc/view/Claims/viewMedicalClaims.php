<?php
if($_SESSION['userlevel']==='1'){
echo "<div id='control' align='center' style='border:2px lightgray groove;padding:5px;'> ".Resources::a_href("Claims/newMedicalClaim",Resources::img("plus.png",  array("title"=>"New Claim")),array("onclick"=>"xmlrequest(\"Claims/newMedicalClaim\");"))." | Filter | From: <input style='width:100px;'  type='text' id='frmDate' readonly/> To: <input style='width:100px;'  type='text' id='toDate' readonly/> State: <select><option>Select State ...</option><option>Checked By PF</option><option>Rejected By PF</option><option>Processed By HS</option><option>Rejected By HS</option><option>Level 1 Approved</option><option>Level 1 Rejected</option><option>Level 2 Approved</option><option>Level 2 Rejected</option><option>Paid</option></select>".Resources::img("go.png",  array("title"=>"Go"))."".Resources::img("download.png",  array("title"=>"Download in Excel","style"=>"margin-left:10px;"))."</div>";
}else{
    if($_SESSION['userlevel']==='2'){$approve = 2;$reject=1;$disapprove=0;}
    elseif($_SESSION['userlevel']==='3'){$approve = 8;$reject=7;$disapprove=6;}
    elseif($_SESSION['userlevel']==='5'){$approve = 4;$reject=3;$disapprove=2;}
    elseif($_SESSION['userlevel']==='6'){$approve = 6;$reject=5;$disapprove=4;}
    elseif($_SESSION['userlevel']==='10'){$approve = 10;$reject=9;$disapprove=8;}
    
    echo "<div id='control' align='center' style='border:2px lightgray groove;padding:5px;'>".Resources::img("approved.png",array("title"=>"Approve","style"=>"margin-right:10px;margin-left:10px;","onclick"=>"approveClaims(\"$approve\");"))."".Resources::img("reject.png",array("title"=>"Reject","style"=>"margin-right:10px;","onclick"=>"approveClaims(\"$reject\");"))."".Resources::img("unapproved.png",array("title"=>"Unapprove","style"=>"margin-right:10px;","onclick"=>"approveClaims(\"$disapprove\");"))." From: <input type='text' style='width:100px;' id='frmDate' readonly/> To: <input  style='width:100px;' type='text' id='toDate' readonly/> State: <select><option>Select State ...</option><option>Checked By PF</option><option>Rejected By PF</option><option>Processed By HS</option><option>Rejected By HS</option><option>Level 1 Approved</option><option>Level 1 Rejected</option><option>Level 2 Approved</option><option>Level 2 Rejected</option><option>Paid</option></select>".Resources::img("go.png",  array("title"=>"Go"))."".Resources::img("download.png",  array("title"=>"Download in Excel","style"=>"margin-left:10px;"))."</div>";
}
echo "<table class='nav_table' id='viewClaims'>";
    echo "<thead>";
    echo "<col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col><col>";
    echo "<caption>".Resources::img("inform.png")." <i><b>Double click a row to view more information for a record in the right pane.</b></i></caption>";
        echo "<tr><th><input type='checkbox' id='chkAll' onclick='chkAll(this);'/></th><th>KE No</th><th>Cluster</th><th>Child No</th><th>Child Name</th><th>Payment Date</th><th>Diagnosis</th><th>Total Amount</th><th>Caregiver Contribution</th><th>N.H.I.F</th><th>Amount Reimbursable</th><th>Facility Name</th><th>Facility Type</th><th>Claim Type</th><th>Claim Date</th><th>Voucher No</th><th>Receipt</th><th>Reference No</th><th>Claim Count</th><th>Status</th></tr>";
    echo "</thead>";
    
    echo "<tbody>";
       foreach($data[0] as $elem):
           // Remarks control
           if($elem->rmks==='0'&&($_SESSION['userlevel']!=='2')){$rmk=Resources::img("new.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Unchecked By PF"));}
           if($elem->rmks==='0'&&$_SESSION['userlevel']==='1'){$rmk=Resources::img("edit.png",array("style"=>"border:2px red solid;margin:2px;","title"=>"Edit","onclick"=>"editClaim(\"$elem->rec\");"));}
           if($elem->rmks==='0'&&$_SESSION['userlevel']==='2'){$rmk=Resources::img("waiting.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Unapproved","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,2,$elem->randomID);"))."".Resources::img("reject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Reject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,1,$elem->randomID);"));}

           
           if($elem->rmks==='1'&&($_SESSION['userlevel']!=='2')){$rmk=Resources::img("uncheck.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Rejected By PF"));}
           if($elem->rmks==='1'&&($_SESSION['userlevel']==='1')){$rmk=Resources::img("edit.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Rejected By PF"))."".Resources::img("uncheck.png",array("style"=>"border:2px green solid;margin:2px;","title"=>"Edit","onclick"=>"editClaim(\"$elem->rec\");"));}
           if($elem->rmks==='1'&&$_SESSION['userlevel']==='2'){$rmk=Resources::img("unreject.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approve/ Unreject","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,2,$elem->randomID);"));}

           
           if($elem->rmks==='2'&&$_SESSION['userlevel']!=='2'){$rmk=Resources::img("check.png",  array("style"=>"border:2px green solid;margin:2px;","title"=>"Checked By PF"));}
           if($elem->rmks==='2'&&$_SESSION['userlevel']==='2'){$rmk=Resources::img("approved.png",  array("style"=>"border:2px red solid;margin:2px;","title"=>"Approved","id"=>"rmk_".$elem->rec."","onclick"=>"editRemarks(this,0,$elem->randomID);"));}
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
            $file = BASE_PATH.DS."application".DS.$GLOBALS['app'].DS."ftp".DS."medical".DS."claims".DS.$elem->cluster.DS.$elem->proNo.DS.$elem->childNo."_".$elem->randomID.".pdf";
            if(file_exists($file)){
            $msg ="<a href='".PATH.DS.$GLOBALS['app'].DS."Claims".DS."viewReceipt/rct/".str_replace("-","",$elem->childNo)."_".$elem->randomID."/clst/".$elem->cluster."/icpNo/".$elem->proNo."' target='_blank'><div style='color:green;'>Available:- ".$elem->childNo."_".$elem->randomID.".pdf</div></a>";}else{$msg = "<form method='POST' action='' id='frm-".$elem->rec."' enctype='multipart/form-data'>"
                ."<input type='file' name='rct-".$elem->rec."' id='' onchange='uploadRct(\"".$elem->rec."\",\"frm-".$elem->rec."\");'/>"
                ."<input type='hidden' name='pNo' value='".$elem->proNo."'/>"
                ."<input type='hidden' name='clst' value='".$elem->cluster."'/>"
                ."<input type='hidden' name='childNo' value='".$elem->childNo."'/>"
                ."<input type='hidden' name='rec' value='".$elem->rec."'/>"
                . "</form>";

            }
       $rct .= $msg;
           //End Receipt Control
       
       //Start Delete Control
        
       if($elem->randomID>0){
           $del=Resources::img("diskdel.png",array("title"=>"Delete Receipt","style"=>"border:2px red solid;margin:2px;","onclick"=>"delReceipt(\"".$elem->childNo."_".$elem->randomID.".pdf\",\"".$elem->cluster."\",\"".$elem->rec."\",\"".$elem->randomID."\");"));
       }else{
           $del="";
       }
       
       //End Delete Control 
           echo "<tr id='rw_".$elem->rec."_".$elem->childNo."' ondblclick='showMore(this);'><td><input type='checkbox' id='chk_".$elem->rec."' class='chks'/></td><td>{$elem->proNo}</td><td>{$elem->cluster}</td><td>{$elem->childNo}</td><td>{$elem->childName}</td><td>{$elem->treatDate}</td><td>{$elem->diagnosis}</td><td>{$elem->totAmt}</td><td>{$elem->careContr}</td><td>{$elem->nhif}</td><td>{$elem->amtReim}</td><td>{$elem->facName}</td><td>{$elem->facClass}</td><td>{$elem->type}</td><td>{$elem->date}</td><td>{$elem->vnum}</td><td id='rct-".$elem->rec."'>$rct<td>{$elem->refNo}</td><td>{$elem->claimCnt}</td><td id='rmk_td_".$elem->rec."'>".$rmk."".$del."</td></tr>";
       endforeach;
    
    echo "</tbody>";
echo "</table>";
echo $data[1];

