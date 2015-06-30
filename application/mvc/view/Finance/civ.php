<?php
//print_r($data);
if($_SESSION['userlevel']==="3"){
echo Resources::a_href("Finance/AddCIVA",Resources::img("diskadd.png",array("title"=>'Add Account')));
}
echo "<table id='tblCiva'>";
echo "<tr><th>&nbsp;</th><th>Group Description</th><th>Group Code</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>CIV ID</th><th>CIV Category Code</th><th>CIV Description</th><th>ICP(s) Allocates</th><th>Status</th><th>Closure Date</th><th>Amount Disbursed</th><th>Expense To Date</th><th>View</th></tr>";
foreach($data[0] as $value):
    echo "<tr>";
        foreach($value as $flds):
            echo "<td>".$flds."</td>";
        endforeach;
    echo "<td>".Resources::img("view.png",array("title"=>'View'))."</td></tr>";
endforeach;
echo "</table>";