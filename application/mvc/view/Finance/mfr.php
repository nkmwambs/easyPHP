<?php
//print_r($data[0]);

    $curSelect=date('F-Y');
    echo "<button onclick='selectCJ(\"".strtotime('-1 month')."\");'>".date('F-Y',  strtotime('-1 month'))."</button><button style='background-color:lightgreen;'  onclick='selectCJ(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectCJ(\"".strtotime('+1 month')."\");'>".  date('F-Y',  strtotime('+1 month'))."</button>";
    
;echo "<table id='tblMfr' style='text-align:right;'>";
echo "<caption>COMPASSION INTERNATION KENYA<BR>IMPLEMENTING CHURCH PARTNERS<BR>MONTHLY FINANCIAL REPORT</caption>";
echo "<tr><th colspan='6'>1. PROJECT NAME: {$_SESSION['username']} - {$_SESSION['lname']}</th><th>Date</th><th colspan='2'>".date("d-m-Y")."</th></tr>";
echo "<tr><th colspan='6'>CDC FINANCE REPORT FOR THE MONTH OF: </th><th>".date("F")."</th><th>YEAR</th><th>".date("Y")."</th></tr>";

echo "<tr><th colspan='9'>2. FUNDS BALANCE REPORT</th></tr>";

echo "<tr><th colspan='2'>Fund</th><th colspan='2'>Beginning Balance</th><th colspan='2'>Month's Income</th><th colspan='2'>Month's Expenses</th><th>Ending Fund Balance</th></tr>";
$funds_arr =array();
$funds_arr_tran=array();

foreach($data[0] as $accs):
        //if($accs->AccGrp==='1'){
    $funds_arr[]=$accs->funds;
            echo "<tr>";
            $suportInc= $accs->amount;
            echo "<td colspan='2' style='text-align:left;'>R".$accs->funds."</td><td colspan='2'>".$accs->amount."</td>";
            $sumInc=0;
            $sumExp=0;
            foreach ($data[1] as $obj):
               if($obj->AccNo===$accs->funds){ 
                    $sumInc+=$obj->Cost;
               }
               if($obj->AccNo==="1".$accs->funds){ 
                    $sumExp+=$obj->Cost;
               }  elseif($accs->funds==="100"&&$obj->AccNo<100&&$obj->prg==="2") {
                   $sumExp+=$obj->Cost;
               }
               $funds_arr_tran[]=$obj->AccNo;
            endforeach;
            $endBal =  ($accs->amount+$sumInc)-$sumExp;
                echo "<td colspan='2'>".$sumInc."</td><td colspan='2'>".$sumExp."</td><td>".$endBal."</td>";

            echo "</tr>";
        //}

endforeach;
/**
 * Logic to be taken to controller
 */
$arr = array_keys(array_flip(array_merge(array_keys(array_flip($funds_arr_tran)),$funds_arr)));
function incomeAcc($var){
    if($var>=100&&$var<2000){
           return $var; 
        }
}
$income_accs=array_filter($arr,"incomeAcc");
$income_accs_arr=array();
foreach($income_accs as $value):
    if($value>1000){
        $val = $value-1000;
    }  else {
        $val=$value;
    }
    $income_accs_arr[]=$val;
endforeach;
//print_r($income_accs_arr);
$arr_acc_not_bf=array_diff($income_accs_arr, $funds_arr);
/*
 * End of logic
 */
foreach($arr_acc_not_bf as $missing_acc):
    echo "<tr><td colspan='2' style='text-align:left;'>R".$missing_acc."</td><td colspan='2'>0</td>";
            $sumInc=0;
            $sumExp=0;
            foreach ($data[1] as $obj):
               if($obj->AccNo==="$missing_acc"){ 
                    $sumInc+=$obj->Cost;
               }
               if($obj->AccNo==="1"."$missing_acc"){ 
                    $sumExp+=$obj->Cost;
               }  elseif($missing_acc==="100"&&$obj->AccNo<100&&$obj->prg==="2") {
                   $sumExp+=$obj->Cost;
               }
            endforeach;
            $endBal = $sumInc-$sumExp;
echo "<td colspan='2'>".$sumInc."</td><td colspan='2'>".$sumExp."</td><td>".$endBal."</td></tr>";
endforeach;

echo "<tr><td colspan='2'><b>Total</b></td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td>&nbsp;</td></tr>";

echo "<tr><th colspan='5' rowspan='7'>";
    echo "<table>";
    echo "<tr><th>1.2. DETAILS OF NON-COMPASSION INCOME ".img_tag("unreject.png",array("title"=>'Add Details'))."</th><th>AMOUNT</th></tr>";
    echo "<tr><td>1.2. TOTAL NON COMPASSION FUNDS INCOME: </td><td>&nbsp;</td></tr>";
    echo "</table>";
echo "</th><th colspan='4'>1.3. PROOF OF CASH BALANCE</th></tr>";
echo "<tr><td colspan='2'>Cash at Bank</td><td colspan='2'>&nbsp;</td></tr>";
echo "<tr><td colspan='2'>Petty Cash</td><td colspan='2'>&nbsp;</td></tr>";
echo "<tr><td colspan='2'>Total</td><td colspan='2'>&nbsp;</td></tr>";
echo "<tr><th colspan='4'>Accuracy Validation</th></tr>";
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>";
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>";

echo "<tr><th colspan='9'>1.3.3. BANK RECONCILIATION</th></tr>";
echo "<tr><td colspan='3'>&nbsp;</td><td colspan='1'>&nbsp;</td><td colspan='3'>BANK ACCOUNT 1</td><td colspan='2'>BANK ACCOUNT 2</td></tr>";
echo "<tr><td style='width:10px;'>A.</td><td colspan='2'>Date On the Bank Statement</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>B.</td><td colspan='2'>Balance Per Bank Statement</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>C.</td><td colspan='2'><b>Plus:</b> Deposit In Transit</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>D.</td><td colspan='2'><b>Less: </b>Oustanding Cheques</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>B+C-D.</td><td colspan='2'><b>ADJUSTED BANK BALANCE TOTAL</b></td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td colspan='3'><b>VALIDATION</b></td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";

echo "<tr><td colspan='4'>";
    echo "<table>";
        echo "<tr><th colspan='3'>C: DEPOSIT IN TRANSIT ".img_tag("plus.png")."</th></tr>";
        echo "<tr><td>DATE</td><td>DETAILS</td><td>AMOUNT</td></tr>";
        echo "<tr><td colspan='2'><b>TOTAL DEPOSIT IN TRANSIT</b></td><td>&nbsp;</td></tr>";
    echo "</table>";
echo "</td><td colspan='5'>";
    echo "<table>";
        echo "<tr><th colspan='3'>D: OUSTANDING (UNPRESENTED) CHEQUES ".img_tag("unreject.png")."</th></tr>";
        echo "<tr><td>DATE</td><td>CHEQUE No.</td><td>AMOUNT</td></tr>";
        echo "<tr><td colspan='2'><b>TOTAL OUTSTANDING CHEQUES</b></td><td>&nbsp;</td></tr>";
    echo "</table>";
echo "</td></tr>";

echo "<tr><td colspan='9'>";
    echo "<table>";
        echo "<tr><th colspan='5'>4: CIV FUND BALANCE BREAKDOWN  ".img_tag("unreject.png")."</th></tr>";
        echo "<tr><th>Month</th><th colspan='2'>Expense Details</th><th colspan='2'>Beneficiaries</th><th colspan='2'>Amount</th><th colspan='2'>Comment</th></tr>";
    echo "</table>";
echo "</td></tr>";

echo "</table>";

            