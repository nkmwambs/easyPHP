<?php
echo Resources::a_href("Finance/civ","[CIV]");
echo "<br>";
echo "<hr>";
echo "<br>";

//print_r($data['icpAc']);

echo "<table id='info_tbl'  style='margin-top:20px;'>";
echo "<caption>".$data['cap']."</caption>";
echo "<tr><th>KE No.</th><th>Amount Disbursed</th><th>Amount Spent To Date</th><th>Balance To Date</th></tr>";
foreach ($data['icpAc'] as $value) {
	$k=0;
	$style="";
	if(!in_array($value->KENumber, $data['icps'])&&Resources::session()->userlevel==='2'){
		$style="style='display:none;'";
	}
	
	echo "<tr {$style}>";
	echo "<td onclick='showcivimpbreakdown(this,\"".$value->civaID."\",\"".$value->AccText."\");' style='color:blue;cursor:pointer;'>".$value->KENumber."</td>";
	echo "<td>".$value->AmountDisbursed."</td>";
	echo "<td>".$value->AmountSpent."</td>";
	echo "<td>".$value->BalanceToDate."</td>";
	echo "</tr>";
}
echo "</table>";
?>
