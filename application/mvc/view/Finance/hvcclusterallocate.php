<?php
echo Resources::a_href("Finance/hvc","[HVC CDI Balances]")." ".Resources::a_href("Finance/hvccdiallocate","[HVC CDI Disbursement]")." ".Resources::a_href("","[HVC CPR Requests]");

echo "<hr><br>";

echo Resources::a_href("Finance/hvccountryallocate","[Mass Processing]");
echo Resources::a_href("Finance/hvcclusterallocate","[Process Per Cluster]");
echo Resources::a_href("Finance/hvcicpallocate","[Process Per Beneficiary]");
echo Resources::a_href("Finance/viewhvcallocation","[View]");

echo "<hr><br>";

//echo "<b>Choose a cluster to Process</b><SELECT>";

?>