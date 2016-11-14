<?php
//print_r($data);
echo "<table id='info_tbl' style='margin-top:25px;width:60%;margin-left:auto;margin-right:auto;white-space:nowrap;'>";
echo "<tr><th>Key</th><th>Date</th><th>KE No</th><th>Amount</th><th>Time Stamp</th></tr>";
foreach ($data as $value) {
	echo "<tr>";
		foreach ($value as $val) {
			echo "<td>{$val}</td>";
		}
	echo "</tr>";	
}
echo "</table>";
?>