<?php

if(Resources::session()->userlevel==='2'){
	echo Resources::a_href("Finance/view","[Back]");
}else{
	echo Resources::a_href("Finance/voucher","[Back]");
	echo Resources::a_href("Finance/fundstransfer","[Funds Balance Transfer]");
}
echo "<br><hr><br>";

//print_r($data['req']);

echo "<table id='info_tbl' style='margin-top:10px;'>";
echo "<caption style='font-weight:bold;'>Funds Tranfer Requests</caption>";

echo "<tr><th>KE Number</th><th>Month to Transfer From</th><th>Account From</th><th>Account To</th><th>CIV ID</th><th>Amount</th><th>Description</th><th>Action</th><th>Status</th><th>Voucher Number</th><th>Time Stamp</th></tr>";

$rmk="";
$status = "";
foreach($data['req'] as $value){
	//Remark Icon
	if(Resources::session()->userlevel==='2'){
		if($value->accepted==='0'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvetransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .= " ".Resources::img("reject.png",array("Title"=>"Reject","onclick"=>"rejecttransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$status = "<span style='color:orange;'>New Request</span>";
		}elseif($value->accepted==='1'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvetransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" <span onclick='addfundstransferreqcomment()' style='cursor:pointer;'> [Add Comments] </span>";
			$status = "<span style='color:red;'>Rejected Request</span>";
		}elseif($value->accepted==='2'){
			$rmk .= Resources::img("view.png",array("Title"=>"Approved"));
			$status = "<span style='color:green;'>Approved Request</span>";		
		}elseif($value->accepted==='3'){
			$rmk .= Resources::img("approved.png",array("Title"=>"Approve","onclick"=>"approvetransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .= " ".Resources::img("reject.png",array("Title"=>"Reject","onclick"=>"rejecttransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" <span onclick='addfundstransferreqcomment()' style='cursor:pointer;'> [Add Comments] </span>";
			$status = "<span style='color:purple;'>Edited Request</span>";		
		}
	}elseif(Resources::session()->userlevel==='1'){
		if($value->accepted==='0'){
			$rmk .=" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"edittransferrequest(\"".$value->reqID."\")"));
			$rmk .= " ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"deltransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$status = "<span style='color:orange;'>New Request</span>";
		}elseif($value->accepted==='1'){
			$rmk .= " ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"deltransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"edittransferrequest(\"".$value->reqID."\")"));
			$rmk .=" <span onclick='readrejectioncomments()' style='cursor:pointer;'> [Read Comments] </span>";
			$status = "<span style='color:red;'>Rejected Request</span>";
		}elseif($value->accepted==='2'){
			$rmk .= Resources::img("view.png",array("Title"=>"Approved"));
			$status = "<span style='color:green;'>Approved Request</span>";		
		}elseif($value->accepted==='3'){
			$rmk .= " ".Resources::img("uncheck3.png",array("Title"=>"Delete Request","onclick"=>"deltransfer(\"".$value->reqID."\")","style"=>"cursor:pointer;"));
			$rmk .=" ".Resources::img("editplain.png",array("Title"=>"Edit Request","onclick"=>"edittransferrequest(\"".$value->reqID."\")"));
			$rmk .=" <span onclick='readrejectioncomments()' style='cursor:pointer;'> [Read Comments] </span>";			
			$status = "<span style='color:purple;'>Edited Request</span>";		
		}
	}	
	echo "<tr><td>".$value->icpNo."</td><td>".$value->monthfrom."</td><td>".$value->acfrom."</td><td>".$value->acto."</td><td>".$value->civaID."</td><td>".$value->amttotransfer."</td><td>".$value->description."</td><td>".$rmk."</td><td>".$status."</td><td>".Resources::a_href("Finance/showVoucherFromExternalSource/vnum/".$value->VNumber."/icp/".$value->icpNo,$value->VNumber)."</td><td>".$value->stmp."</td></tr>";
}


echo "</table>";
?>