<?php
//print_r($data);
echo "<table id='tblListOfUnapprovedItems' style='width:50%;'>";
echo "<caption>Unapproved Items Summary</caption>";
echo "<tr><th>Project</th><th># Of Unapproved Items</th><th>Cost of Unapproved Items</th></tr>";
foreach($data[1] as $icpNewItem):
    echo "<tr><td>".a_tag("Finance/pfSchedules/icpNo/$icpNewItem->icpNo/fy/$data[0]/",$icpNewItem->icpNo)."</td><td>$icpNewItem->cnt</td><td>".number_format($icpNewItem->Cost,2)."</td></tr>";
endforeach;
echo "</table>";
?>