<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}


echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<tr><th>Action</th><th>Index Key</th><th>Cluster</th><th>ICP No</th><th>Program</th><th>Child Number</th><th>Child Name</th><th>Date Of Birth</th><th>Age</th><th>Gender</th><th>Vulnerability</th><th>No. Of Months</th><th>Type of Intervention required through HVC support</th><th></th><th>Other Non-HVC Interventions Required</th><th>Intervention suitable for the child</th><th>Future sustainability strategy</th><th>Active Case</th><th>Repeats</th></tr>";
foreach ($data['allCases'] as $value) {
	echo "<tr><td>";
	if($value->active==='1'){
		echo Resources::img("uncheck3.png",array("title"=>"Inactive Case","style"=>"cursor:pointer;","onclick"=>'inactivateCase("'.$value->indID.'");'));
	}else{
		echo Resources::img("uncheck.png");
	}
	echo "</td>";
		foreach ($value as  $val) {
			echo "<td>{$val}</td>";
		}
	echo "</tr>";
}
echo "</table>";

?>