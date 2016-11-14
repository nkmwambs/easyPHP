<?php
echo Resources::a_href("Reports/pdsreportview","<button>Back</button>")."<br><br>";
echo "<hr>";

$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");

$cMonth=$data['month'];
$cYear=$data['year'];

$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
//print_r($data['nonattflds']);
$dates_with_attendance_array=array();
$prevdates_with_attendance_array=array();

$cnt=1;
foreach($data['attendance'] as $value):
	if($value!=='0'&&$cnt<32){
		$prevdates_with_attendance_array[]=$cnt;	
	}
	$cnt++;
endforeach;

$cnt2=1;
foreach($data['attendance'] as $value):
	if($value!=='0'&&$cnt2>31){
		$dates_with_attendance_array[]=$cnt2-31;	
	}
	$cnt2++;
endforeach;
//print_r($dates_with_attendance_array);
//Set readonly
$readonly='';
$status='';
if($data['nonattflds']['status']==='1'){
	$readonly='readonly';
	$status="Report Submitted (Awaiting PF Validation)";
}elseif($data['nonattflds']['status']==='3'){
	$readonly='readonly';
	$status="Report Submitted and Validated by the PF";
}elseif($data['nonattflds']['status']==='2'){
	$status = "Report Declined by the PF.<br>";
	$status.="<span style='color:green;'>Reason:</span><br>";
	$status.="<span style='color:black;font-size:10pt;'>".$data['nonattflds']['declineReason']."</span>";
}else{
	$status="New Report";
}


echo "<form id='frmPdsReport'>";

echo "<table>";

echo "<caption style='font-weight:bold;'>Monthly PD's Report<br><br><div id='error_div'>Status: {$status}</div><br></caption>";

//echo "<tr><th colspan='2' style='background:cyan;'>".date('t')."</th></tr>";

echo "<tr><th style='text-align:left;'>Project Number</th><td><INPUT TYPE='text' id='icpNo' name='icpNo' value='".$data['icp']."' readonly='readonly'/></td></tr>";
echo "<tr><th style='text-align:left;'>Cluster</th><td><INPUT TYPE='text' id='cstName' name='cstName'  value='".$data['cst']."' readonly='readonly'/></td></tr>";
echo "<tr><th style='text-align:left;'>Reporting Month</th><td><INPUT TYPE='text' value='".date('F Y',strtotime($data['nonattflds']['rptMonth']))."' id='rptMonth' name='rptMonth' readonly/></td></tr>";

echo "<tr><th colspan='2' style='text-align:left;'>What was the total attendance of CDSP in the program for the days below</th></tr>";

echo "<tr><td colspan='2'>";

?>

<!-- Previous Month -->

<div style="min-width:100%;">
<table width="200" style="border:2px orange solid;">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-2].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>
<?php
//print_r($dates_with_attendance_array);
$prevtimestamp = mktime(0,0,0,$cMonth-1,1,$cYear);
$prevmaxday = date("t",$prevtimestamp);
$prevthismonth = getdate ($prevtimestamp);
$prevstartday = $prevthismonth['wday'];
for ($i=0; $i<($prevmaxday+$prevstartday); $i++) {
    if(($i % 7) == 0 ){echo "<tr>&nbsp;&nbsp;";}
    if($i < $prevstartday){echo "<td></td>&nbsp;&nbsp;";}
    else {
        $prevtdy = $i - $prevstartday + 1;
        $prevnow_day = (int)date('j',strtotime("last month"));
        $prevnow_mth=date('n',strtotime("last month"));
        $prevnow_yr=date('Y',strtotime("last month"));
        if(isset($prevdates_with_attendance_array)){
            if(in_array($prevtdy, $prevdates_with_attendance_array)){
               $prevbgColor="title='".$data['attendance']['fday'.$prevtdy]."' style='background-color:green;";
            }  else {
               $prevbgColor="";
           }
        }else{
            $prevbgColor="style='";
        }
       if($prevtdy===$prevnow_day&&$cMonth===$prevnow_mth&&$cYear=$prevnow_yr){
        	echo "<td align='center' valign='middle' height='20px'  $prevbgColor;border:2px red solid;'>". ($i - $prevstartday + 1) . "<INPUT TYPE='text' $readonly onclick='addAttendance(this,$cMonth,$cYear);' style='width:60px;margin-left:10px;' name='fday".$prevtdy."' value='".$data['attendance']['fday'.$prevtdy]."'/></td>&nbsp;&nbsp;";
       }else{
          echo "<td align='center' valign='middle' height='20px'  $prevbgColor'>". ($i - $prevstartday + 1) . "<br><INPUT TYPE='text' $readonly onclick='addAttendance(this,$cMonth,$cYear);' style='width:60px;margin-left:10px;' name='fday".$prevtdy."'  value='".$data['attendance']['fday'.$prevtdy]."'/></td>&nbsp;&nbsp;";

       }
    }
    if(($i % 7) == 6 ) {echo "</tr>&nbsp;&nbsp;";}
}
?>
</table>
</td>
</tr>
</table>
</div>


<!--Current Month-->


<div style="min-width:100%;">
<table width="200" style="border:2px orange solid;">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>
<?php
//print_r($dates_with_attendance_array);
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ){echo "<tr>&nbsp;&nbsp;";}
    if($i < $startday){echo "<td></td>&nbsp;&nbsp;";}
    else {
        $tdy = $i - $startday + 1;
        $now_day = (int)date('j');
        $now_mth=date('n');
        $now_yr=date('Y');
        if(isset($dates_with_attendance_array)){
            if(in_array($tdy, $dates_with_attendance_array)){
               $bgColor="title='".$data['attendance']['day'.$tdy]."' style='background-color:green;";
            }  else {
               $bgColor="";
           }
        }else{
            $bgColor="style='";
        }
       if($tdy===$now_day&&$cMonth===$now_mth&&$cYear=$now_yr){
        echo "<td align='center' valign='middle' height='20px'  $bgColor;border:2px red solid;'>". ($i - $startday + 1) . "<INPUT TYPE='text' $readonly onclick='addAttendance(this,$cMonth,$cYear);' style='width:60px;margin-left:10px;' name='day".$tdy."' value='".$data['attendance']['day'.$tdy]."'/></td>&nbsp;&nbsp;";
       }else{
           echo "<td align='center' valign='middle' height='20px'  $bgColor'>". ($i - $startday + 1) . "<br><INPUT TYPE='text' $readonly onclick='addAttendance(this,$cMonth,$cYear);' style='width:60px;margin-left:10px;' name='day".$tdy."'  value='".$data['attendance']['day'.$tdy]."'/></td>&nbsp;&nbsp;";

       }
    }
    if(($i % 7) == 6 ) {echo "</tr>&nbsp;&nbsp;";}
}
?>
</table>
</td>
</tr>
</table>
</div>


<?php


echo "</td></tr>";

echo "<tr><th style='text-align:left;'>How many children participated in Community activities in the month</th><td><INPUT TYPE='text' $readonly value='".$data['nonattflds']['communityActivitiesParticipation']."' id='communityActivitiesParticipation' name='communityActivitiesParticipation'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people got saved for the first time last month ?</th><td><INPUT TYPE='text' $readonly  value='".$data['nonattflds']['firstTimeSaved']."' id='firstTimeSaved' name='firstTimeSaved'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people practiced spiritual disciplines of prayer, bible study, worship and service last month?</th><td><INPUT TYPE='text' $readonly  value='".$data['nonattflds']['practiseSpiritualDiscipline']."' id='practiseSpiritualDiscipline' name='practiseSpiritualDiscipline'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people received bibles for the first time last month</th><td><INPUT TYPE='text'  $readonly value='".$data['nonattflds']['receivedFirstBibles']."' id='receivedFirstBibles' name='receivedFirstBibles'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people participated in narrative bible stories sharing and memory verses last month</th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['shareVerses']."'  id='shareVerses' name='shareVerses'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people underwent counselling for inappropriate behaviour last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['childrenCounselled']."' id='childrenCounselled' name='childrenCounselled'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people planted trees last month to exercise responsibility for the environment </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['plantedTrees']."'  id='plantedTrees' name='plantedTrees'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children/young people participated in spiritual outreach & campaign activities last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['participateinoutrreach']."'   id='participateinoutrreach' name='participateinoutrreach'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many new CDSP beneficiaries underwent Individual Child Assessment Baseline last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['baselinecdpr']."'  id='baselinecdpr' name='baselinecdpr'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many Exited CDSP beneficiaries underwent final CDPR Assessment upon Exit last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['finalcdpr']."'  id='finalcdpr' name='finalcdpr'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many CDSP beneficiaries completed the Program last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['cdspbencompleted']."'  id='cdspbencompleted' name='cdspbencompleted'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many CDSP beneficiaries were exited from CDSP before completing the Program last month?</th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['cdspexitbeforecomplete']."' id='cdspexitbeforecomplete' name='cdspexitbeforecomplete'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many young people were in college / university last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['collegestudents']."'  id='collegestudents' name='collegestudents'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many beneficiaries successfully completed Non-Degree College level education last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['completenondegreeeducation']."'  id='completenondegreeeducation' name='completenondegreeeducation'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many beneficiaries successfully completed a degree level education last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['completedegreeeducation']."'   id='completedegreeeducation' name='completedegreeeducation'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many young people completed vocational trainings last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['completedvocational']."'    id='completedvocational' name='completedvocational'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many young people utilized at least one income generating skill last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['utilizediga']."'   id='utilizediga' name='utilizediga'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many young people attained their 'Plan For Tomorrow' goals last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['attainmpftgoals']."'  id='attainmpftgoals' name='attainmpftgoals'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many young people updated their 'Plan For Tomorrow' last month? </th><td><INPUT TYPE='text'  $readonly   value='".$data['nonattflds']['updatedmpft']."'  id='updatedmpft' name='updatedmpft'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children / young people participated in Compassion Sunday last month? </th><td><INPUT TYPE='text'  $readonly   value='".$data['nonattflds']['beneficiariesincompassionsunday']."'  id='beneficiariesincompassionsunday' name='beneficiariesincompassionsunday'/></td></tr>";

echo "<tr><th style='text-align:left;'>How many children / young people celebrated their birthdays last month? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['celebratedbirthday']."'  id='celebratedbirthday' name='celebratedbirthday'/></td></tr>";

//For Quarterly Report
$qtr=array("9","12","3","6");
$hidden="";
if(!in_array(date('n'), $qtr)){
	$hidden="style='display:none;'";
}

echo "<tr $hidden><th style='text-align:left;'>How many children and youth are in boarding schools? </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['boardingchildren']."'  id='boardingchildren' name='boardingchildren'/></td></tr>";
echo "<tr $hidden><th style='text-align:left;'>How many Project Volunteers (non-fulltime staff) received Child Protection training in the last 3 months </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['volunteerchildprotection']."'  id='volunteerchildprotection' name='volunteerchildprotection'/></td></tr>";
echo "<tr $hidden><th style='text-align:left;'>How many Caregivers received Child Protection training in the last 3 months </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['caregiverchildprotection']."'  id='caregiverchildprotection' name='caregiverchildprotection'/></td></tr>";
echo "<tr $hidden><th style='text-align:left;'>How many beneficiaries (children and youth) received Child Protection training in the last 3 months</th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['beneficiarychildprotection']."'  id='beneficiarychildprotection' name='beneficiarychildprotection'/></td></tr>";
echo "<tr $hidden><th style='text-align:left;'>How many supported caregivers had been earning a net profit of more than Kshs160/day in the last 3 months </th><td><INPUT TYPE='text'  $readonly  value='".$data['nonattflds']['caregiverearning']."'  id='caregiverearning' name='caregiverearning'/></td></tr>";


echo "</table>";

echo "</form>";


if(Resources::session()->userlevel==='1'&&($data['nonattflds']['status']==='0'||$data['nonattflds']['status']==='2')){
	echo "<button onclick='savePdsReport(\"frmPdsReport\");'>Save</button><button onclick='submitpdsreport(".mktime(0,0,0,date('m',strtotime($data['nonattflds']['rptMonth'])),21,date('Y',strtotime($data['nonattflds']['rptMonth']))).",".strtotime(date('Y-m-d')).",". strtotime('+1 month 4 days',strtotime($data['nonattflds']['rptMonth'])).",\"frmPdsReport\");'>Submit</button>";
}elseif(Resources::session()->userlevel==='2'){
	echo "<div id='declineDiv' style=''>";
		echo "<textarea style='float:left;' id='declineReason' name='declineReason' cols='80' rows='5' placeholder='Decline Reason'>".$data['nonattflds']['declineReason']."</textarea>";
		echo "<br><button style='float:left;' onclick='validatepdsreport(".$data['nonattflds']['rptID'].",\"2\");'>Decline</button>";
	echo "</div><br><br><br><br>";
	
	echo "<button onclick='validatepdsreport(".$data['nonattflds']['rptID'].",\"3\");'>Accept</button>";
}
//echo mktime(0,0,0,11,21,2015);
//echo date('Y-m-d',strtotime('last saturday of this month',strtotime($data['nonattflds']['rptMonth'])));
?>