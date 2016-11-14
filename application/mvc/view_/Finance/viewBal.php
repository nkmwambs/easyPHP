<?php
//print_r($data['mixed_arr']);
echo "<table id='info_tbl' class='designerTable' style='margin-top:25px;width:60%;margin-left:auto;margin-right:auto;white-space:nowrap;'>";
echo "<caption>Opening Balances View <div style='color:blue;cursor:pointer;' onclick='hideViewBal();'>Hide View</div></caption>";
echo "<tr><th>Date</th><th>Account</th><th>Amount</th></tr>";
foreach ($data['mixed_arr'] as $key=>$value) {
	echo "<tr><td colspan='4' style='text-align:center;background-color:blue;color:white;font-weight:bold;'>{$key}</td></tr>";
	$tot=0;
	foreach ($value as $val) {
			echo "<tr><td>{$val->closureDate}</td><td>{$val->funds}</td><td>{$val->amount}</td></tr>";
			$tot+=$val->amount;
	}
	echo "<tr><th colspan='2'>Total</th><th>{$tot}</th></tr>";
}
echo "</table>";
?>