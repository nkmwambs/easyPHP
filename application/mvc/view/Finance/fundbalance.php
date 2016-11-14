<?php
echo Resources::a_href("Finance/fundbalance","[Fund Balance Report]");
echo Resources::a_href("Finance/expenses","[Expenses Report]");
echo Resources::a_href("Finance/fundratio","[Funds Ratio Report]");
echo Resources::a_href("Finance/mfrvalidationreport","[MFR Validation Report]");
echo Resources::a_href("Reports/extraReports","[Query Builder]");

echo "<br><hr><br><br>"; 

echo "<b>Choose Date (<i>Select the last date of the month</i>)</b>:<INPUT TYPE='text' id='closureDate' name='closureDate' readonly/>".Resources::img('go.png',array("onclick"=>'fundbalance()'));

echo "<br><button  id='' onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption style='text-align:left;'><b>Fund Balance Report for the period ending ".date("jS F Y",strtotime($data['period']))."</b></caption>";
echo "<tr><th>Cluster</th><th>KE Number</th>";
foreach ($data['accounts'] as $value) {
	echo "<th>R{$value}</th>";
}
echo "<th>Total Balance</th>";
echo "</tr>";

foreach ($data['rst'] as $key => $value) {
	echo "<tr>";	
	echo "<td>".$data['icps'][$key]."</td>";
	echo "<td>{$key}</td>";
	foreach ($value as $key => $val) {
		echo "<td style='text-align:right;'>".number_format($val,2)."</td>";
	}
	echo "<td style='text-align:right;'>".number_format(array_sum($value),2)."</td>";
	echo "</tr>";
}

echo "</table>";

echo "</div>";
?>