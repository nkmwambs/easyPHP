<?php
echo "<button>Mass Submit</button>";
echo "<form id='frmRq'>";
echo "<div id='rqMsgDiv' style='display:none'></div>";
echo "</form>";
if(!empty($data[0])){
$tbl_arr = array("JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt");
echo "<table id='tblAllSchedules' style='white-space:nowrap;text-align:right;'>";
echo "<caption><b>".$_SESSION['fname']."-".$_SESSION['lname']." Budget Schedules<b></caption>";
foreach($data[0] as $item):
    
    echo "<tr><th colspan='20' style='text-align:left;background-color:lightgrey;'>".$item->AccText." - ".$item->AccName."</th></tr>";
    echo "<tr><th>Action!</th><th>Description/ Details</th><th>Quantity</th><th>Unit Cost</th><th>How Often</th><th>Total Cost</th><th>Validation</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Approved?</th></tr>";
    $accTotal =0;
    foreach($data[1] as $scheduledItem):
        if($scheduledItem->AccNo===$item->AccNo){
            if($scheduledItem->approved=="0"||$scheduledItem->approved=="3"){
                echo "<tr><td>".img_tag("uncheck3.png",array("title"=>"Delete Item","onclick"=>"deleteSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".img_tag("edit.png",array("title"=>"Edit Record","onclick"=>"editSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".img_tag("new.png",array("id"=>"newItem_".$scheduledItem->scheduleID,"style"=>"border:1px red solid;cursor:pointer;","onclick"=>"submitNewPlanItem(this);"))."</td>"; 
            }elseif ($scheduledItem->approved=="1") {
                echo "<tr><td>".img_tag("uncheck3.png",array("title"=>"Delete Item","onclick"=>"deleteSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".img_tag("edit.png",array("title"=>"Edit Record","onclick"=>"editSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))."</td>";                     
            }elseif($scheduledItem->approved=="2"){
                echo "<tr><td>".img_tag("mail.png",array("title"=>"Send Update Request","style"=>"cursor:pointer;","id"=>"item_".$scheduledItem->scheduleID,"onclick"=>"sendRequest(this);"))."</td>";                    
            }
            
            echo "<td style='text-align:left;'>".$scheduledItem->details."</td><td>".$scheduledItem->qty."</td><td>".number_format($scheduledItem->unitCost,2)."</td><td>".$scheduledItem->often."</td><td>".number_format($scheduledItem->totalCost,2)."</td><td>".number_format($scheduledItem->validate,2)."</td><td>".number_format($scheduledItem->JulAmt,2)."</td><td>".number_format($scheduledItem->AugAmt,2)."</td><td>".number_format($scheduledItem->SepAmt,2)."</td><td>".number_format($scheduledItem->OctAmt)."</td><td>".number_format($scheduledItem->NovAmt,2)."</td><td>".number_format($scheduledItem->DecAmt,2)."</td><td>".number_format($scheduledItem->JanAmt,2)."</td><td>".number_format($scheduledItem->FebAmt,2)."</td><td>".number_format($scheduledItem->MarAmt,2)."</td><td>".number_format($scheduledItem->AprAmt)."</td><td>".number_format($scheduledItem->MayAmt,2)."</td><td>".number_format($scheduledItem->JunAmt,2)."</td>";
        if($scheduledItem->approved==="0"){
            $approved = "<span style='color:brown;'>Not Approved</span>";
        }elseif($scheduledItem->approved==="1"){
            $approved = "<span style='color:blue;'>Submitted</span>";
        }elseif($scheduledItem->approved==="2") {
            $approved = "<span style='color:green;'>Approved</span>";
        }elseif ($scheduledItem->approved==="3") {
           $approved = "<span style='color:red;'>Rejected</span>";     
        }
            
            echo "<td>$approved</td></tr>";
            $accTotal+=$scheduledItem->totalCost;
            
        }
    endforeach;
    foreach($data[2] as $totals):
        if($totals->AccNo===$item->AccNo){
        echo "<tr><th colspan='5'>Totals: </th><th>".number_format($accTotal,2)."</th><th>&nbsp;</th><th>".number_format($totals->JulTot,2)."</th><th>".number_format($totals->AugTot,2)."</th><th>".number_format($totals->SepTot,2)."</th><th>".number_format($totals->OctTot,2)."</th><th>".number_format($totals->NovTot,2)."</th><th>".number_format($totals->DecTot,2)."</th><th>".number_format($totals->JanTot,2)."</th><th>".number_format($totals->FebTot,2)."</th><th>".number_format($totals->MarTot,2)."</th><th>".number_format($totals->AprTot,2)."</th><th>".number_format($totals->MayTot,2)."</th><th>".number_format($totals->JunTot,2)."</th><th>&nbsp;</th></tr>";
        }
    endforeach;
    foreach ($data[1] as $extraItem):
        if($extraItem->AccNo===$item->AccNo){
        echo "<tr><td colspan='20' style='text-align:left;'><label>Notes for $extraItem->details</label><br><textarea rows='10' cols='150' style='overflow:auto;' readonly>$extraItem->notes</textarea></td></tr>";
        }
    endforeach;
endforeach;
echo "</table>";
}
 else {
     echo "<b>No budget schedules present for this selected period</b>";
}
?>
