<?php
echo "<button onclick='adjust_financial_year(\"p\");' style='float:left;'><< FY</button><input style='float:left;height:30px;width:50px;margin-right:10px;' type='text' id='curFy' value='".$data[0]."' readonly/><button onclick='adjust_financial_year(\"n\");' style='float:left;'>FY >></button>";
echo "<br><br><hr>";
echo "<button onclick='viewPlanSummary();'>View Budget Summary</button>"." "."<button onclick='viewAllSchedules();'>View All Schedules</button>".Resources::a_href("Finance/schedules","<button>New Budget Schedules</button>",array("id"=>"btnNewSchedule","style"=>"display:none"))."<br><br>";
echo "<hr><br>";
$months_arr = Resources::func("get_month_number_array",array());

$arr_financial_year_months_order =array("","July","August","September","October","November","December","January","February","March","April","May","June");
echo "<button onclick='addScheduleRow();' id='btnAddRow' style='display:none;'>Add Row</button><button style='display:none;' id='btnPostSchedule' onclick='postSchedule(\"frmSchedule\");'>Post Schedule</button>";
echo "<div id='scheduleview'>";

echo "<form id='frmSchedule'>";
echo "<table id='tblSchedule' style='white-space:nowrap;'>";
echo "<caption style='text-align:left;'><i><b>".Resources::img("inform.png")." Choose Account and Click on the ".Resources::img("go.png")." button below to view a Schedule</b></i></caption>";
echo "<tr><th colspan='2'>Account:<select name='AccNo' id='AccNo'><option value=''>Select Account ... </option>";
        foreach ($data[1] as $ac):
            echo "<option value='".$ac->AccNo."'>$ac->AccText</option>";
        endforeach;
    echo "</select>".Resources::img("go.png",array("title"=>"Go","onclick"=>'checkSchedule();',"style"=>"cursor:pointer;"))."</th><th colspan='2'>".Resources::a_href("Finance/schedules","Reset")."</th><th colspan='2'>FY:</th><th colspan='2'><input type='text' value='".$data[0]."' id='fy' name='fy' style='width:30px;' readonly/></th><th colspan='13'></th></tr>";
    
echo "<tr><th><input type='checkbox' id=''/></th><th>Item Description</th><th>Quantity</th><th>Unit Cost</th><th>How Often</th><th>Total Cost</th><th>Validation</th><th>Action!</th><th>Jul</th><th>Aug</th><th>Sept</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Approval Status</th></tr>";

Resources::import("get_month_number_array");
$mth=get_month_number_array();
echo "<tr><td colspan='5'><b>Totals</b></td><td><input type='text' id='acTotal' style='width:80px;text-align:right;' readonly/></td><td>&nbsp;</td><td>&nbsp;</td>";
$tbl_arr = array("JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt");
foreach ($mth as $key=>$value):
    echo "<td><input type='text' id='".$tbl_arr[$key-1]."' value='0' style='width:80px;text-align:right;' readonly/></td>";
endforeach; 

echo "<td>&nbsp;</td></tr>";
echo "</table>";
//echo "<div id='schedule'>Click Month Tab to View a Schedule</div><br>";
echo "<div id='notesDiv'>View Notes Here</div>";
echo "</form>";
echo "</div>";



?>