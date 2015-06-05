<?php
echo "<button id='btnFundsDel' style='display:none;'>Delete</button><button onclick='fundsCategories();'>View Per Category</button>";
echo img_tag("previous.png")." ".img_tag("next.png");
echo "<table id='tblViewUploads'>";
echo "<tr><th><input type='checkbox' id='del' onclick='delRec();'/></th><th>ID</th><th>KE No</th><th>Account Code</th><th>Funds Description</th><th>Amount</th><th>Month</th><th>Upload Time Stamp</th></tr>";
foreach ($data as $flds):
    echo "<tr><td><input type='checkbox' name='delRec[]' class='dels'/></td>";
    foreach ($flds as $val):
        echo "<td>".$val."</td>";
    endforeach;
    echo "</tr>";
endforeach;
echo "</table>";
?>