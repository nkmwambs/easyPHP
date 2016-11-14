<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

if(Resources::session()->userlevel==='1'){
	echo Resources::a_href("Reports/registerMalCase","[New Case]");
	echo Resources::a_href("Reports/updateMalCase","[Update Case]");
	echo "<hr>";
}


echo "<table>";
echo "<caption style='font-weight:bold;'>COMPASSION KENYA BENEFICIARY MALNUTRITION MONITORING REPORT</caption>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:gray;color:white;'>Beneficiary Identifire Details</th></tr>";

echo "<tr><th style='text-align:left;'>Cluster:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->cst."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>KE Number:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->icpNo."' readonly='readonly'></td></tr>";
$prg="";
if($data['case']->prg==='1'){
	$prg='CSP';
}else{
	$prg='CDSP';
}

echo "<tr><th style='text-align:left;'>Program Type:</th>";
echo "<td><INPUT type='text' id='' value='".$prg."' readonly='readonly'></td></tr>";

if($data['case']==='1'){
echo "<tr><th style='text-align:left;'>CSP Number:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->csNo."' readonly='readonly'></td></tr>";	
}

echo "<tr><th style='text-align:left;'>Beneficiary Number:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->childNo."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Name:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->childName."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Birthdate:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->childDOB."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Gender:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->sex."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Beneficiary Age:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->age."' readonly='readonly'></td></tr>";

if($data['case']->prg==='1'){
echo "<tr><th style='text-align:left;'>If CSP, Beneficiary Birth Weight:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->childBirthWeight."' readonly='readonly'></td></tr>";
}

echo "<tr><th style='text-align:left;'>Date Recruited in the Program:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->regDate."' readonly='readonly'></td></tr>";


echo "<tr style='height:50px;'><th colspan='2' style='background-color:gray;color:white;'>Anthropometric measures at diagnosis</th></tr>";
echo "<tr><th style='text-align:left;'>Diagnosis Date</th><td><INPUT type='text' id='' value='".$data['case']->diagDate."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Type Of Malnutrition Diagnosed:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->malType."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Name of Health Facility:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->facName."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Designation of Health provider who made diagnosis:</th>";
echo "<td><INPUT type='text' id='' value='".$data['case']->healthWorkerDesgn."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Weight at Diagnosis in Kgs: </th><td><INPUT type='text' id='' value='".$data['case']->diagWeight."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>Height at Diagnosis in Kgs: </th><td><INPUT type='text' id='' value='".$data['case']->diagHeight."' readonly='readonly'></td></tr>";

echo "<tr><th style='text-align:left;'>If under five years, indicate the Middle Upper Arm Circumference (MUAC):</th><td><INPUT type='text' id='' value='".$data['case']->diagMUAC."' readonly='readonly'></td></tr>";


echo "<tr style='height:50px;'><th colspan='2'  style='background-color:gray;color:white;'>Immediate intervention at ICP:(a.Enrolled into any therapeutic or supplementary  feeding program at a health facility?, b. Requested for MED TFI, c. None)</th></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>a. Enrolled into any therapeutic or supplementary  feeding program?</th></tr>";

echo "<tr><th style='text-align:left;'>Date Enrolled: </th><td><input type='text' id='' name='' value='".$data['enrolDateOther']."' readonly='readonly'/></td></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>b. Requested for MED TFI</th></tr>";

echo "<tr><td colspan='2'>";
echo "<table>";
//echo "<caption><button>Add</button></caption>";
	echo "<tr><th>Date Requested</th><th>Amount Received in Kes.</th><th>Duration of Support in Months</th></tr>";
	foreach ($data['tfiReq'] as $value) {
		echo "<tr><td>".$value->tfiDate."</td><td>".$value->tfiAmount."</td><td>".$value->tfiDuration."</td></tr>";
	}
echo "</table>";
echo "</td></tr>";

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>c. Current Nutritional measures after  every 1 month</th></tr>";
echo "<tr><td colspan='2'>";
echo "<table>";
//echo "<caption><button>Add</button></caption>";
	echo "<tr><th>Date</th><th>Current weight (in Kg)</th><th>Current Height (in cms)</th><th>MUAC/BMI</th></tr>";
		foreach ($data['metricsUpdate'] as $value) {
		echo "<tr><td>".$value->metricDate."</td><td>".$value->curWeight."</td><td>".$value->curHeight."</td><td>".$value->curMUAC."</td></tr>";
	}
echo "</table>";
echo "</td></tr>";

$reqDate="";
$exitDate="";
$weight="";
$height="";
$muac=0;
if(!empty($data['exitParamaters'])){
	$reqDate=$data['exitParamaters']->requestDate;
	$exitDate=$data['exitParamaters']->exitDate;
	$weight=$data['exitParamaters']->exitWeight;
	$height=$data['exitParamaters']->exitHeight;
	$muac=$data['exitParamaters']->exitMUAC;	
}

echo "<tr style='height:50px;'><th colspan='2'  style='background-color:cyan;color:white;'>d. Outcome at point of exit from therapeutic or supplementary  feeding program</th></tr>";
echo "<tr><th style='text-align:left;'>Request Date: </th><td><input type='text' id='requestDate' name='requestDate' readonly='readonly' value='".$reqDate."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Exit Date: </th><td><input type='text' id='exitDate' name='exitDate' readonly='readonly' value='".$exitDate."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Weight (in Kgs) at time of Request </th><td><input type='text' id='' name='' readonly='readonly' value='".$weight."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Height (in cms) at time of Request </th><td><input type='text' id='' name='' readonly='readonly' value='".$height."'/></td></tr>";
echo "<tr><th style='text-align:left;'>MUAC if under five years  at time of Request</th><td><input type='text' id='' name='' readonly='readonly' value='".$muac."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Case Status</th><td><input type='text' id='' name='' value='".$data['exitStatus']."' readonly='readonly'/></td></tr>";

echo "</table>";
?>