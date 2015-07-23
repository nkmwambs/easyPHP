<?php
if(is_array($data)){
	$header=array_keys((array)$data[0]);
	echo "<table id='info_tbl' style='min-width:100%;'>";
	echo "<caption>Results Grid</caption>";
	echo "<tr>";
	foreach($header as $val){
		echo "<th>".$val."</th>";
	}
	echo "</tr>";
	foreach($data as $value){
		echo "<tr>";
			foreach ($value as $val) {
				echo "<td>".$val."</td>";
			}
		echo "</tr>";
	}
	echo "</table>";
}else{
	print($data);
}
 
?>