<?php
echo Resources::a_href("Finance/fundbalance","[Fund Balance Report]");
echo Resources::a_href("Finance/expenses","[Expenses Report]");
echo Resources::a_href("Finance/fundratio","[Funds Ratio Report]");
echo Resources::a_href("Finance/mfrvalidationreport","[MFR Validation Report]");
echo Resources::a_href("Finance/fundstransferapproval","[Funds Transfer Approval]");
echo Resources::a_href("Reports/extraReports","[Query Builder]");

echo "<br><hr><br><br>"; 


echo "<table id='info_tbl' style='margin-top:15px;min-width:90%;margin-left:auto;margin-right:auto;'>";
echo "<caption>".$data['cst']." Submitted MFRs</caption>";
echo "<tr><th>ICP ID</th><th>Month</th></tr>";
foreach ($data['rec'] as $key => $value) {
	echo "<tr><td>".$key."</td><td>";
	
	foreach ($value as $val) {
		echo "<div class='icpDivs' onclick='previewMfr(\"".$key."\",\"".strtotime($val['month'])."\");' title='".date('Y-m-d',strtotime($val['month']))."'>".date('M-Y',strtotime($val['month']))."</div>";
	}
	
	echo Resources::img("diskdel.png",array("Title"=>"Delete last MFR","onclick"=>'declineMfr(this)'))."</td></tr>";
}
echo "</table>";

echo "<table id='tblListOfUnapprovedItems' style='width:50%;;margin-right:auto;margin-left:auto;margin-top:30px;'>";
echo "<caption>Unapproved P.P.B.F Items Summary</caption>";
echo "<tr><th>Project</th><th>Cost of Unapproved Items</th></tr>";
foreach($data['recd'] as $icpNewItem):
    echo "<tr><td>".Resources::a_href("Finance/pfSchedules/icpNo/$icpNewItem->icpNo/fy/{$data['fy']}/",$icpNewItem->icpNo)."</td><td>".number_format($icpNewItem->Cost,2)."</td></tr>";
endforeach;
echo "</table>";

?>