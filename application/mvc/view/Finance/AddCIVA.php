<?php 
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("Finance/civ","[View Uploaded Funds]")." ".Resources::a_href("Finance/civ","[CIV]");
echo "<br>";
echo "<hr>";
echo "<br>";

echo "<table id='tbladdCivAc' style='width:50%;'>";
echo "<form id='frmaddCivAc'>";
echo "<caption><b>Add CIV Account</b></caption>";

echo "<tr><th>CIV Description</th><td>";
	echo "<SELECT onchange='getCivAllocatedIcps(this);' id='AccTextCIVA' name='AccTextCIVA' class='starred'>";
	echo "<OPTION VALUE=''>Select CIV Description ... </OPTION>";
	foreach ($data['disbursedAc'] as $value) {
		echo "<OPTION VALUE='".$value."'>{$value}</OPTION>";
	}
	echo "</SELECT>";
	
echo "</td></tr>";

echo "<tr><th>Category</th><td><select id='accID' name='accID'  class='starred'>";
	echo "<OPTION VALUE=''>Select Account Group ... </OPTION>";
	foreach ($data['civaAc'] as $value) {
		echo "<OPTION VALUE='".$value->accID."'>{$value->AccText} - {$value->AccName}</OPTION>";
	}

echo "</select></td></tr>";


echo "<tr><th>Allocation</th><td><input type='text' name='allocate' id='allocate'  class='starred'/></td></tr>";
echo "<tr><th>CIV Code</th><td><input type='text' name='AccNoCIVA' id='AccNoCIVA'  class='starred'/></td></tr>";
echo "<tr><th>Closure Date</th><td><input type='text' name='closureDate' id='closureDate'  class='starred'/></td></tr>";
echo "</form>";
echo "<tr><td align='center' colspan='2'><button onclick='createCivAccount(\"frmaddCivAc\");'>Add</button></td></tr>";
echo "</table>";

?>