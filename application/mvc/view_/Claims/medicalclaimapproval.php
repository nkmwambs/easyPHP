<?php

echo Resources::a_href("Claims/newMedicalRequest","[Back]");
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Claims/medicalclaimrequest","[New Medical Request Form]");
}
echo "<br><hr><br>";



echo "<table id='info_tbl' style='margin-top:20px;'>";
echo "<caption>Medical Requests</caption>";

echo "<tr><th>Request ID</th><th>Request Date</th><th>Cluster</th><th>KE Number</th><th>Beneficiary Number</th><th>Beneficiary Name</th><th>Diagnosis</th><th>Facility Name</th><th>Expected Treatment Date</th><th>Estimated Cost</th><th>Details of the Request</th><th>Request Status</th><th>Action</th><th>Approved By</th><th>Time Stamp</th></tr>";

$rmk="";
$status = "";

foreach ($data['req'] as $value) {
	//Remark Icon
	if(Resources::session()->userlevel==='2'||Resources::session()->userlevel==='5'){
		if($value->reqStatus==='0'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvemedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .= " ".Resources::img("reject.png",array("Title"=>"Decline","onclick"=>"rejectmedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$status = "<span style='color:orange;'>New Request</span>";
		}elseif($value->reqStatus==='1'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvemedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" <span onclick='addmedicalreqcomment()' style='cursor:pointer;'> [Add Comments] </span>";
			$status = "<span style='color:red;'>Declined Request</span>";
		}elseif($value->reqStatus==='2'){
			$rmk .= Resources::img("view.png",array("Title"=>"Approved"));
			$status = "<span style='color:green;'>Approved Request</span>";		
		}elseif($value->reqStatus==='3'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvemedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .= " ".Resources::img("reject.png",array("Title"=>"Decline","onclick"=>"rejectmedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" <span onclick='addmedicalreqcomment()' style='cursor:pointer;'> [Add Comments] </span>";
			$status = "<span style='color:purple;'>Edited Request</span>";		
		}elseif($value->reqStatus==='4'){
			$rmk .= Resources::img("lock.png",array("Title"=>"Closed Request"));
			$status = "<span style='color:blue;'>Closed Request</span>";		
		}
	}elseif(Resources::session()->userlevel==='1'){
		if($value->reqStatus==='0'){
			$rmk =" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"editmedicalrequest(\"".$value->reqID."\")"))." ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"delmedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$status = "<span style='color:orange;'>New Request</span>";
		}elseif($value->reqStatus==='1'){
			$rmk .= " ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"delmedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"editmedicalrequest(\"".$value->reqID."\")"));
			$rmk .=" <span onclick='readmedicalreqcomments()' style='cursor:pointer;'> [Read Comments] </span>";
			$status = "<span style='color:red;'>Declined Request</span>";
		}elseif($value->reqStatus==='2'){
			$rmk .= Resources::img("lock.png",array("Title"=>"Close Request","onclick"=>"closemedicalrequest(\"".$value->reqID."\")"));
			$status = "<span style='color:green;'>Approved Request</span>";		
		}elseif($value->reqStatus==='3'){
			$rmk .= " ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"delmedicalrequest(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"editmedicalrequest(\"".$value->reqID."\")"));
			$rmk .=" <span onclick='readmedicalreqcomments()' style='cursor:pointer;'> [Read Comments] </span>";			
			$status = "<span style='color:purple;'>Edited Request</span>";		
		}elseif($value->reqStatus==='4'){
			$rmk = Resources::img("view.png",array("Title"=>"Closed Request"));
			$status = "<span style='color:blue;'>Closed Request</span>";		
		}
	}	
	echo "<tr><td>KEICP/Req/".$value->reqID."</td><td>".$value->reqDate."</td><td>".$value->cluster."</td><td>".$value->icpNo."</td><td>".$value->childNo."</td><td>".$value->childName."</td><td>".$value->diag."</td><td>".$value->facName."</td><td>".$value->treatDate."</td><td>".$value->cost."</td><td>".$value->details."</td><td>".$status."</td><td>".$rmk."</td><td>".$value->reqApprovedBy."</td><td>".$value->stmp."</td></tr>";
}

echo "</table>";
?>