<?php
//print_r($data['test']);

echo "<table>";
echo "<caption>".$data['cst']." Cluster Beneficiary Assessment Status</caption>";
echo "<tr><th rowspan='2'>KE No</th><th colspan='3'>Count Of:</th><th rowspan='2'>% Completed Assessment</th></tr>";
echo "<tr><th>Completed Assessments</th><th>Incomplete Assessments</th><th>Expected Assessments (Minimum)</th></tr>";

$x=0;
$y=0;
foreach ($data['rec'] as $key=>$value) {
	echo "<tr><td>".Resources::a_href("Reports/viewcdprgrid/pNo/".$key, $key)."</td><td>".$value['comp_cnt']."</td><td>".$value['incomp_cnt']."</td><td>".$value['NoOfBen']."</td><td>".number_format($value['percent'],1)."</td></tr>";
	$x+=$value['comp_cnt'];
	$y+=$value['NoOfBen'];
}
$per = $x/$y*100;
echo "<tr><th>Total Submitted:</th><td colspan='2' style='text-align:left;'>".$x."</td><td colspan='2' style='text-align:left;'>".number_format($per,2)."%</td></tr>";
echo "</table>";
?>