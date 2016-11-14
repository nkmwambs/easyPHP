<?php
echo Resources::a_href("Finance/hvc","[HVC CDI Balances]")." ".Resources::a_href("Finance/hvccdiallocate","[HVC CDI Disbursement]")." ".Resources::a_href("","[HVC CPR Requests]");

echo "<hr><br>";

echo Resources::a_href("Finance/hvccountryallocate","[Mass Processing]");
//echo Resources::a_href("Finance/hvcclusterallocate","[Process Per Cluster]");
echo Resources::a_href("Finance/hvcicpallocate","[Process Per Beneficiary]");
echo Resources::a_href("Finance/viewhvcallocation","[View]");

echo "<hr><br>";

echo "<button style='float:left;display:none;'>Delete A Record</button><br>";
echo "<INPUT style='float:left;' TYPE='text' id='frmDate' placeholder='Select Date'/>".Resource::img("go.png");
echo "<br><br>";

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption><b>HVC CDI Allocation for the Month of ".$data['month']."</b></caption>";
echo "<tr><th><INPUT TYPE='checkbox'/></th><th>Cluster</th><th>KE Number</th><th>Child Number</th><th>Child Name</th><th>Amount</th>";
foreach ($data['rst'] as $value) {
	echo "<tr>";
	echo "<td><INPUT TYPE='checkbox'/></td>";
	
	foreach ($value as $val) {
		echo "<td>".$val."</td>";
	}
	
}
echo "</table>";
?>