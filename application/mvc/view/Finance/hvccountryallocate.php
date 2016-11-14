<?php
echo Resources::a_href("Finance/hvc","[HVC CDI Balances]")." ".Resources::a_href("Finance/viewhvcallocation","[HVC CDI Disbursement]")." ".Resources::a_href("","[HVC CPR Requests]");

echo "<hr><br>";

echo Resources::a_href("Finance/hvccountryallocate","[Mass Processing]");
//echo Resources::a_href("Finance/hvcclusterallocate","[Process Per Cluster]");
echo Resources::a_href("Finance/hvccdiallocate","[Process Per Beneficiary]");
echo Resources::a_href("Finance/viewhvcallocation","[View]");

echo "<hr><br>";

echo "<b>Allocation Period</b><INPUT TYPE='text' id='frmDate' readonly/>";
echo "<b>Amount Per Child</b><INPUT TYPE='text' id='amount'/>";
echo Resources::img("go.png",array("title"=>"Allocate","cursor"=>"pointer","onclick"=>'hvccountry()'));

?>