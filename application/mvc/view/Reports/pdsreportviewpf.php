<?php
	echo Resources::a_href("Reports/createpdsreportforicp","[Create Report for ICP]");
	echo "<hr><br><br>";
	?>
	<b>Key</b><br>
	<ul>
		<li><b>No Border</b> Means Report not submitted by ICP</li>
		<li><b>Red Border</b> Means Report Declined By the PF</li>
		<li><b>Orange Border</b> Means Report Submitted By ICP</li>
		<li><b>Green border</b> Means Report Checked By PF</li>
	</ul>
	<br><br><button onclick='excelexport()'  id=''>Export</button><br>

	<div id='rst'>
	
	<?php
	echo "<table id='tblFinanceView'>";
	echo "<caption style='font-weight:bold'>PD's Reports Switchboard</caption>";
	foreach($data['rec'] as $key=>$value):
		echo "<tr><td>".$key." (".count($value).")</td><td>";
		foreach($value as $val):
		$borderColor="";
		$title="";
		if($val['status']==='1'){
			$borderColor="style='border:4px orange solid;'";
			$title="title='Submitted'";
		}elseif($val['status']==='2'){
			$borderColor="style='border:4px red solid;'";
			$title="title='Declined'";
		}elseif($val['status']==='3'){
			$borderColor="style='border:4px green solid;'";
			$title="title='Validated'";
		}elseif($val['status']==='3'){
			$borderColor="style='border:4px yellow solid;'";
			$title="title='New'";
		}
		       echo Resources::a_href("Reports/pds/dt/".strtotime($val['month'])."/icpNo/".$key, "<div {$borderColor} {$title} class='icpDivs'>".date('M Y',strtotime($val['month']))."</div>");
		endforeach;
		echo "</td></tr>";
	endforeach;
	echo "</table>";
?>
</div>