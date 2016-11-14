<?php
//print_r($data['os']);
echo "<table style='width:100%;'>";
echo "<caption>Uncleared Effects B/f View for ID # ".$data['os'][0]->icpNo."</caption>";
echo "<tr><th>Cheque Date</th><th>Cheque Number</th><th>Amount</th></tr>";
foreach ($data['os'] as $value) {
	echo "<tr><td>".$value->chqDate."</td><td>".$value->chqNo."</td><td>".$value->amount."</td></tr>";
}
echo "</table>";
?>