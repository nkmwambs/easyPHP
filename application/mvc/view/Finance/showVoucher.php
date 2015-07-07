<?php
//print_r($data);
echo Resources::img("print.png",array("title"=>"Print","onclick"=>'printData("tblVoucher");'))." ".Resources::a_href("finance/downloadVoucher/VNum/".$data[0]->VNumber,Resources::img("download.png",array("title"=>"Download")),array("target"=>"__blank"));
    echo "<table id='tblVoucher' border='1'>";
    echo "<tr><th colspan='5'>COMPASSION ASSISTED PROJECT</th></tr>";
    echo "<tr><th colspan='5'>".$data[0]->icpNo." - ".$_SESSION['lname_backup']."<br>Payment Voucher</th></tr>";
    echo "<tr><th colspan='3' align='left' style='padding-left:25px;'>Date: ".$data[0]->TDate."</th><th colspan='2' align='left'>Voucher Number: ".$data[0]->VNumber."</th></tr>";
    echo "<tr><th colspan='3' align='left' style='padding-left:25px;'>Voucher Type: ".$data[0]->VType."</th><th colspan='3' align='left'>Cheque Number: ".$data[0]->ChqNo."</th></tr>";
    echo "<tr><th colspan='1' align='left' style='padding-left:25px;'>Description:</th><td colspan='5' align='left'>".$data[0]->TDescription."</td></tr>";
    echo "<tr><th style='padding-left:25px;'>Quantity</th><th>Details</th><th>Unit Cost</th><th>Cost</th><th>Account</th></tr>";
   
    foreach($data as $val):
        $getRow=(array)$val;
    echo "<tr>";
        if(($getRow['AccNo']>=100) AND ($getRow['AccNo']<1000)){
            
        echo "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>R".$getRow['AccNo']."</td>";
        }elseif($getRow['AccNo']<100){
            echo "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>E".$getRow['AccNo']."</td>";
        }
        elseif(($getRow['AccNo']>100)AND($getRow['AccNo']<2000)){
            $str = substr($getRow['AccNo'], 1);
            echo "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td><td>E".$str."</td>";
        }elseif($getRow['AccNo']>='2000'){
            echo "<td align='right'>".$getRow['Qty']."</td><td>".$getRow['Details']."</td><td align='right'>".$getRow['UnitCost']."</td><td align='right'>".$getRow['Cost']."</td>";
                if($getRow['AccNo']==='2000'){echo "<td>CDSP-PC Deposit</td>";}
                if($getRow['AccNo']==='2001'){echo "<td>CSP-PC Deposit</td>";}
        }
      echo "</tr>";
      endforeach;

    echo "<tr><td colspan='3' style='padding-left:25px;'><b>Voucher Total</b></td><td align='right'>0.00</td><td><b>&nbsp;</b></td></tr>";
    echo "<tr><td rowspan='3' style='padding-left:25px;'>APPROVED:</td><td colspan='2'>&nbsp;</td><td rowspan='3'>Date:</td><td>&nbsp;</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td><td>&nbsp;</td></tr>";
    echo "<tr><td colspan='2'>&nbsp;</td><td>&nbsp;</td></tr>";
    echo "<tr><td colspan='3' align='left' style='padding-left:25px;'>Received By:</td><td colspan='2' align='left'>Passed By:</td></tr>";
    echo "<tr><td colspan='3' align='left' style='padding-left:25px;'>Date:</td><td colspan='2' align='left'>Date:</td></tr>";
    echo "</table>";