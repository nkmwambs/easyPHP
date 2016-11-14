<?php

echo Resources::a_href("Finance/fundbalance","[Fund Balance Report]");
echo Resources::a_href("Finance/expenses","[Expenses Report]");
echo Resources::a_href("Finance/fundratio","[Funds Ratio Report]");
echo Resources::a_href("Finance/mfrvalidationreport","[MFR Validation Report]");
echo Resources::a_href("Reports/extraReports","[Query Builder]");

echo "<br><hr><br><br>"; 

if(Resources::session()->userlevel==='9'){
	//print_r($data['cst_icp_cnt']);
}
$cnt_recnt = 0;
$lastendmonthdate=date('Y-m-t',strtotime('last day of last month',strtotime("+12 hours")));
//$lastendmonthdate=date('Y-m-t');
foreach ($data['fused'] as $key => $value) {
	foreach ($value as $ky => $val) {
		if($val===$lastendmonthdate||$val>$lastendmonthdate){ 
			++$cnt_recnt;
		}
	}
}
$country_per_recent = number_format(($cnt_recnt/array_sum($data['cst_icp_cnt']))*100);
echo "<b>Current (".date('M-Y',strtotime($lastendmonthdate)).") MFR Statistics:</b><br>";
echo "<i>Count:</i> ".$cnt_recnt." (".$country_per_recent."%)";

echo "<br><button  id='' onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table id='info_tbl' style='margin-top:15px;min-width:100%;'>";
echo "<caption>Country Submitted MFRs</caption>";
echo "<tr><th>Cluster</th><th>ICP ID</th></tr>";
//$x=0;
foreach ($data['fused'] as $key => $value) {
	$cnt_recnt_for_cst=0;
	$tot_for_cst=$data['cst_icp_cnt'][$key];
	foreach ($value as $v) {
		if($v===$lastendmonthdate||$val>$lastendmonthdate){
			++$cnt_recnt_for_cst;
		}
	}
	$per_recent = number_format(($cnt_recnt_for_cst/$tot_for_cst)*100);
	echo "<tr><td>".$key." (".$cnt_recnt_for_cst."/".$tot_for_cst.") ".$per_recent."%</td><td>";
	foreach ($value as $ky=>$val) {
		$recentreportdate = $val;
		$style = 'border:2px pink solid;';
		if(strtotime($lastendmonthdate)===strtotime($recentreportdate)||strtotime($lastendmonthdate)<strtotime($recentreportdate)){
			$style = 'border:3px green solid;';
		}
		//echo "<div class='icpDivs' style='".$style."'  onclick='previewMfr(\"".$val['icp']."\",\"".strtotime($data['recent'][$val['icp']])."\");'>".$val['icp']." #:".date('M-Y',strtotime($data['recent'][$val['icp']]))."</div>";
		echo "<div class='icpDivs' style='".$style."'  onclick='previewMfr(\"".$ky."\",\"".strtotime($val)."\");'>".$ky." #:".date('M-y',strtotime($val))."</div>";
	}
	echo "</tr>";
}
echo "</table>";
echo "</div>";
?>