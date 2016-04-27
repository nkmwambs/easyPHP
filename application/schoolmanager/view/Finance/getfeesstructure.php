<?php
//print_r($data['structure']);

echo "<br>";

//print_r($data['test']);


echo "<table>";
echo "<caption><b>".$data['grade']." Fees Structure<br>For Academic Year ".$data['acYr']."</b></caption>";

echo "<tr><th rowspan='2'>Details</th><th colspan='4'>Fees</th></tr>";

echo "<tr><th>Term One</th><th>Term Two</th><th>Term Three</th><th>Total</th></tr>";
$sum_t1=0;
$sum_t2=0;
$sum_t3=0;
$g_sum=0;
foreach ($data['structure'] as $key=>$value) {	
	
	echo "<tr><td>".$key."</td>";
		$term1=0;
		$term2=0;
		$term3=0;
		if(isset($value[1])){$term1=$value[1];}
		if(isset($value[2])){$term2=$value[2];}
		if(isset($value[3])){$term3=$value[3];}
		$sum = $term1+$term2+$term3;
		
		$sum_t1+=$term1;
		$sum_t2+=$term2;
		$sum_t3+=$term3;
		$g_sum+=$sum;
			
	echo "<td>".number_format($term1,2)."</td><td>".number_format($term2,2)."</td><td>".number_format($term3,2)."</td><th>".number_format($sum,2)."</th></tr>";	
}
echo "<tr><th>Grand Totals</th><th>".number_format($sum_t1,2)."</th><th>".number_format($sum_t2,2)."</th><th>".number_format($sum_t3,2)."</th><th>".number_format($g_sum,2)."</th></tr>";
echo "</table>";

?>