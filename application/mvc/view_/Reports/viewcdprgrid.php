<?php

if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/cdpr","[New Assessment]")." ".Resources::a_href("Reports/viewcdprgrid","[View Assessments]");
	echo "<hr><br>";
}
//print_r($data['rec']);
echo "<table>";
echo "<caption>Assessed Beneficiaries Board (Count:".count($data['rec']).")</caption>";
foreach ($data['rec'] as $key => $value) {
	echo "<tr>";
	echo "<td>".$key."</td>";
	echo "<td>";
	foreach ($value as $ky=>$val) {
		if($val==='0'){	
			echo "<div class='icpDivs' style='border:solid red 5px;' onclick='getChildDetailsforCDPRFromBoard(\"".$key."\",\"".$ky."\");'>".$ky."</div>";
		}else{
			echo "<div class='icpDivs' style='border:solid green 5px;' onclick='getChildDetailsforCDPRFromBoard(\"".$key."\",\"".$ky."\");'>".$ky."</div>";	
		}
	}
	echo "</td>";
	echo "</tr>";
}
echo "</table>";
?>