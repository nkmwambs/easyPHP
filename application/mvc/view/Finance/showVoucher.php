<?php
//print_r($data['footnotes']);
echo Resources::img("print.png",array("title"=>"Print","onclick"=>'printData("tblVoucher");'))." ".Resources::a_href("finance/downloadVoucher/VNum/".$data['details'][0]->VNumber,Resources::img("download.png",array("title"=>"Download")),array("target"=>"__blank"));
    echo "<table id='tblVoucher' border='1'>";
    echo "<tr><th colspan='5'>COMPASSION ASSISTED PROJECT</th></tr>";
    echo "<tr><th colspan='5'>".$data['details'][0]->icpNo."<br>Payment Voucher</th></tr>";
    echo "<tr><th colspan='3' align='left' style='padding-left:25px;'>Date: ".$data['details'][0]->TDate."</th><th colspan='2' align='left'>Voucher Number: ".$data['details'][0]->VNumber."</th></tr>";
	echo "<tr><td colspan='5'><b>Payee/Source:<b> ".$data['details'][0]->Payee."</td></tr>";
    $rwChq=explode("-",$data['details'][0]->ChqNo);
    echo "<tr><th colspan='3' align='left' style='padding-left:25px;'>Voucher Type: ".$data['details'][0]->VType."</th><th colspan='3' align='left'>Cheque Number: ".$rwChq[0]."</th></tr>";
    echo "<tr><th colspan='1' align='left' style='padding-left:25px;'>Description:</th><td colspan='5' align='left'>".$data['details'][0]->TDescription."</td></tr>";
    echo "<tr><th style='padding-left:25px;'>Quantity</th><th>Details</th><th>Unit Cost</th><th>Cost</th><th>Account</th></tr>";
   
    foreach($data['details'] as $val):
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
	
	echo "<br><b>My Suggestion on this Voucher:</b><br>";
	echo "<form id='frmNotes'>";
	echo "<textarea cols='95' rows='10' id='msgArea' name='msg' placeholder='Type your suggestions on this voucher here ...'></textarea><br>";
	echo "<input type='hidden' name='icpNo' id='txtIcpNo' value='".$data['details'][0]->icpNo."'/><input type='hidden' name='VNumber' id='txtVNum' value='".$data['details'][0]->VNumber."'/><input type='hidden' name='msg_from' id='msg_from' value='".Resources::session()->username."'/>";
	echo "</form>";
	echo "<button onclick='postFootNote(\"frmNotes\");'>Post</button>";
	echo "<br>";
	echo "<br><br><br><b>Users Suggestions on this Voucher</b><br><br>";
	echo "<div id='fNotes'>";
	foreach($data['footnotes'] as $value):
		echo "<div class='footnotes_header'>{$value->msg_from}  post for Voucher Number {$value->VNumber}: <i>Posted on {$value->stmp}</i></div><br>";
		echo "<div class='footnotes_body'>{$value->msg}</div>";
	endforeach;
	echo "</div>";
	echo "<br><br>";
