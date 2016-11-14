<?php
//print_r($data['rec']);
echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption>Disbursement breakdown for ".$data['fund']." for ".$data['month']."</caption>";
echo "<tr><th>Fund Description</th><th>KE Number</th><th>Amount</th></tr>";
foreach ($data['rec'] as $value) {
	echo "<tr><td>".$value->AccountDescription."</td><td>".$value->KENumber."</td><td>".$value->Amount."</td></tr>";
}
echo "</table>";
?>