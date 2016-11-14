<?php
echo "<div id='rptsDiv'>";
if(is_array($data)){
	//print_r($data[1]);
	echo "<fieldset style='width:270px;float:left;'>";
	echo "<legend>Show</legend>";
	echo "<SELECT id='showQtr' style='float:left;' onchange='getMthsforQtr();'>";
			echo "<OPTION value=''>Select Quarter ...</OPTION>";
		foreach ($data[1] as $option) {
			echo "<OPTION value='".$option."'>".$option."</OPTION>";
		}
	echo "</SELECT>";
	echo "<SELECT id='showMnth' name='showMnth' style='float:left;'><OPTION value='0'>Select Month ...</OPTION>";
	echo "</SELECT>";
	echo Resources::img("go.png",array('title'=>'Show Grid','onclick'=>'selectCspRpts();','style'=>'cursor:pointer;float:left;'));
	echo "</fieldset>";
	
	echo "<fieldset style='width:270px;float:left;'>";
	echo "<legend>Download</legend>";
	echo "<a href='".HOST_NAME."/easyPHP/application/mvc/docs/exceldownloads/cspdownload.php?qtr=FY2016Q2'>".Resources::img("excel.png")."</a>";
	echo "</fieldset>";
	
	$header=array_keys((array)$data[0][0]);
	echo "<table id='info_tbl' style='min-width:100%;margin-top:20px;'>";
	echo "<tr><th>Action</th>";
	foreach($header as $val){
		echo "<th>".$val."</th>";
	}
	echo "</tr>";
	foreach($data[0] as $value){
		echo "<tr><td>".Resources::img('edit.png',array('title'=>'Edit Record','style'=>'cursor:pointer','onclick'=>'editCspFromGrid(this);'))."  ".Resources::img('uncheck3.png',array('title'=>'Delete Record','style'=>'cursor:pointer'))."</td>";
			foreach ($value as $val) {
				echo "<td>".$val."</td>";
			}
		echo "</tr>";
	}
	echo "</table>";
}else{
	print($data);
}
echo "</div>";
?>