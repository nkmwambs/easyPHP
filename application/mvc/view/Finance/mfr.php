<?php
echo "<div id='mfrView'>";
//print($data[9]);
//print_r($data[10]);

if(isset($data[1])){
	$curSelect=date('F-Y',$data[1]);
	$cur = $data[1];
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}
    
	echo "<button onclick='selectMFR(\"".strtotime('-1 month',$cur)."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectMFR(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectMFR(\"".strtotime('+1 month',$cur)."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";
    echo "<br><br><div id='error_div'>Report Status: ";
	    if($data[0]===0){
	    	echo "Report Not Submitted";
	    }else{
	    	echo "Report Submitted";
	    }
    echo "</div>";
echo "<form id='frmMfr'>";
echo "<table id='tblMfr' style='text-align:right;'>";
echo "<caption>COMPASSION INTERNATION KENYA<BR>IMPLEMENTING CHURCH PARTNERS<BR>MONTHLY FINANCIAL REPORT</caption>";
echo "<tr><th colspan='6'>1. PROJECT NAME: {$_SESSION['username']} - {$_SESSION['lname']}</th><th>Date</th><th colspan='2'>".date("d-m-Y")."<input type='hidden' id='curDate' name='curDate' value='".date("Y-m-d")."'/></th></tr>";
echo "<tr><th colspan='6'>CDC FINANCE REPORT FOR THE MONTH OF: </th><th>".date("F")."</th><th>YEAR</th><th>".date("Y")."</th></tr>";

echo "<tr><th colspan='9'>2. FUNDS BALANCE REPORT</th></tr>";

echo "<tr><th colspan='2'>Fund</th><th colspan='2'>Beginning Balance</th><th colspan='2'>Month's Income</th><th colspan='2'>Month's Expenses</th><th>Ending Fund Balance</th></tr>";
$totOpen =0;
$totInc =0;
$totExp=0;
$totEnd=0;
foreach($data[4] as $key => $value):
	if($key<1000&&$key>99){
            echo "<tr>";
            echo "<td colspan='2' style='text-align:left;'>R".$key."</td><td colspan='2'>".number_format($value['bf'],2)."</td>";
            echo "<td colspan='2'>".number_format($value['inc'],2)."</td><td colspan='2'>".number_format($value['exp'],2)."</td><td>".number_format($value['end'],2)."</td><input type='hidden' name='endFunds[".$key."]' id='endFunds[".$key."]' value='".$value['end']."'/>";
            echo "</tr>";
           
            $totOpen+=$value['bf'];
            $totInc+=$value['inc'];
            $totExp+=$value['exp'];
            $totEnd+=$value['end'];
	}
endforeach;


echo "<tr><td colspan='2'><b>Total</b></td><td colspan='2' id='beginTotals' class='Totals'>".number_format($totOpen,2)."</td><td colspan='2' id='incomeTotals' class='Totals'>".number_format($totInc,2)."</td><td colspan='2' id='expTotals' class='Totals'>".number_format($totExp,2)."</td><td id='balTotals' class='Totals'>".number_format($totEnd,2)."</td></tr>";

echo "<tr><th colspan='5' rowspan='7'>";
    echo "<table>";
    echo "<tr><th>1.2. DETAILS OF NON-COMPASSION INCOME ".Resources::img("unreject.png",array("title"=>'Add Details'))."</th><th>AMOUNT</th></tr>";
    echo "<tr><td>1.2. TOTAL NON COMPASSION FUNDS INCOME: </td><td>&nbsp;</td></tr>";
    echo "</table>";
echo "</th><th colspan='4'>1.3. PROOF OF CASH BALANCE</th></tr>";
echo "<tr><td colspan='2'>Cash at Bank</td><td colspan='2'>".number_format($data[2],2)."</td></tr>";
echo "<tr><td colspan='2'>Petty Cash</td><td colspan='2'>".number_format($data[3],2)."</td></tr>";
echo "<tr><td colspan='2'>Total</td><td colspan='2' class='Totals' id='cashBal'>".number_format($data[5],2)."</td></tr>";
echo "<tr><th colspan='4'>Accuracy Validation</th></tr>";
$validation = $totEnd-$data[5];
if($validation!==0){
	$style="background-color:red;color:white;font-weight:bold;";
}else{
	$style="background-color:green;color:white;font-weight:bold;";
}
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='2' style='".$style."'>".number_format($validation,2)."</td></tr>";
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>";



echo "<tr><td colspan='4'>";
    echo "<table id='transTbl' style='white-space:nowrap;'>";
        echo "<tr><th colspan='3'>C: DEPOSIT IN TRANSIT ".Resources::a_href("Finance/mfr",Resources::img("plus.png",array('title'=>'validate')))."</th></tr>";
        echo "<tr><th>Action</th><th>DATE</th><th>DETAILS</th><th>AMOUNT</th></tr>";
        foreach($data[6] as $value){
        	echo "<tr><td>".Resources::img("uncheck3.png",array("style"=>"cursor:pointer;","title"=>"Clear - {$value->VNumber}","onclick"=>'clearDepInTransit("'.$value->hID.'",this);'))."</td><td>".$value->TDate."</td><td>".substr($value->TDescription,0,12)."</td><td>".$value->totals."</td></tr>";
        	$sum_dep_in_transit+=$value->totals; 
		}
        echo "<tr><td colspan='3'><b>TOTAL DEPOSIT IN TRANSIT</b></td><td class='Totals'>".$sum_dep_in_transit."</td></tr>";
    echo "</table>";
echo "</td><td colspan='5'>";
    echo "<table style='white-space:nowrap;' id='ocTbl'>";
        echo "<tr><th colspan='3'>D: OUSTANDING (UNPRESENTED) CHEQUES ".Resources::a_href("Finance/mfr",Resources::img("plus.png",array('title'=>'validate')))."</th></tr>";
        echo "<tr><th>Action</th><th>DATE</th><td>CHEQUE No.</th><th>DETAILS</th><th>AMOUNT</th></tr>";
        foreach ($data[7] as $value) {
            echo "<tr><td>".Resources::img("uncheck3.png",array("style"=>"cursor:pointer;","title"=>"Clear - {$value->VNumber}","onclick"=>'clearDepInTransit("'.$value->hID.'",this);'))."</td><td>".$value->TDate."</td><td>".$value->ChqNo."</td><td>".substr($value->TDescription,0,12)."</td><td>".$value->totals."</td></tr>";
        	$sum_oc+=$value->totals;
		}
        echo "<tr><td colspan='4'><b>TOTAL OUTSTANDING CHEQUES</b></td><td class='Totals'>".$sum_oc."</td></tr>";
    echo "</table>";
echo "</td></tr>";


echo "<tr><th colspan='9'>1.3.3. BANK RECONCILIATION</th></tr>";
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='1'>&nbsp;</td><td colspan='3'>BANK ACCOUNT 1</td><td colspan='3'>BANK ACCOUNT 2</td></tr>";
echo "<tr><td style='width:10px;'>A.</td><td colspan='2'>Date On the Bank Statement</td><td colspan='3'><input type='text' name='statementDate' id='statementDate' readonly/></td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>B.</td><td colspan='2'>Balance Per Bank Statement</td><td colspan='3'><input type='text' id='statementAmount' name='statementAmount' onkeyup='updateBankBal();'/></td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>C.</td><td colspan='2'><b>Plus:</b> Deposit In Transit</td><td colspan='3' id='depTrans'>".$sum_dep_in_transit."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>D.</td><td colspan='2'><b>Less: </b>Oustanding Cheques</td><td colspan='3' id='oc'>".$sum_oc."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td style='width:10px;'>B+C-D.</td><td colspan='2'><b>ADJUSTED BANK BALANCE TOTAL</b></td><td colspan='3'><input type='text' id='adjBank' name='adjBank' readonly/> </td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
echo "<tr><td colspan='3'><b>VALIDATION</b></td><td colspan='2' id='bankReconValidation'>0.00</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";

/**
echo "<tr><td colspan='9'>";
    echo "<table>";
        echo "<tr><th colspan='5'>4: CIV FUND BALANCE BREAKDOWN  ".Resources::img("unreject.png")."</th></tr>";
        echo "<tr><th>Month</th><th colspan='2'>Expense Details</th><th colspan='2'>Beneficiaries</th><th colspan='2'>Amount</th><th colspan='2'>Comment</th></tr>";
    echo "</table>";
echo "</td></tr>";
 * 
 */
echo "<tr><td colspan='9'>";

	echo "<table style='white-space:nowrap;'>";
		echo "<tr><th colspan='7'>5: MONTHLY EXPENSE REPORT</th></tr>";
		echo "<tr><th>Acc.</th><th>Expense Item</th><th>Actual Expense <br>for the month</th><th>Actual Expense<br> To Date</th><th>Budget To Date</th><th>Variance</th><th>Variance (%)</th></tr>";
		$totCur=0;
		$totAccum=0;
		$totBud=0;
		$totVar=0;
		$totVarPer=0;
		foreach ($data[8] as $key => $value) {
		if($key<100){
				$totCur+=$value['cur'];	
				$totAccum+=$value['accum'];
				$totBud+=$value['bud'];
				
				echo "<tr><td>E".$key."</td><td>".$value['item']."</td><td style='text-align:right;'>".number_format($value['cur'],2)."</td><td style='text-align:right;'>".number_format($value['accum'],2)."</td><td style='text-align:right;'>".number_format($value['bud'],2)."</td><td style='text-align:right;'>".number_format($value['var'],2)."</td><td style='text-align:right;'>".number_format($value['varPer'])."%</td></tr>";
		}
		}
		$totVar=$totBud-$totAccum;
		$totVarPer=($totVar/$totBud)*100;
		echo "<tr><th>E100</th><th>Total Program Expense (10-90)</th><th class='Totals'>".number_format($totCur,2)."</th><th class='Totals'>".number_format($totAccum,2)."</th><th class='Totals'>".number_format($totBud,2)."</th><th class='Totals'>".number_format($totVar,2)."</th><th class='Totals'>".number_format($totVarPer)."%</th></tr>";
		$grandCur=0;
		$grandAccum=0;
		foreach ($data[8] as $key => $value) {
		if($key>1000&&$key<2000){
			$accNo = $key-1000;
			$grandCur+=$value['cur'];
			$grandAccum+=$value['accum'];
			echo "<tr><td>E".$key."</td><td>".$value['item']."</td><td style='text-align:right;'>".number_format($value['cur'],2)."</td><td style='text-align:right;'>".number_format($value['accum'],2)."</td><td style='text-align:right;'>XXXXXXXXXX</td><td style='text-align:right;'>XXXXXXXXXX</td><td style='text-align:right;'>XXXXXXXXXX</td></tr>";
		}
		}
		$grandCur=$grandCur+$totCur;
		$grandAccum=$grandAccum+$totAccum;
		echo "<tr><th>E1000</th><th>Total Month's Expenses</th><th class='Totals'>".number_format($grandCur,2)."</th><th class='Totals'>".number_format($grandAccum,2)."</th><th class='Totals'>".number_format($totBud,2)."</th><th class='Totals'>".number_format($totVar,2)."</th><th class='Totals'>".number_format($totVarPer)."%</th></tr>";
	echo "</table>";
echo "<td></tr>";
echo "<tr><td colspan='9' style='text-align:left;font-weight:bold;'>Upload Bank Statement: <input type='file' id='fileBs' name='fileBs'/></td></tr>";
echo "</table>";

echo "</form>";
if($data[0]===0){
	echo "<button onclick='submitMfr(\"frmMfr\");'>Submit</button>";
}elseif(Resources::session()->userlevel===2){
	echo "<button>Validate</button>";
}
echo "</div>";         