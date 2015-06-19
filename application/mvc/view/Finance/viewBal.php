<?php
//print_r($data);
echo "<table id='info_tbl' class='designerTable' style='margin-top:25px;width:60%;margin-left:auto;margin-right:auto;white-space:nowrap;'>";
echo "<caption>Opening Balances View</caption>";
echo "<tr><td>Key</td><td>Date</td><td>Account</td><td>KE No.</td><td>Special Code</td><td>Amount</td></tr>";
foreach ($data as $value) {
	echo "<tr>";
		foreach ($value as $val) {
			echo "<td>{$val}</td>";
		}
	echo "</tr>";
}
echo "</table>";
?>