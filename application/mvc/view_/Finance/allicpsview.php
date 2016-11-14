<?php
//print_r($data['recent']);
echo "<table id='info_tbl' style='margin-top:15px;min-width:100%;'>";
echo "<caption>Country Submitted MFRs</caption>";
echo "<tr><th>Cluster</th><th>ICP ID</th></tr>";
foreach ($data['rec'] as $key => $value) {
	echo "<tr><td>".$key."</td><td>";
	
	foreach ($value as $val) {
		$recentreportdate = $data['recent'][$val['icp']];
		$lastendmonthdate=date('Y-m-t',strtotime('-1 month'));
		$style = 'border:2px pink solid;';
		if(strtotime($lastendmonthdate)===strtotime($recentreportdate)){
			$style = 'border:3px green solid;';
		}
		echo "<div class='icpDivs' style='".$style."'>".$val['icp']." #".$val['cnt'].":".$data['recent'][$val['icp']]."</div>";
	}
	
	echo "</tr>";
}
echo "</table>";
?>