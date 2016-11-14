<?php
echo Resources::a_href("Finance/fundbalance","[Fund Balance Report]");
echo Resources::a_href("Finance/expenses","[Expenses Report]");
echo Resources::a_href("Finance/fundratio","[Funds Ratio Report]");
echo Resources::a_href("Finance/mfrvalidationreport","[MFR Validation Report]");

echo "<br><hr><br><br>"; 

echo "<b>Date From:</b><INPUT TYPE='text' id='fromDate' value='".$data['lower']."' readonly/>";
echo "<b>Date To:</b><INPUT TYPE='text' id='toDate' value='".$data['upper']."' readonly/>";
echo Resources::img('go.png',array("onclick"=>'expenses()'));

echo "<br><button  id='' onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption style='text-align:left;'><b>Expense Report for the period between ".date("jS F Y",strtotime($data['lower']))." to ".date("jS F Y",strtotime($data['upper']))."</b></caption>";
echo "<tr><th>Cluster</th><th>KE Number</th>";
foreach ($data['accounts'] as $value) {
	if(strlen($value)>3){
		echo "<th>E".substr($value,1)."</th>";
	}else{
		echo "<th>E".$value."</th>";
	}	
	
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