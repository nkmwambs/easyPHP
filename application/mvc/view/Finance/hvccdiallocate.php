<?php
echo Resources::a_href("Finance/hvc","[HVC CDI Balances]")." ".Resources::a_href("Finance/viewhvcallocation","[HVC CDI Disbursement]")." ".Resources::a_href("","[HVC CPR Requests]");

echo "<hr><br>";

echo Resources::a_href("Finance/hvccountryallocate","[Mass Processing]");
//echo Resources::a_href("Finance/hvcclusterallocate","[Process Per Cluster]");
echo Resources::a_href("Finance/hvccdiallocate","[Process Per Beneficiary]");
echo Resources::a_href("Finance/viewhvcallocation","[View]");

echo "<hr><br>";

echo "<form id='hvcalloc'>";
echo "<table>";
echo "<tr><td><b>KE Number</b></td><td><SELECT name='pNo' id='pNo'/><OPTION VALUE=''>Select KE No ...</OPTION>";

foreach ($data['rst'] as $value) {
	echo "<OPTION VALUE='".$value->fname."'>".$value->fname."</OPTION>";
}

echo "</SELECT></td></tr>";
echo "<tr><td><b>Child Number</b></td><td><INPUT TYPE='text' name='childNo' id='childNo' class='req'/></td></tr>";
echo "<tr><td><b>Month</b></td><td><INPUT TYPE='text' name='frmDate' id='frmDate'  class='req' readonly/></td></tr>";
echo "<tr><td><b>Amount</b></td><td><INPUT TYPE='text' name='amount' id='amount'  class='req'/></td></tr>";
echo "<tr><td colspan='2'><button onclick='updatehvcallocate(\"hvcalloc\")'>Update</button></td></tr>";
echo "</table>";
echo "</form>";
?>