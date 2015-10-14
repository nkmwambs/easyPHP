<?php
if(empty($data['rec'])){
	echo "<span style='color:red;font-weight:bold;'>No Report Available for viewing</span>";
}else{
	//print_r($data['rec']);
echo "<table id='tblFinanceView'>";
echo "<caption style='font-weight:bold'>PD's Reports Switchboard</caption>";
echo "<tr><td>";
foreach($data['rec'] as $key=>$value):
       //echo "<div class='icpDivs' onclick='showReport(".strtotime($value->rptMonth).");'>".date('F Y',strtotime($value->rptMonth))."</div>";
       echo Resources::a_href("Reports/pds/dt/".strtotime($value->rptMonth), "<div class='icpDivs'>".date('F Y',strtotime($value->rptMonth))."</div>");
endforeach;
echo "</td></tr>";
echo "</table>";
}
?>