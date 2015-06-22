<?php
//print_r($data);
echo "<table id='info_tbl' style='margin-top:25px;width:60%;margin-left:auto;margin-right:auto;white-space:nowrap;'>";
echo "<tr><th>Key</th><th>KE No</th><th>Cheque No</th><th>Cheque Date</th><th>Amount</th><th>State</th><th>Time Stamp</th></tr>";
foreach ($data as $value) {
	echo "<tr>";
		foreach ($value as $val) {
			echo "<td>{$val}</td>";
		}
	echo "</tr>";	
}
echo "</table>";
?>