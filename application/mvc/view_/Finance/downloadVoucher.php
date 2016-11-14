<?php
echo Resources::import("mpdf.mpdf");
//require_once('library/mpdf.php'); 
$mpdf = new mPDF(); 
	//$content="<html><head><title>Voucher Download</title>";
	
	//$content.="</head><body>";
 	$content= "<table id='tblVoucher' border='1' style='border-collapse:collapse;'>";
    $content.= "<tr><th colspan='5'>COMPASSION ASSISTED PROJECT</th></tr>";
    $content.= "<tr><th colspan='5'>".$data[0]->icpNo." - ".$_SESSION['lname_backup']."<br>Payment Voucher</th></tr>";
    $content.= "<tr><th colspan='3' align='left' style='padding-left:25px;'>Date: ".$data[0]->TDate."</th><th colspan='2' align='left'>Voucher Number: ".$data[0]->VNumber."</th></tr>";
    $content.= "<tr><th colspan='3' align='left' style='padding-left:25px;'>Voucher Type: ".$data[0]->VType."</th><th colspan='2' align='left'>Cheque Number: ".$data[0]->ChqNo."</th></tr>";
    $content.= "<tr><th colspan='1' align='left' style='padding-left:25px;'>Description:</th><td colspan='4' align='left'>".$data[0]->TDescription."</td></tr>";
    $content.= "<tr><th style='padding-left:25px;'>Quantity</th><th>Details</th><th>Unit Cost</th><th>Cost</th><th>Account</th></tr>";
   
    foreach($data as $val):
        $getRow=(array)$val;
    $content.= "<tr>";
        if(($getRow['AccNo']>=100) AND ($getRow['AccNo']<1000)){
            
        $content.= "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>R".$getRow['AccNo']."</td>";
        }elseif($getRow['AccNo']<100){
            $content.= "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>E".$getRow['AccNo']."</td>";
        }
        elseif(($getRow['AccNo']>100)AND($getRow['AccNo']<2000)){
            $str = substr($getRow['AccNo'], 1);
            $content.= "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>E".$str."</td>";
        }elseif($getRow['AccNo']>='2000'){
            $content.= "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td>";
                if($getRow['AccNo']==='2000'){$content.= "<td>CDSP-PC Deposit</td>";}
                if($getRow['AccNo']==='2001'){$content.= "<td>CSP-PC Deposit</td>";}
        }
      $content.= "</tr>";
      endforeach;

    $content.= "<tr><td colspan='3' style='padding-left:25px;'><b>Voucher Total</b></td><td align='right'>0.00</td><td><b>&nbsp;</b></td></tr>";
    $content.= "<tr><td rowspan='3' style='padding-left:25px;'>APPROVED:</td><td colspan='2'>&nbsp;</td><td rowspan='3'>Date:</td><td>&nbsp;</td></tr>";
    $content.= "<tr><td colspan='2'>&nbsp;</td><td>&nbsp;</td></tr>";
    $content.= "<tr><td colspan='2'>&nbsp;</td><td>&nbsp;</td></tr>";
    $content.= "<tr><td colspan='3' align='left' style='padding-left:25px;'>Received By:</td><td colspan='2' align='left'>Passed By:</td></tr>";
    $content.= "<tr><td colspan='3' align='left' style='padding-left:25px;'>Date:</td><td colspan='2' align='left'>Date:</td></tr>";
    $content.= "</table>";
	//$content.= "</body></html>";
ob_end_clean();
$mpdf->WriteHTML($content); 

$mpdf->Output(); 

exit; 

