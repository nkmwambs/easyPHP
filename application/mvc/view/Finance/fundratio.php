<?php
echo Resources::a_href("Finance/fundbalance","[Fund Balance Report]");
echo Resources::a_href("Finance/expenses","[Expenses Report]");
echo Resources::a_href("Finance/fundratio","[Funds Ratio Report]");
echo Resources::a_href("Finance/mfrvalidationreport","[MFR Validation Report]");

echo "<br><hr><br><br>"; 
//echo "Funds Ratio Report Under Construction";

//print_r( $data['support_received']);
//print_r( $data['support_balance']);
//print_r( $data['test']);

if(Resources::session()->admin==='1'){
	//print_r( $data['test']);
}

echo "<br><button  id='' onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table id='info_tbl'  style='margin-top:25px;'>";
echo "<caption><b>ICP Accounting Ratios for the Period ending ".date("jS F Y",strtotime($data['period']))."</b></caption>";
echo "<tr><th>Cluster</th><th>KE Number</th><th>Accum. Fund Ratio</th><th>Operating Ratio</th></tr>";
/*
foreach ($data['ratios'] as $key => $value) {
	echo "<tr>";
		echo "<td>".$data['icps'][$key]."</td><td>".$key."</td>"; 
		foreach ($value as $k=>$v) {
			echo "<td>".number_format($v,2)."</td>";
		}
	echo "</tr>";
}
 * 
 */
echo "</table>"; 

echo "</div>";
?>