<?php
//print_r($data['rpt']);
echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption style='font-weight:bold;'>Fund Balance Report for ".$data['curDate']."</caption>";
echo "<tr><th>Cluster</th><th>ICP</th>";
	foreach ($data['funds'] as $value) {
		echo "<th>R".$value->funds."</th>";
	}
echo "</tr>";
foreach ($data['rpt'] as $key => $value) {
	
		$span = count($data['funds']);
		foreach ($value as $ky => $val) {
			echo "<tr>";
			echo "<th style='text-align:left;'>".$key."</th>";
			echo "<th>{$ky}</th>";
			//echo "<td colspan='".$span."'>&nbsp;</td>";
			foreach ($data['funds'] as $v) {
				if(isset($val[$v])){
					echo "<td>".number_format($val[$v],2)."</td>";	
				}else{
					echo "<td>0.00</td>";
				}
				
			}
			echo "</tr>";
		}
		
		
		
	
}
echo "</table>";
//echo count($data['funds']);
?>