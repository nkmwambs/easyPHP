<?php
if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/registerMalCase","[New Case]");
	echo Resources::a_href("Reports/updateMalCase","[Update Case]");
	
	echo "<hr>";
	echo "<span style='font-weight:bold;color:green;'>Button Keys:</span> <span style='font-weight:bold;color:red;'>T:</span> TFI Support Request Date, <span style='font-weight:bold;color:red;'>P:</span> Progress, <span style='font-weight:bold;color:red;'>E:</span> Date Enrolled into other Therapeutic Feeding Program";
}




echo "<table style='white-space: nowrap;'>";
	echo "<tr><th>Action</th><th>Beneficiary Number</th><th>Child Name</th><th>Child Gender</th><th>Child Date Of Birth</th><th>Measure Date</th><th>Weight</th><th>Height</th><th>Status</th></tr>";
	foreach ($data['mal'] as $value) {
		echo "<tr><td>".Resources::img("unlock.png",array("title"=>"Open Case","style"=>"cursor:pointer;","onclick"=>"exitMalCase(\"".$value->childNo."\",\"".$value->malID."\")"))."</td><td style='color:blue;cursor:pointer;' onclick='malcaseview(\"".$value->malID."\");'>".$value->childNo."</td><td>".$value->childName."</td><td>".$value->sex."</td><td>".$value->childDOB."</td><td>".$value->regDate."</td><td>".$value->diagWeight."</td><td>".$value->diagHeight."</td>";
		if(Resources::session()->userlevel==='1'){
			echo "<td><button style='float:left;' onclick='tfiUpdate(\"".$value->childNo."\",\"".$value->malID."\");'>T</button><button onclick='malmetricsUpdate(\"".$value->childNo."\",\"".$value->malID."\");' style='float:left;'>P</button><button onclick='tfiEnrol(\"".$value->childNo."\",\"".$value->malID."\");' style='float:left;'>E</button></td>";	
		}else{
			echo "<td>".Resources::a_href("","Status Report")."</td>";
		}
		echo "</tr>";
	}
echo "</table>";
?>