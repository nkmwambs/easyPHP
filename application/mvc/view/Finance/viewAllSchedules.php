<?php
//print_r($data[3]);

echo "<button onclick='massSubmitPlanItems();'>Mass Submit</button><button onclick='printData(\"tblAllSchedules\");'>Print</button><button id='' onclick='excelexport()'>Export</button><br><br>";
echo "<form id='frmRq'>";
echo "<div id='rqMsgDiv' class='centered' style='display:none'></div>";
echo "</form>";
if(!empty($data[0])){
$tbl_arr = array("JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt");

echo "<div id='rst'>";

echo "<table id='tblAllSchedules' style='white-space:nowrap;text-align:right;'>";

$fullDate = date("Y-m-d");
		
$fy=Resources::func("get_financial_year",array($fullDate));

if(!isset($data['fy'])){$data['fy']=$fy;}

echo "<caption style='text-align:left;'><b>".Resources::session()->fname."-".Resources::session()->lname." Budget Summary and Schedules for FY".$data['fy']."<b></caption>";

//Summary
echo "<tr><th colspan='20' style='text-align:left;'>Budget Summary</th></tr>";

echo "<tr><th colspan='2'>Account Description</th><th>Annual Total</th><th>July</th><th>August</th><th>September</th><th>October</th><th>November</th><th>December</th><th>January</th><th>February</th><th>March</th><th>April</th><th>May</th><th>June</th><th colspan='5'>&nbsp;</th></tr>";
			$GrandaccTotal=0;
			$GrandJulSumTot=0;
			$GrandAugSumTot=0;
			$GrandSepSumTot=0;
			$GrandOctSumTot=0;
			$GrandNovSumTot=0;
			$GrandDecSumTot=0;
			$GrandJanSumTot=0;
			$GrandFebSumTot=0;
			$GrandMarSumTot=0;
			$GrandAprSumTot=0;
			$GrandMaySumTot=0;
			$GrandJunSumTot=0;
foreach($data[0] as $item):
	echo "<tr style='border: 1px solid black;'><th colspan='2' style='text-align:left;background-color:lightgrey;'>".$item->AccText." - ".$item->AccName."</th>";	
	
	$accSumTotal =0;
	$JulSumTot=0;
	$AugSumTot=0;
	$SepSumTot=0;
	$OctSumTot=0;
	$NovSumTot=0;
	$DecSumTot=0;
	$JanSumTot=0;
	$FebSumTot=0;
	$MarSumTot=0;
	$AprSumTot=0;
	$MaySumTot=0;
	$JunSumTot=0;
			
	foreach($data[1] as $scheduledItem):
		if($scheduledItem->AccNo===$item->AccNo){
			$accSumTotal+=$scheduledItem->totalCost;	
			$JulSumTot+=$scheduledItem->JulAmt;
			$AugSumTot+=$scheduledItem->AugAmt;
			$SepSumTot+=$scheduledItem->SepAmt;
			$OctSumTot+=$scheduledItem->OctAmt;
			$NovSumTot+=$scheduledItem->NovAmt;
			$DecSumTot+=$scheduledItem->DecAmt;
			$JanSumTot+=$scheduledItem->JanAmt;
			$FebSumTot+=$scheduledItem->FebAmt;
			$MarSumTot+=$scheduledItem->MarAmt;
			$AprSumTot+=$scheduledItem->AprAmt;
			$MaySumTot+=$scheduledItem->MayAmt;
			$JunSumTot+=$scheduledItem->JunAmt;
			
		}
	endforeach;
			$GrandaccTotal+=$accSumTotal;
			$GrandJulSumTot+=$JulSumTot;
			$GrandAugSumTot+=$AugSumTot;
			$GrandSepSumTot+=$SepSumTot;
			$GrandOctSumTot+=$OctSumTot;
			$GrandNovSumTot+=$NovSumTot;
			$GrandDecSumTot+=$DecSumTot;
			$GrandJanSumTot+=$JanSumTot;
			$GrandFebSumTot+=$FebSumTot;
			$GrandMarSumTot+=$MarSumTot;
			$GrandAprSumTot+=$AprSumTot;
			$GrandMaySumTot+=$MaySumTot;
			$GrandJunSumTot+=$JunSumTot;	
	echo "<td style='font-weight:bold;text-align:right;background-color:lightgrey;'>".number_format($accSumTotal,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($JulSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($AugSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($SepSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($OctSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($NovSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($DecSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($JanSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($FebSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($MarSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($AprSumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($MaySumTot,2)."</td><td style='text-align:right;background-color:lightgrey;'>".number_format($JunSumTot,2)."</td><td colspan='5'>&nbsp;</td>";
	
	echo "</tr>";
endforeach;
	echo "<tr><th colspan='2'>Totals:</th><th>".number_format($GrandaccTotal,2)."</th><th>".number_format($GrandJulSumTot,2)."</th><th>".number_format($GrandAugSumTot,2)."</th><th>".number_format($GrandSepSumTot,2)."</th><th>".number_format($GrandOctSumTot,2)."</th><th>".number_format($GrandNovSumTot,2)."</th><th>".number_format($GrandDecSumTot,2)."</th><th>".number_format($GrandJanSumTot,2)."</th><th>".number_format($GrandFebSumTot,2)."</th><th>".number_format($GrandMarSumTot,2)."</th><th>".number_format($GrandAprSumTot,2)."</th><th>".number_format($GrandMaySumTot,2)."</th><th>".number_format($GrandJunSumTot,2)."</th><th colspan='5'>&nbsp;</th></tr>";


//Schedules
echo "<tr><th colspan='20' style='text-align:left;'>Budget Schedules</th></tr>";
foreach($data[0] as $item):
    
    echo "<tr><th colspan='20' style='text-align:left;background-color:lightgrey;'>".$item->AccText." - ".$item->AccName."</th></tr>";
    echo "<tr><th>Action!</th><th>Description/ Details</th><th>Quantity</th><th>Unit Cost</th><th>How Often</th><th>Total Cost</th><th>Validation</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th><th>Approved?</th></tr>";
  
    $accTotal =0;
	$JulTot=0;
	$AugTot=0;
	$SepTot=0;
	$OctTot=0;
	$NovTot=0;
	$DecTot=0;
	$JanTot=0;
	$FebTot=0;
	$MarTot=0;
	$AprTot=0;
	$MayTot=0;
	$JunTot=0;

    foreach($data[1] as $scheduledItem):
        if($scheduledItem->AccNo===$item->AccNo){
            if($scheduledItem->approved=="0"){
                echo "<tr style='border: 1px solid black;'><td>".Resources::img("uncheck3.png",array("title"=>"Delete Item","onclick"=>"deleteSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".Resources::img("new.png",array("title"=>"Approval Request","id"=>"newItem_".$scheduledItem->scheduleID,"style"=>"border:1px red solid;cursor:pointer;","onclick"=>"submitNewPlanItem(this);"))." ".Resources::img("mail.png",array("title"=>"Send Update Request","style"=>"cursor:pointer;","id"=>"item_".$scheduledItem->scheduleID,"onclick"=>"sendRequest(this);"))."</td>"; 
            }elseif ($scheduledItem->approved=="1") {
                echo "<tr style='border: 1px solid black;'><td>".Resources::img("uncheck3.png",array("title"=>"Delete Item","onclick"=>"deleteSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".Resources::img("mail.png",array("title"=>"Send/ Read a Note","style"=>"cursor:pointer;","id"=>"item_".$scheduledItem->scheduleID,"onclick"=>"sendRequest(this);"))."</td>";                     
            }elseif($scheduledItem->approved=="2"){
                //echo "<tr><td>".Resources::img("mail.png",array("title"=>"Send Update Request","style"=>"cursor:pointer;","id"=>"item_".$scheduledItem->scheduleID,"onclick"=>"sendRequest(this);"))."</td>";
                echo "<tr style='border: 1px solid black;'><td>".Resources::img("unreject.png")."</td>";                    
            }elseif($scheduledItem->approved=="3"){
            	echo "<tr style='border: 1px solid black;'><td>".Resources::img("uncheck3.png",array("title"=>"Delete Item","onclick"=>"deleteSchedule(\"$scheduledItem->scheduleID\");","style"=>"border:1px red solid;cursor:pointer;"))." ".Resources::img("message.png",array("title"=>"Send Update Request","style"=>"cursor:pointer;","id"=>"item_".$scheduledItem->scheduleID,"onclick"=>"sendRequest(this);"))."</td>"; 
            }
            
        echo "<td style='text-align:left;'>".$scheduledItem->details."</td><td>".$scheduledItem->qty."</td><td>".number_format($scheduledItem->unitCost,2)."</td><td>".$scheduledItem->often."</td><td>".number_format($scheduledItem->totalCost,2)."</td><td>".number_format($scheduledItem->validate,2)."</td><td>".number_format($scheduledItem->JulAmt,2)."</td><td>".number_format($scheduledItem->AugAmt,2)."</td><td>".number_format($scheduledItem->SepAmt,2)."</td><td>".number_format($scheduledItem->OctAmt)."</td><td>".number_format($scheduledItem->NovAmt,2)."</td><td>".number_format($scheduledItem->DecAmt,2)."</td><td>".number_format($scheduledItem->JanAmt,2)."</td><td>".number_format($scheduledItem->FebAmt,2)."</td><td>".number_format($scheduledItem->MarAmt,2)."</td><td>".number_format($scheduledItem->AprAmt)."</td><td>".number_format($scheduledItem->MayAmt,2)."</td><td>".number_format($scheduledItem->JunAmt,2)."</td>";
        if($scheduledItem->approved==="0"){
            $approved = "<span style='color:brown;'>Draft</span>";
        }elseif($scheduledItem->approved==="1"){
            $approved = "<span style='color:blue;'>Submitted</span>";
        }elseif($scheduledItem->approved==="2") {
            $approved = "<span style='color:green;'>Approved</span>";
        }elseif ($scheduledItem->approved==="3") {
           $approved = "<span style='color:red;'>Not Approved</span>";     
        }
            
            echo "<td>$approved</td></tr>";
        
		    $accTotal+=$scheduledItem->totalCost;
			$JulTot+=$scheduledItem->JulAmt;
			$AugTot+=$scheduledItem->AugAmt;
			$SepTot+=$scheduledItem->SepAmt;
			$OctTot+=$scheduledItem->OctAmt;
			$NovTot+=$scheduledItem->NovAmt;
			$DecTot+=$scheduledItem->DecAmt;
			$JanTot+=$scheduledItem->JanAmt;
			$FebTot+=$scheduledItem->FebAmt;
			$MarTot+=$scheduledItem->MarAmt;
			$AprTot+=$scheduledItem->AprAmt;
			$MayTot+=$scheduledItem->MayAmt;
			$JunTot+=$scheduledItem->JunAmt;
            
        }
    endforeach;
   // print_r($data[2]);
    //foreach($data[2] as $totals):
      //  if($totals->AccNo===$item->AccNo){
        echo "<tr><th colspan='5'>Totals: </th><th>".number_format($accTotal,2)."</th><th>&nbsp;</th><th>".number_format($JulTot,2)."</th><th>".number_format($AugTot,2)."</th><th>".number_format($SepTot,2)."</th><th>".number_format($OctTot,2)."</th><th>".number_format($NovTot,2)."</th><th>".number_format($DecTot,2)."</th><th>".number_format($JanTot,2)."</th><th>".number_format($FebTot,2)."</th><th>".number_format($MarTot,2)."</th><th>".number_format($AprTot,2)."</th><th>".number_format($MayTot,2)."</th><th>".number_format($JunTot,2)."</th><th>&nbsp;</th></tr>";
        //}
    //endforeach;
    foreach ($data[1] as $extraItem):
        if($extraItem->AccNo===$item->AccNo){
        //echo "<tr><td colspan='20'>&nbsp;</td></tr>";
        //echo "<tr><td colspan='20' style='text-align:left;display:block;'><label>Notes for $extraItem->details</label><br><textarea rows='10' cols='150' style='overflow:auto;' readonly>$extraItem->notes</textarea></td></tr>";
        echo "<tr><td colspan='20' style='text-align:left;'><b>Notes for ".$extraItem->details."</b><br>".$extraItem->notes."</td></tr>";
        echo "<tr><td colspan='20'>&nbsp;</td></tr>";
		}
    endforeach; 
endforeach;
echo "</table>";

echo "</div>";

}
 else {
     echo "<b>No budget schedules present for this selected period</b>";
}

?>
