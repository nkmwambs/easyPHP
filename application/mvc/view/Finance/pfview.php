<?php
//print_r($data['rec']);
echo "<table id='info_tbl' style='margin-top:15px;'>";
echo "<caption>".$data['cst']." Submitted MFRs</caption>";
echo "<tr><th>ICP ID</th><th>Month</th></tr>";
foreach ($data['rec'] as $key => $value) {
	echo "<tr><td>".$key."</td><td>";
	
	foreach ($value as $val) {
		echo "<div class='icpDivs' onclick='previewMfr(\"".$key."\",\"".strtotime($val['month'])."\");'>".date('M-Y',strtotime($val['month']))."</div>";
	}
	
	echo "</td></tr>";
}
echo "</table>";
?>