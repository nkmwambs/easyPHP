<?php
if(isset($data['rptMonth'])){
	$curSelect=date('F-Y',strtotime($data['rptMonth']));
	$cur = strtotime($data['rptMonth']);
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}
//print_r($data['rec']);
echo "<div id='pdsRptWelcome'>";
echo "<button onclick='selectpdsreport(\"".strtotime('-1 month',$cur)."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectpdsreport(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectpdsreport(\"".strtotime('+1 month',$cur)."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";
echo "<br><table id='tblFinanceView'>";
	echo "<caption style='font-weight:bold'>PD's Reports Switchboard for ".date('F Y',strtotime($data['rptMonth']))."</caption>";
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
			
		     echo "<div class='icpDivs' onclick='viewpdsreporters(this);' {$borderColor} {$title}>".$val['icpNo']."</div>";
		endforeach;
		echo "</td></tr>";
	endforeach;
	echo "</table>";
echo "</div>";
?>