<?php
//print_r($data);
echo "<table id='info_tbl' style='margin-top:25px;text-align:center;'>";
echo "<tr><th>Cluster</th><th>ICP No</th><th>Last Log Time</th><th># Of Logs</th></tr>";
foreach($data['logs'] as $value):
	echo "<tr>";
		foreach($value as $val):
			echo "<td>".$val."</td>";
		endforeach;
	echo "</tr>";
endforeach;
echo "</table>";
?>