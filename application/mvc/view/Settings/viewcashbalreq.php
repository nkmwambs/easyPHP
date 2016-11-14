<?php
//print_r($data['cashbal']);
echo "<table style='width:100%;'>";
echo "<caption>Cash Balances B/f View for ID # ".$data['cashbal'][0]->icpNo."</caption>";
echo "<tr><th>Month</th><th>Balance Type</th><th>Amount</th></tr>";
foreach ($data['cashbal'] as $value) {
	echo "<tr><td>".$value->month."</td><td>".$value->accNo."</td><td>".$value->amount."</td></tr>";
}
echo "</table>";
?>