<?php
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";

//print_r($data['rec']);
if(!empty($data['rec'])){
	echo "The beneficiary ".$data['childNo']." was already registered to another supplementary feeding program on ".$data['rec'][0]->othertfienroldate;
}else{
echo "<button onclick='newothertfienrol(\"frmothertfi\");'>Add</button><br><br><span style='font-weight:bold;'>Date enrolled into any therapeutic or supplementary  feeding program for ".$data['childNo']."<span><br><br>";
echo "<form id='frmothertfi'>";
echo "Date Enrolled: <input type='text' id='othertfienroldate' name='othertfienroldate' readonly='readonly'/><input type='hidden' id='malID' name='malID' value='".$data['malID']."'/>";
echo "</form>";
}
?>