<?php
//echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";

//print_r($data['rec']);

echo "<table>";
echo "<caption><span>Anthropometric measures update for ".$data['childNo']."</span><button onclick='newmalmetricsupdate(\"frmmalmetrics\");'>Add</button></caption>";
	echo "<tr><th>Reporting Date</th><th>Current weight (in Kg)</th><th>Current Height (in cms)</th><th>MUAC/BMI</th></tr>";
	echo "<form id='frmmalmetrics'>";
	foreach ($data['rec'] as $value) {
		echo "<tr><td>".$value->metricDate."</td><td>".$value->curWeight."</td><td>".$value->curHeight."</td><td>".$value->curMUAC."</td></tr>";
	}
	echo "<tr><input type='hidden' id='malID' name='malID' value='".$data['malID']."'/><td><input type='text' id='metricDate' name='metricDate' readonly='readonly'/></td><td><input type='text' id='curWeight' name='curWeight'/></td><td><input type='text' id='curHeight' name='curHeight'/></td><td><input type='text' id='curMUAC' name='curMUAC'/></td></tr>";
	echo "</form>";
echo "</table>";
?>