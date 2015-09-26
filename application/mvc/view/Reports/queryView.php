<?php
if(is_array($data['rst'])&&isset($data['rst'])){
	
	$header=array_keys((array)$data['rst'][0]);
	
	echo "<form method='POST' action='".HOST_NAME."/easyPHP/application/mvc/docs/exceldownloads/query.php'>";
	echo "<INPUT TYPE='hidden' id='sql' name='sql' value='".$data['sql']."'/>";
	echo "<TEXTAREA id='headstr' name='headstr' style='display:none;'>".implode(",", $header)."</TEXTAREA>";
	echo "<button>Excel Download</button><br><br>";
	echo "</form>";
	
	$header=array_keys((array)$data['rst'][0]);
	echo "<table id='info_tbl' style='min-width:100%;'>";
	echo "<caption>Results Grid</caption>";
	echo "<tr>";
	foreach($header as $val){
		echo "<th>".$val."</th>";
	}
	echo "</tr>";
	foreach($data['rst'] as $value){
		echo "<tr>";
			foreach ($value as $val) {
				echo "<td>".$val."</td>";
			}
		echo "</tr>";
	}
	echo "</table>";
}else{
	print($data['rst']);
}
 
?>