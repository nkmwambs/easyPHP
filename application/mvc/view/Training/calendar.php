<?php
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");

$cMonth=$data[0];
$cYear=$data[1];
 
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
foreach($data[2] as $value):
    $dates_with_events_array[]=date('j', strtotime($value->startdate));
endforeach;
//print_r($dates_with_events_array);
//print_r($data[2]);
if(Resources::session()->userlevel==="9"){
	echo Resources::a_href("Training/newtraining","[New Calender Event]")." ".Resources::a_href("Training/delEvent","[Delete Calender Event]");
}
echo "<br><hr><br>";

?>

<div style="float:left;border-right:2px black solid;padding-right: 10px;min-width: 390px;">
<table width="150" style="border:2px orange solid;">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left"><?php echo Resources::a_href("Training/calendar/month/".$prev_month."/year/".$prev_year."","Previous",array("style"=>"color:#FFFFFF;"));?></td>
<td width="50%" align="right"><?php echo Resources::a_href("Training/calendar/month/".$next_month."/year/".$next_year."","Next",array("style"=>"color:#FFFFFF"));?></td>
</tr>
</table>
</td>
</tr>
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
        if(isset($dates_with_events_array)){
            if(in_array($tdy, $dates_with_events_array)){
               $bgColor="style='background-color:green;";
            }  else {
               $bgColor="";
           }
        }else{
            $bgColor="style='";
        }
       if($tdy===$now_day&&$cMonth===$now_mth&&$cYear=$now_yr){
        echo "<td align='center' valign='middle' height='20px' onclick='showEvent(this,$cMonth,$cYear);' $bgColor;border:2px red solid;'>". ($i - $startday + 1) . "</td>&nbsp;&nbsp;";
       }else{
           echo "<td align='center' valign='middle' height='20px' onclick='showEvent(this,$cMonth,$cYear);' $bgColor'>". ($i - $startday + 1) . "</td>&nbsp;&nbsp;";

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
<div style="float:left;margin-left: 40px;max-width:400px;">
    <table style='max-width: 100%;' id="viewEvents">
        <tr><th id="desc" colspan="4">Click a date in <span style="color:green;font-style: italic;">Green</span> the calendar to view events</th></tr>
    </table>
</div>


