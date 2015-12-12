<?php
//print_r($data['rec']);
if(empty($data['rec'])){
	exit;
}
echo "<table id='info_tbl' style='margin-top:15px;'>";
echo "<caption>".$data['icp']." Submitted MFRs</caption>";
echo "<tr><th>Month</th><th>Submision Date</th></tr>";
foreach ($data['rec'][$data['icp']] as $value) {
	echo "<tr><td>".date('F-Y',strtotime($value['month']))."</td><td>".date('d-m-Y',strtotime($value['stmp']))."</td></tr>";
}
echo "</table>";
?>