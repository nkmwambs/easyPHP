<?php
//print_r($data);
echo "<table id='ppbfPfView'>";
echo "<caption><b>Partner Planning and Budgeting Approval and Views</b></caption>";
echo "<tr><th>ID</th><th>Plan Type</th><th>Financial Year</th><th>ICP No</th><th>Approval</th><th>Date Plan Created</th><th>View</th></tr>";
foreach ($data as $plan):
    echo "<tr>";
        foreach($plan as $key=>$value):
            echo "<td>".$value."</td>";
        endforeach;
            echo "<td>".img_tag("view.png",array("onclick"=>'viewPpbfOther(this);'))."</td>";
    echo "</tr>";
endforeach;
echo "</table>";
?>