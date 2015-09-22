<?php
//echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";

//print_r($data['rec']);

echo "<table>";
echo "<caption><span>MED TFI Support Update for ".$data['childNo']."</span><button onclick='newtfiUpdate(\"frmTfiUpdate\");'>Add</button></caption>";
	echo "<tr><th>Date Requested</th><th>Amount Received in Kes.</th><th>Duration of Support in Months</th></tr>";
	echo "<form id='frmTfiUpdate'>";
	foreach ($data['rec'] as $value) {
		echo "<tr><td>".$value->tfiDate."</td><td>".$value->tfiAmount."</td><td>".$value->tfiDuration."</td></tr>";
	}
	echo "<tr><input type='hidden' id='malID' name='malID' value='".$data['malID']."'/><td><input type='text' id='tfiDate' name='tfiDate' readonly='readonly'/></td><td><input type='text' id='tfiAmount' name='tfiAmount'/></td><td><input type='text' id='tfiDuration' name='tfiDuration'/></td></tr>";
	echo "</form>";
	echo "</table>";
?>