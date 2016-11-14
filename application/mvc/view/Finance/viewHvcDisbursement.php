<?php
echo Resources::a_href("Finance/viewSlip","[Funds Disbursement]");
echo "<br><hr><br>";

//print_r($data['alloc']);

echo "<table id='info_tbl'>";
echo "<tr><caption><b>HVC Funds Disbursement</b></caption></tr>";
echo "<tr><th>Child No</th><th>Child Name</th><th>Amount</th></tr>";

$sum = 0;

foreach ($data['alloc'] as $value) {
	echo "<tr><td>".$value->childNo."</td><td>".$value->childName."</td><td>".$value->amount."</td></tr>";
	$sum +=$value->amount;
}
echo "<tr><th colspan='2'>Total</th><th>".number_format($sum,2)."</th></tr>";
echo "</table>";

?>