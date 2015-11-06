<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption>HVC Statics Per ICP</caption>";
echo "<tr><th>No. Of ICPs</th><th>No. Indexed iby the ICP</th></tr>";

$caseCnt=0;
$totIcpCnt=0;
//$cstCnt=0;
foreach ($data['rec'] as $value) {
	echo "<tr><td onclick='toogleHvcViewPf(\"".$value->pNo."\");' style='color:blue;cursor:pointer;text-decoration:underline;'>".$value->pNo."</td><td>".$value->noOfCases."</td></tr>";	
	$caseCnt+=	$value->noOfCases;
	$totIcpCnt++;
}
echo "<tr><td><span style='font-weight:bold;'>Total ICPs: </span>".$totIcpCnt."</td><td><span style='font-weight:bold;'>Total Beneficiaries: </span>".$caseCnt."</td></tr>";
echo "</table>";

?>