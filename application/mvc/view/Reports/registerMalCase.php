<?php
//echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";
echo "<table>";
echo "<caption style='font-weight:bold;'>COMPASSION KENYA BENEFICIARY MALNUTRITION REPORTING TOOL</caption>";
echo "<tr style='height:50px;'><th colspan='2'>Instructions to ICP:</th></tr>";
echo "<tr><td colspan='2'>";
?>

<ol>
	<li>Fill in the following details  for the child diagnosed with any form of Malnutrition(Moderate /severe)</li>
	<li>Fill a separate form for each child</li>
	<li>This data  should be filled and submitted to the CSP Specialist and Health Specialist after every 30 days from the date of initial diagnosis with severe(S) or Moderate(M) Malnutrition.You will be advised on when to stop submitting this data for an individual beneficiary</li>
	<li>Fill in MUAC data for under fives</li>
</ol> 

<?php
echo "</td></tr>";
echo "<tr style='height:50px;'><th colspan='2'>Beneficiary Identifire Details</th></tr>";

echo "<tr><th style='text-align:left;'>Cluster:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Your Cluster</OPTION>";
	
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>KE Number:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Your KE Number</OPTION>";
	
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Program Type:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Program</OPTION>";
	
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>CSP Number:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Number:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Name:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Birthdate:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Gender:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Gender</OPTION>";
	
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Age:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>If CSP, Beneficiary Birth Weight:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Date Recruited in the Program:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr style='height:50px;'><th colspan='2'>Anthropometric measures at diagnosis</th></tr>";

echo "<tr><th style='text-align:left;'>Type Of Malnutrition Diagnosed:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Type</OPTION>";
	echo "<OPTION>Moderate</OPTION>";
	echo "<OPTION>Severe</OPTION>";
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Name of Health Facility:</th>";
echo "<td><INPUT TYPE='text' id='' name=''/></td></tr>";

echo "<tr><th style='text-align:left;'>Designation of Health provider who made diagnosis:</th>";
echo "<td><SELECT id='' name=''><OPTION>Choose Designation</OPTION>";
	echo "<OPTION>Nutritionist</OPTION>";
	echo "<OPTION>Nurse</OPTION>";
	echo "<OPTION>Clinical Officer</OPTION>";
	echo "<OPTION>Medical Doctor</OPTION>";
	echo "<OPTION>Paeditrician</OPTION>";
echo "</SELECT></td></tr>";

echo "<tr><th>Weight at Diagnosis in Kgs: <INPUT TYPE='text' id='' name=''/></th><th>Date:<INPUT TYPE='text' id='' name=''/></th></tr>";

echo "<tr><th>Height at Diagnosis in Kgs: <INPUT TYPE='text' id='' name=''/></th><th>Date:<INPUT TYPE='text' id='' name=''/></th></tr>";

echo "<tr><th>If under five years, indicate the Middle Upper Arm Circumference (MUAC): <INPUT TYPE='text' id='' name=''/></th><th>Date:<INPUT TYPE='text' id='' name=''/></th></tr>";

echo "</table>";
?>