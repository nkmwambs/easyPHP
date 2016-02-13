<?php
//Revenue Table

echo "<table id='info_tbl' style='margin-top:20px;'>";
echo "<caption>{$data['cap']} Revenue Breakdown<caption>";
echo "<tr><th>Month</th><th>Amount</th></tr>";
foreach ($data['imp']['rev'] as $value) {
	echo "<tr>";
		echo "<td>".date('F-Y',strtotime($value->Month))."</td>";
		echo "<td>{$value->Amount}</td>";
	echo "</tr>";
}
echo "</table>";

//Expense Table

echo "<table id='info_tbl' style='margin-top:20px;'>";
echo "<caption>{$data['cap']} Expense Breakdown Per Voucher<caption>";
echo "<tr><th>Voucher No</th><th>Amount</th></tr>";
foreach ($data['imp']['exp'] as $value) {
	echo "<tr>";
		echo "<td>".Resources::a_href("Finance/showVoucherFromExternalSource/vnum/".$value->VNumber."/icp/".$data['icp'],$value->VNumber)."</td>";
		echo "<td>{$value->totExp}</td>";
	echo "</tr>";
}
echo "</table>";


?>