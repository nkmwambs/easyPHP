<?php
//print_r($data);
echo "<table id='tblShowBal'>";
echo "<caption><b>Settings</b></caption>";
    echo "<tr><th>Rec ID</th><th>KE No</th><th>Closing Balance</th><th>Close Date</th><th>Allow Edit</th><th>Time Stamp</th><th>View</th></tr>";
    foreach($data as $bal):
        echo "<tr>";
            foreach($bal as $val):
                echo "<td>".$val."</td>";
            endforeach;
        echo "<td>".img_tag("view.png")."</td></tr>";
    endforeach;
echo "</table>";
?>