<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

//print_r($data['rec']);
echo "<fieldset>";
echo "<legend style='font-weight:bold;'>Download</legend>";
echo "<span style='font-weight:bold;'>Download (All KE Active): </span><a href='".HOST_NAME."/easyPHP/application/mvc/docs/exceldownloads/hvclist.php'>".Resources::img("excel.png")."</a>";
echo "</fieldset>";

echo "<table id='info_tbl' style='margin-top:25px;margin-bottom:15px;'>";
echo "<caption>HVC Statics for KE</caption>";
echo "<tr><th>Cluster</th><th>No. Of ICPs</th><th>No. Indexed in the Cluster</th></tr>";

$caseCnt=0;
$totIcpCnt=0;
$cstCnt=0;
foreach ($data['rec'] as $key => $value) {
	$icpCnt=0;
	$icpCaseCnt=0;
	foreach ($value as $k => $v) {
		$icpCnt++;
		$icpCaseCnt+=$v[1];
	}
		echo "<tr><td onclick='toogleHvcViewSpecialist(\"".$key."\");' style='color:blue;cursor:pointer;text-decoration:underline;'>".$key."</td><td>".$icpCnt."</td><td>".$icpCaseCnt."</td></tr>";	
	$caseCnt+=	$icpCaseCnt;
	$totIcpCnt+=$icpCnt;
	$cstCnt++;
}
echo "<tr><td><span style='font-weight:bold;'>Total Clusters: </span> {$cstCnt}</td><td><span style='font-weight:bold;'>Total ICPs: </span>".$totIcpCnt."</td><td><span style='font-weight:bold;'>Total Beneficiaries: </span>".$caseCnt."</td></tr>";
echo "</table>";


?>