<?php
//echo "All Other Users!";
//print_r($data['rec']);
echo "<table>";
echo "<caption>Beneficiary Assessment Country Submission Status</caption>";
echo "<tr><th>Cluster</th><th>Count Of Submitted Assessments Forms</th><th>Count Of Draft Assessments Forms</th><th>Total Beneficiaries</th><th>% Assessed</th></tr>";
foreach ($data['rec'] as $key => $value) {
	echo "<tr><td style='color:blue;cursor:pointer;' onclick='getcdprlistbycst(\"".$key."\");'>".$key."</td><td>".$value['comp']."</td><td>".$value['incomp']."</td><td>".$value['NoOfBen']."</td><td>".number_format($value['percent'],1)."</td></tr>";
}
echo "</table>";
?>