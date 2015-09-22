<?php
if(isset($data['error'])){
	echo $data['error'];
	exit;
}
print_r($data[1]);
echo "<table id='tblListOfAllItems' style='width:50%;'>";
echo "<caption>Total Budget Summary</caption>";
echo "<tr><th>Project</th><th>Views</th><th>Total Budget</th><th>Total Beneficiaries</th><th>Dollar Rate</th><th>Exchange Rate</th><th># Of Months</th><th>FY CDSP Projection Budget</th><th>Prev. FY Balance</th><th>CSP Grant</th><th>Total Expected Budget</th></tr>";
foreach($data[1] as $icpNewItem):
    echo "<tr><td>".$icpNewItem->icpNo."</td><td><button onclick='viewPlanSummaryByPf(\"$icpNewItem->icpNo\");'>Summary</button>".Resources::a_href("Finance/pfSchedules/icpNo/$icpNewItem->icpNo/fy/$data[0]","<button>Schedules</button>")."</td><td>".number_format($icpNewItem->Cost,2)."</td><td>".$icpNewItem->noOfBen."</td><td>".$icpNewItem->dollar_rate."</td><td>".$icpNewItem->exchange_rate."</td><td>".$icpNewItem->noOfMonths."</td><td>".number_format($icpNewItem->totalCDSP,2)."</td><td>".number_format($icpNewItem->supportBal,2)."</td><td>&nbsp;</td><td>".number_format($icpNewItem->aggTotal,2)."</td></tr>";
endforeach;
echo "</table>";
?>