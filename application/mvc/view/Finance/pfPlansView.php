<?php
if(isset($data['error'])){
	echo $data['error'];
	exit;
}

echo "<div id='scheduleview'>";

echo "<table id='tblListOfAllItems' style='width:50%;'>";
echo "<caption>Total Budget Summary</caption>";
//echo "<tr><th>Project</th><th>Views</th><th>Total Budget</th></tr>";
echo "<tr><th>Project</th><th>Views</th><th>Total Budget</th></tr>";
foreach($data[1] as $icpNewItem):
   
	//echo "<tr><td>".$icpNewItem->icpNo."</td><td><button onclick='viewPlanSummaryByPf(\"$icpNewItem->icpNo\");'>Summary</button>".Resources::a_href("Finance/pfSchedules/icpNo/$icpNewItem->icpNo/fy/$data[0]","<button>Schedules</button>")."</td><td>&nbsp;</td></tr>";	
	echo "<tr><td>".$icpNewItem->icpNo."</td><td><button>Summary</button>".Resources::a_href("Finance/pfSchedules/icpNo/$icpNewItem->icpNo/fy/$data[0]","<button>Schedules</button>")."</td><td>".number_format($icpNewItem->Cost,2)."</td></tr>";
	//echo "<tr><td>".$icpNewItem->icpNo."</td><td><button>Summary</button><button onclick='pfSchedules(\"".$icpNewItem->icpNo."\",\"".$data[0]."\")'>Schedules</button></td><td>".number_format($icpNewItem->Cost,2)."</td></tr>";
	endforeach;
echo "</table>"; 
  
echo "</div>";
?>