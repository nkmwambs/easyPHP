<?php
if(empty($data['rec'])){
	echo "<span style='color:red;font-weight:bold;'>No Report Available for viewing</span>";
}else{
	//print_r($data['rec']);
echo "<table id='tblFinanceView'>";
echo "<caption style='font-weight:bold'>PD's Reports Switchboard for ".$data['icp']."</caption>";
echo "<tr><td>";
foreach($data['rec'] as $key=>$value):
			
			$borderColor="";
			$title="";
			if($value->status==='1'){
				$borderColor="style='border:4px orange solid;'";
				$title="title='Submitted'";
			}elseif($value->status==='2'){
				$borderColor="style='border:4px red solid;'";
				$title="title='Declined'";
			}elseif($value->status==='3'){
				$borderColor="style='border:4px green solid;'";
				$title="title='Validated'";
			}elseif($value->status==='3'){
				$borderColor="style='border:4px yellow solid;'";
				$title="title='New'";
			}
       
       echo Resources::a_href("Reports/pds/dt/".strtotime($value->rptMonth)."/icp/".$data['icp'], "<div {$borderColor} {$title} class='icpDivs'>".date('F Y',strtotime($value->rptMonth))."</div>");
endforeach;
echo "</td></tr>";
echo "</table>";
}
?>