<button onclick='excelexport()'  id=''>Export</button><br>

<div id='rst'>
<?php
//print_r($data['rec']);

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption style='font-weight:bold;'>Chart Of Accounts: Revenue Accounts</caption>";
echo "<tr><th>Account Code</th><th>Account Name</th><th>CIV Account</th></tr>";
foreach ($data['rec'] as $value) {
	$civ = "-";
	if($value->Active==="0"){
		$civ = "Yes";
	}
	echo "<tr><td>".$value->AccText."</td><td>".$value->AccName."</td><td>".$civ."</td></tr>";
}
echo "</table>";


echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption style='font-weight:bold;'>Chart Of Accounts:Expenses Accounts</caption>";
echo "<tr><th>Account Code</th><th>Account Name</th><th>CIV Account</th></tr>";
foreach ($data['exp'] as $value) {
	$civ = "-";
	if($value->Active==="0"){
		$civ = "Yes";
	}
	echo "<tr><td>".$value->AccText."</td><td>".$value->AccName."</td><td>".$civ."</td></tr>";
}
echo "</table>";
?>
</div>