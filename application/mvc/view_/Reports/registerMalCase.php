<?php
//echo Resources::a_href("Reports/malnutrition","[Malnutrition Report]");
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";

echo "<table>";
echo "<caption style='font-weight:bold;'>COMPASSION KENYA BENEFICIARY MALNUTRITION TRACKING TOOL</caption>";
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
echo "<form id='frmnewMal'>";
echo "<tr style='height:50px;'><th colspan='2'  style='background-color:gray;color:white;'>Beneficiary Identifier Details</th></tr>";

echo "<tr><th style='text-align:left;'>Cluster:</th>";
echo "<td><INPUT type='text'   class='validate' id='cst' name='cst' value='".$data['cst']."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>KE Number:</th>";
echo "<td><INPUT type='text'   class='validate' id='pNo' name='icpNo' value='".$data['icp']."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Program Type:</th>";
echo "<td><SELECT id='prg'  class='validate'  name='prg'><OPTION value=''>Choose Program</OPTION>";
if($data['has_csp']===1){
	echo "<option value='1'>CSP</option>";
}
	echo "<option value='2'>CDSP</option>";
echo "</SELECT></td></tr>";

if($data['has_csp']===1){
echo "<tr><th style='text-align:left;'>CSP Number:</th>";
echo "<td><INPUT TYPE='text'  class='validate'  id='csNo' name='csNo'/></td></tr>";
}

echo "<tr><th style='text-align:left;'>Beneficiary Number:</th>";
echo "<td><INPUT TYPE='text'  class='validate'  id='childNo' name='childNo' onchange='changeClr(this.id);' onblur='completeChildNo(this);' /></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Name:</th>";
echo "<td><INPUT TYPE='text'  class='validate'  id='childName' name='childName'/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Birthdate:</th>";
echo "<td><INPUT TYPE='text'   class='validate' id='newchildDOB' name='childDOB'/></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Gender:</th>";
echo "<td><SELECT id='childSex'  class='validate'  name='sex'><OPTION value=''>Choose Gender</OPTION>";
	echo "<option value='Male'>Male</option>";
	echo "<option value='Female'>Female</option>";
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Age:</th>";
echo "<td><INPUT TYPE='text'  class='validate'  id='childAge' name='age'/></td></tr>";

if($data['has_csp']===1){
echo "<tr><th style='text-align:left;'>If CSP, Beneficiary Birth Weight:</th>";
echo "<td><INPUT TYPE='text'   class='validate' id='childBirthWeight' name='childBirthWeight'/></td></tr>";
}

echo "<tr><th style='text-align:left;'>Date Recruited in the Program:</th>";
echo "<td><INPUT TYPE='text' id='regDate'  class='validate'  name='regDate' readonly='readonly'/></td></tr>";

echo "<tr style='height:50px;'><th colspan='2' style='background-color:gray;color:white;'>Nutritional measures at diagnosis</th></tr>";

echo "<tr><th style='text-align:left;'>Diagnosis Date</th><td><input type='text'   class='validate' id='diagDate' name='diagDate' readonly='readonly'/></td></tr>";

echo "<tr><th style='text-align:left;'>Type Of Malnutrition Diagnosed:</th>";
echo "<td><SELECT id='malType'   class='validate' name='malType'><OPTION value=''>Choose Type</OPTION>";
	echo "<OPTION value='Moderate'>Moderate</OPTION>";
	echo "<OPTION value='Severe'>Severe</OPTION>";
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Name of Health Facility:</th>";
echo "<td><INPUT TYPE='text'   class='validate' id='facName' name='facName'/></td></tr>";

echo "<tr><th style='text-align:left;'>Designation of Health provider who made diagnosis:</th>";
echo "<td><SELECT id='healthWorkerDesgn'  class='validate'  name='healthWorkerDesgn'><OPTION value=''>Choose Designation</OPTION>";
	echo "<OPTION value='Nutritionist'>Nutritionist</OPTION>";
	echo "<OPTION value='Nurse'>Nurse</OPTION>";
	echo "<OPTION value='Clinical Officer'>Clinical Officer</OPTION>";
	echo "<OPTION value='Medical Doctor'>Medical Doctor</OPTION>";
	echo "<OPTION value='Paeditrician'>Paeditrician</OPTION>";
echo "</SELECT></td></tr>";

echo "<tr><th style='text-align:left;'>Weight at Diagnosis in Kgs: </th><td><INPUT TYPE='text'  class='validate'  id='diagWeight' name='diagWeight' onblur='chkifNum(this);'/></td></tr>";

echo "<tr><th style='text-align:left;'>Height at Diagnosis in Kgs: </th><td><INPUT TYPE='text'  class='validate'  id='diagHeight' name='diagHeight' onblur='chkifNum(this);'/></td></tr>";

echo "<tr><th style='text-align:left;'>If under five years, indicate the Middle Upper Arm Circumference (MUAC):</th><td><INPUT TYPE='text'   class='validate' value='0' id='diagMUAC' name='diagMUAC' onblur='chkifNum(this);'/></td></tr>";
echo "</form>";
echo "<tr><td colspan='2'><button onclick='newMalCase(\"frmnewMal\");'>Add New Case</button><button onclick='clrForm();'>Reset</button></td></tr>";
 
 /**
echo "<tr style='height:50px;'><th colspan='2'  style='background-color:gray;color:white;'>Immediate intervention at ICP:(a.Enrolled into any therapeutic or supplementary  feeding program at a health facility?, b. Requested for MED TFI, c. None)</th></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>a. Enrolled into any therapeutic or supplementary  feeding program?</th></tr>";

echo "<tr><th style='text-align:left;'>Date Enrolled: </th><td><input type='text' id='' name=''/></td></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>b. Requested for MED TFI</th></tr>";

echo "<tr><td colspan='2'>";
echo "<table>";
echo "<caption><button>Add</button></caption>";
	echo "<tr><th>Date Requested</th><th>Amount Received in Kes.</th><th>Duration of Support in Months</th></tr>";
echo "</table>";
echo "</td></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>c. Current Anthropometric measures after  every 1 month</th></tr>";
echo "<tr><td colspan='2'>";
echo "<table>";
echo "<caption><button>Add</button></caption>";
	echo "<tr><th>Date</th><th>Current weight (in Kg)</th><th>Current Height (in cms)</th><th>MUAC/BMI</th></tr>";
echo "</table>";
echo "</td></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>d. Outcome at point of exit from therapeutic or supplementary  feeding program</th></tr>";
echo "<tr><th style='text-align:left;'>Date Exited: </th><td><input type='text' id='' name=''/></td></tr>";
echo "<tr><th style='text-align:left;'>Weight (in Kgs) </th><td><input type='text' id='' name=''/></td></tr>";
echo "<tr><th style='text-align:left;'>Height (in cms) </th><td><input type='text' id='' name=''/></td></tr>";
echo "<tr><th style='text-align:left;'>MUAC if under five years</th><td><input type='text' id='' name=''/></td></tr>";
**/
echo "</table>";

?>