<?php
echo Resources::a_href("Reports/registerMalCase","[New Case]");
echo Resources::a_href("Reports/updateMalCase","[Update Case]");
echo "<hr>";

$reqDate="";
$exitDate="";
$weight="";
$height="";
$muac=0;
$reason ="";
if(!empty($data['exitParams'])){
	$reqDate=$data['exitParams']->requestDate;
	$exitDate=$data['exitParams']->exitDate;
	$weight=$data['exitParams']->exitWeight;
	$height=$data['exitParams']->exitHeight;
	$muac=$data['exitParams']->exitMUAC;	
	$reason=$data['exitParams']->exitReason;
}

echo "<table>";
echo "<caption>Exit request for ".$data['childNo']."</caption>";
echo "<form id='frmEXitReq'>";
echo "<tr style='height:50px;'><th colspan='2'>Outcome at point of exit from therapeutic or supplementary  feeding program</th></tr>";
echo "<input type='hidden' id='malID' name='malID' value='".$data['malID']."'/>";
echo "<tr><th style='text-align:left;'>Request Date: </th><td><input type='text' id='requestDate' name='requestDate' readonly='readonly' value='".$reqDate."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Exit Date: </th><td><input type='text' id='exitDate' name='exitDate' readonly='readonly' value='".$exitDate."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Weight (in Kgs)  at time of Request </th><td><input type='text' id='exitWeight' name='exitWeight' value='".$weight."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Height (in cms)  at time of Request </th><td><input type='text' id='exitHeight' name='exitHeight' value='".$height."'/></td></tr>";
echo "<tr><th style='text-align:left;'>MUAC if under five years  at time of Request</th><td><input type='text' id='exitMUAC' name='exitMUAC'  value='".$muac."'/></td></tr>";
echo "<tr><th style='text-align:left;'>Reasons for Exiting the Case</th>";

echo "<td>";
	echo "<SELECT id='exitReason' name='exitReason'>";
	echo "<option value=''>Select Exit Reason ... </option>";
		foreach ($data['reasons'] as $value) {
				$selected="";
		if(!empty($data['exitParams'])){
			if($value->reason===$reason){
				$selected="selected";
			}
		}
		echo "<option ".$selected." value='".$value->reason."'>".$value->reason."</option>";
	}
	echo "</SELECT>";
echo "</td></tr>";
echo "</form>";
if(!empty($data['exitParams'])&&$muac=$data['exitParams']->exitStatus==='0'){
	echo "<tr><td colspan='2'><button onclick='declineRequest(\"frmEXitReq\");'>Decline Request</button></td></tr>";
}elseif(!empty($data['exitParams'])&&$muac=$data['exitParams']->exitStatus!=='0'){
		echo "<tr><td colspan='2'><span style='font-weight:bold;color:red;'>This request has been processed and can only be declined by a Health Specialist</span></td></tr>";
}else{
	echo "<tr><td colspan='2'><button onclick='exitRequest(\"frmEXitReq\");'>Request Exit</button></td></tr>";
}

echo "</table>";


?>