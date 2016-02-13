<?php
//print_r($data['icpAc']);

echo "<table id='info_tbl'  style='margin-top:20px;'>";
echo "<caption>".$data['cap']."</caption>";
echo "<tr><th>KE No.</th><th>Amount Disbursed</th><th>Amount Spent To Date</th><th>Balance To Date</th></tr>";
foreach ($data['icpAc'] as $value) {
	echo "<tr>";
	echo "<td>".$value->KENumber."</td>";
	echo "<td>".$value->AmountDisbursed."</td>";
	echo "<td>".$value->AmountSpent."</td>";
	echo "<td>".$value->BalanceToDate."</td>";
	echo "</tr>";
}
echo "</table>";
?>
