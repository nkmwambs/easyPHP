<?php
//print_r($data);
echo "<table id='info_tbl' style='margin-top:25px;min-width:500px;margin-left:auto;margin-right:auto;white-space:nowrap;'>";
echo "<caption>Open Budgets</caption>";
echo "<tr><th>S/No</th><th>Key</th><th>Financial Year</th><th>KE No</th><th>Time Stamp</th><th>Action</th></tr>";
$cnt=1;
foreach ($data as $value) {
	echo "<tr><td>$cnt</td>";
		foreach ($value as $val) {
			echo "<td>{$val}</td>";
		}
	echo "<td>".Resources::img("open.png",array('onclick'=>'viewSchedulesUploads(this);'))."</td></tr>";
	$cnt++;	
}
echo "</table>";
