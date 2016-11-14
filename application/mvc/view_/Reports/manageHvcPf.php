<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}
echo Resources::a_href("Reports/hvcIndexing","<button>Back</button>")."<br><br>";

echo "<fieldset>";
echo "<legend style='font-weight:bold;'>Download</legend>";
echo "<span style='font-weight:bold;'>Download (All ".$data['cst']." Active): </span><a href='".HOST_NAME."/easyPHP/application/mvc/docs/exceldownloads/hvclist.php?cst=".$data['cst']."'>".Resources::img("excel.png")."</a>";
echo "</fieldset>";

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption>HVC Statics for ".$data['cst']."</caption>";
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