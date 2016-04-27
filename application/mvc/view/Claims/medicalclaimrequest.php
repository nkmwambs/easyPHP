<?php

echo Resources::a_href("Claims/newMedicalRequest","[Back]");

echo "<br><hr><br>";

//echo Resources::img('top_border.png',array("style"=>"max-width:100%;"));

//print_r($data['icp']);

$types = "";

foreach ($data['types'] as $value) {
	$types .="<OPTION VALUE='".$value->typeID."'>".$value->reqTitle."</OPTION>";
}
$style = "none";
if($data['csp']===1){
	$style="block";
}

echo "<table class='stylish_table' style='margin-top:-18px;'>";

echo "<caption style='font-weight<br>bold;'>Medical Request Form (Private and Mission Hospitals)</caption>";
echo "<form id='frmmedicalrequest'>";

echo "<tr><td>Request Date<br> <INPUT TYPE='text' id='reqDate' name='reqDate'/></td><td>Request Type<br> <SELECT id='reqType' name='reqType'/><OPTION VALUE=''>Select Type ...</OPTION>".$types."<SELECT/></td></tr>";

echo "<tr style='display:".$style."'><td colspan='2'>Is CSP Beneficiary? <INPUT TYPE='checkbox' VALUE='1'/></tr>";

echo "<tr><td>Beneficiary Cluster<br> <INPUT TYPE='text' id='cluster' name='cluster' VALUE='".$data['icp'][0]->cname."' readonly/></td><td>Beneficiary ICP<br> <INPUT TYPE='text' name='icpNo' id='icpNo' VALUE='".$data['icp'][0]->fname."' readonly/></td></tr>";

echo "<tr><td>Beneficiary Number<br> <INPUT TYPE='text' id='childNo' name='childNo' onchange='getchilddetails(this)'/></td><td>Beneficiary Name<br> <INPUT TYPE='text' name='childName' id='childName' readonly/></td></tr>";

echo "<tr><td>Facility Name<br> <INPUT TYPE='text' id='facName' name='facName'/></td><td>Diagnosis<br> <INPUT TYPE='text' name='diag' id='diag'/></td></tr>";

echo "<tr><td>Estimated Treatment Date<br> <INPUT TYPE='text' id='treatDate' name='treatDate'/></td><td>Estimated Cost<br> <INPUT TYPE='text' name='cost' id='cost'/></td></tr>";

echo "<tr><td colspan='2'><TEXTAREA name='details' id='details' cols='120' rows='10' placeholder='Enter notes here ...'></TEXTAREA></td></tr>";

echo "</form>";
echo "<tr><td colspan='2'><button onclick='medicalrequest()'>Submit</button></td></tr>";
echo "</table>";

echo Resources::img('bottom_border.png',array("style"=>"max-width:100%;"));
?>