<?php
	//print($data['cond']);
	//print_r($data['arr']);
	//print($data['join']);
	echo "<table id='info_tbl' style='margin-top:25px;'>";
	foreach ($data['arr'] as $value) {
		echo "<tr>";
			foreach ($value as $val) {
				echo "<td style='border:1px black solid;'>$val</td>";
			}
		echo "</tr>";
	}
	echo "</table>";
?>