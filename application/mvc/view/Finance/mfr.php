<?php
if(is_array($data)){
	print_r($data['test']);
}else{
	print($data['test']);
}


if(isset($data['time'])){
	$curSelect=date('F-Y',$data['time']);
	$cur = $data['time'];
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}
    
	echo "<button onclick='selectMFR(\"".strtotime('-1 month',$cur)."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectMFR(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectMFR(\"".strtotime('+1 month',$cur)."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";


echo "<form id='frmMfr'>";
echo "<table id='tblMfr' style='text-align:right;'>";
echo "<caption>COMPASSION INTERNATION KENYA<BR>IMPLEMENTING CHURCH PARTNERS<BR>MONTHLY FINANCIAL REPORT";
	echo "<br><br><div id='error_div'>Report Status: ";
	    if($data['state']===0){
	    	echo "Report Not Submitted";
	    }elseif($data['state']===1){
	    	echo "Report Submitted (Awaiting PF Validation)";
	    }elseif($data['state']===2){
	    	echo "Report submitted and validated by PF";
	    }
    echo "</div><br></caption>";
echo "<tr><th colspan='6'>1. PROJECT NAME: {$_SESSION['username']} - {$_SESSION['lname']}</th><th>Date</th><th colspan='2'>".date("d-m-Y")."<input type='hidden' id='curDate' name='curDate' value='".date("Y-m-d")."'/></th></tr>";
echo "<tr><th colspan='6'>CDC FINANCE REPORT FOR THE MONTH OF: </th><th>".date("F")."</th><th>YEAR</th><th>".date("Y")."</th></tr>";

//Funds Balance Report

echo "<tr><th colspan='9'>2. FUNDS BALANCE REPORT</th></tr>";

echo "<tr><th colspan='2'>Fund</th><th colspan='2'>Beginning Balance</th><th colspan='2'>Month's Income</th><th colspan='2'>Month's Expenses</th><th>Ending Fund Balance</th></tr>";
$totOpen =0;
$totInc =0;
$totExp=0;
$totEnd=0;
foreach($data['balbf'] as $key => $value):
	
            echo "<tr>";
            echo "<td colspan='2' style='text-align:left;'>R".$key."</td><td colspan='2'>".number_format($data['balbf'][$key],2)."</td>";
            echo "<td colspan='2'>".number_format($data['inc'][$key],2)."</td><td colspan='2'>".number_format($data['exp'][$key],2)."</td><td>".number_format($data['bal'][$key],2)."</td><input type='hidden' name='endFunds[".$key."]' id='endFunds[".$key."]' value='".$data['bal'][$key]."'/>";
            echo "</tr>";
           
            $totOpen+=$data['balbf'][$key];
            $totInc+=$data['inc'][$key];
            $totExp+=$data['exp'][$key];
            $totEnd+=$data['bal'][$key];
endforeach;


echo "<tr><td colspan='2'><b>Total</b></td><td colspan='2' id='beginTotals' class='Totals'>".number_format($totOpen,2)."</td><td colspan='2' id='incomeTotals' class='Totals'>".number_format($totInc,2)."</td><td colspan='2' id='expTotals' class='Totals'>".number_format($totExp,2)."</td><td id='balTotals' class='Totals'>".number_format($totEnd,2)."</td></tr>";

//Non Compassion Funds Breakdown Cell

echo "<tr><th colspan='4' rowspan='7'>";
    echo "<table>";
    echo "<tr><th>1.2. DETAILS OF NON-COMPASSION INCOME ".Resources::img("unreject.png",array("title"=>'Add Details'))."</th><th>AMOUNT</th></tr>";
    echo "<tr><td>1.2. TOTAL NON COMPASSION FUNDS INCOME: </td><td>&nbsp;</td></tr>";
    echo "</table>";

//Proof of Cash and validation Cell
	
echo "</th><th colspan='5'>1.3. PROOF OF CASH BALANCE</th></tr>";
echo "<tr><td colspan='3'>Cash at Bank</td><td colspan='2' id='bankBal'>".number_format($data['bank'],2)."</td><input type='hidden' value='".$data['bank']."' id='bankTxt' name='bankTxt'/></tr>";
echo "<tr><td colspan='3'>Petty Cash</td><td colspan='2'>".number_format($data['pc'],2)."</td><input type='hidden' value='".$data['pc']."' id='pcbTxt' name='pcbTxt'/></tr>";
$totCash=$data['bank']+$data['pc'];
echo "<tr><td colspan='3'>Total</td><td colspan='2' class='Totals' id='cashBal'>".number_format($totCash,2)."</td></tr>";
echo "<tr><th colspan='5'>Accuracy Validation</th></tr>";
$validation = $totEnd-$totCash;
if(number_format($validation,2)!=='0.00'){
	$style="background-color:red;color:white;font-weight:bold;";
}else{
	$style="background-color:green;color:white;font-weight:bold;";
}
echo "<tr><td colspan='3'>&nbsp;</td><td colspan='2' style='".$style."' id='cashValidate'>".number_format($validation,2)."</td></tr>";
echo "<tr><td colspan='3'>&nbsp;</td><td colspan='2'>&nbsp;</td></tr>";


//Deposit in transit Cell

echo "<tr><td colspan='4'>";
    echo "<table id='transTbl' class='subTbl' style='white-space:nowrap;'>";
        echo "<tr><th colspan='4'>C: DEPOSIT IN TRANSIT ".Resources::a_href("Finance/mfr",Resources::img("plus.png",array('title'=>'validate')))."</th></tr>";
        echo "<tr><th>Action</th><th>DATE</th><th>DETAILS</th><th>AMOUNT</th></tr>";
        $sum_dep_in_transit=0;
        foreach($data['transit'] as $value){
        	if($data['state']===0){
        			echo "<tr><td>".Resources::img("uncheck3.png",array("style"=>"cursor:pointer;","title"=>"Clear - {$value['VNumber']}","onclick"=>'clearDepInTransit("'.$value['rId'].'","'.$value['source'].'","dep",this);'))."</td><td>".$value['TDate']."</td><td>".substr($value['Details'],0,12)."</td><td style='text-align:right;'>".number_format($value['Amount'],2)."</td></tr>";
        	}else{
        		echo "<tr><td>".Resources::img("unreject.png",array("style"=>"cursor:pointer;"))."</td><td>".$value['TDate']."</td><td>".substr($value['Details'],0,12)."</td><td style='text-align:right;'>".number_format($value['Amount'],2)."</td></tr>";
        	}
        	$sum_dep_in_transit+=$value['Amount']; 
		}
        echo "<tr><td colspan='3'><b>TOTAL DEPOSIT IN TRANSIT</b></td><td class='Totals' style='text-align:right;'>".number_format($sum_dep_in_transit,2)."</td></tr>";
    echo "</table></td>";

//Outstanding Cheques Table Cell
    
echo "<td colspan='5'>";
    echo "<table  class='subTbl' style='white-space:nowrap;' id='ocTbl'>";
        echo "<tr><th colspan='5'>D: OUSTANDING (UNPRESENTED) CHEQUES ".Resources::a_href("Finance/mfr",Resources::img("plus.png",array('title'=>'validate')))."</th></tr>";
        echo "<tr><th>Action</th><th>DATE</th><th>CHEQUE No.</th><th>DETAILS</th><th>AMOUNT</th></tr>";
        $sum_oc=0;
        foreach ($data['oc'] as $value) {
        	if($data['state']===0){
            	echo "<tr><td>".Resources::img("uncheck3.png",array("style"=>"cursor:pointer;","title"=>"Clear - {$value['VNumber']}","onclick"=>'clearDepInTransit("'.$value['rId'].'","'.$value['source'].'","oc",this);'))."</td><td>".$value['TDate']."</td><td>".$value['ChqNo']."</td><td>".substr($value['Details'],0,12)."</td><td style='text-align:right;'>".number_format($value['Amount'],2)."</td></tr>";
            }else{
            	echo "<tr><td>".Resources::img("unreject.png",array("style"=>"cursor:pointer;"))."</td><td>".$value['TDate']."</td><td>".$value['ChqNo']."</td><td>".substr($value['Details'],0,12)."</td><td style='text-align:right;'>".number_format($value['Amount'],2)."</td></tr>";	
            }
        	$sum_oc+=$value['Amount'];
		}
        echo "<tr><td colspan='4'><b>TOTAL OUTSTANDING CHEQUES</b></td><td class='Totals' style='text-align:right;'>".number_format($sum_oc,2)."</td></tr>";
    echo "</table>";
echo "</td></tr>";


//Bank Reconciliation
echo "<tr><th colspan='9'>1.3.3. BANK RECONCILIATION</th></tr>";
echo "<tr><td colspan='2'>&nbsp;</td><td colspan='1'>&nbsp;</td><td colspan='3'>BANK ACCOUNT 1</td><td colspan='3'>BANK ACCOUNT 2</td></tr>";
if($data['state']===0){
	echo "<tr><td style='width:10px;'>A.</td><td colspan='2'>Date On the Bank Statement</td><td colspan='3'><input class='statementFlds' type='text' name='statementDate' id='statementDate' value='".$data['statementDate']."' readonly/></td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>B.</td><td colspan='2'>Balance Per Bank Statement</td><td colspan='3'><input class='statementFlds' type='text' id='statementAmount'  value='".$data['statementAmount']."'  name='statementAmount' onkeyup='updateBankBal();'/></td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>C.</td><td colspan='2'><b>Plus:</b> Deposit In Transit</td><td colspan='3' id='depTrans'>".$sum_dep_in_transit."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>D.</td><td colspan='2'><b>Less: </b>Oustanding Cheques</td><td colspan='3' id='oc'>".$sum_oc."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>B+C-D.</td><td colspan='2'><b>ADJUSTED BANK BALANCE TOTAL</b></td><td colspan='3' id='adjBank' class='Totals'></td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td colspan='3'><b>VALIDATION</b></td><td colspan='2' id='bankReconValidation'></td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
}else{
	echo "<tr><td style='width:10px;'>A.</td><td colspan='2'>Date On the Bank Statement</td><td colspan='3'>".$data['statementDate']."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>B.</td><td colspan='2'>Balance Per Bank Statement</td><td colspan='3'>".number_format($data['statementAmount'],2)."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>C.</td><td colspan='2'><b>Plus:</b> Deposit In Transit</td><td colspan='3' id='depTrans'>".number_format($sum_dep_in_transit,2)."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td style='width:10px;'>D.</td><td colspan='2'><b>Less: </b>Oustanding Cheques</td><td colspan='3' id='oc'>".number_format($sum_oc,2)."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	$adjBank = $data['statementAmount']+$sum_dep_in_transit-$sum_oc;
	$validate=$data['bank']-$adjBank;
	if($validate!==0.00){
	$style="background-color:red;color:white;font-weight:bold;";
	}else{
		$style="background-color:green;color:white;font-weight:bold;";
	}
	echo "<tr><td style='width:10px;'>B+C-D.</td><td colspan='2'><b>ADJUSTED BANK BALANCE TOTAL</b></td><td colspan='3' id='adjBank' class='Totals'>".number_format($adjBank,2)."</td><td colspan='1'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
	echo "<tr><td colspan='3'><b>VALIDATION</b></td><td colspan='2' id='bankReconValidation' style='".$style."'>".number_format($validate,2)."</td><td colspan='2'>&nbsp;</td><td colspan='2'>&nbsp;</td><tr>";
}
//Monthly Expense Report

echo "<tr><td colspan='9'>";

	echo "<table  class='subTbl'  style='white-space:nowrap;'>";
		echo "<tr><th colspan='7'>5: MONTHLY EXPENSE REPORT</th></tr>";
		echo "<tr><th>Acc.</th><th>Expense Item</th><th>Actual Expense <br>for the month</th><th>Actual Expense<br> To Date</th><th>Budget To Date</th><th>Variance</th><th>Variance (%)</th></tr>";
		$totCur=0;
		$totAccum=0;
		$totBud=0;
		$totVar=0;
		$totVarPer=0;
		foreach ($data['expenses'] as $key => $value) {
		if($key<100){
				$totCur+=$value['Exp'];	
				$totAccum+=$value['ExpToDate'];
				$totBud+=$value['BudToDate'];
				
				echo "<tr><td>E".$key."</td><td>".$value[1]."</td><td style='text-align:right;'>".number_format($value['Exp'],2)."</td><td style='text-align:right;'>".number_format($value['ExpToDate'],2)."</td><td style='text-align:right;'>".number_format($value['BudToDate'],2)."</td><td style='text-align:right;'>".number_format($value['var'],2)."</td><td style='text-align:right;'>".number_format($value['varPer'])."%</td></tr>";
		}
		}
		$totVar=$totBud-$totAccum;
		$totVarPer=($totVar/$totBud)*100;
		echo "<tr><th>E100</th><th>Total Program Expense (10-90)</th><th class='Totals'>".number_format($totCur,2)."</th><th class='Totals'>".number_format($totAccum,2)."</th><th class='Totals'>".number_format($totBud,2)."</th><th class='Totals'>".number_format($totVar,2)."</th><th class='Totals'>".number_format($totVarPer)."%</th></tr>";
		$grandCur=0;
		$grandAccum=0;
		foreach ($data['expenses'] as $key => $value) {
		if($key>1000&&$key<2000){
			$accNo = $key-1000;
			$grandCur+=$value['Exp'];
			$grandAccum+=$value['ExpToDate'];
			$acc = $key-1000;
			echo "<tr><td>E".$acc."</td><td>".$value[1]."</td><td style='text-align:right;'>".number_format($value['Exp'],2)."</td><td style='text-align:right;'>".number_format($value['ExpToDate'],2)."</td><td style='text-align:right;'>XXXXXXXXXX</td><td style='text-align:right;'>XXXXXXXXXX</td><td style='text-align:right;'>XXXXXXXXXX</td></tr>";
		}
		}
		$grandCur=$grandCur+$totCur;
		$grandAccum=$grandAccum+$totAccum;
		echo "<tr><th>E1000</th><th>Total Month's Expenses</th><th class='Totals'>".number_format($grandCur,2)."</th><th class='Totals'>".number_format($grandAccum,2)."</th><th class='Totals'>".number_format($totBud,2)."</th><th class='Totals'>".number_format($totVar,2)."</th><th class='Totals'>".number_format($totVarPer)."%</th></tr>";
	echo "</table>";
echo "</td></tr>";

//Variance Explanation

echo "<tr><td colspan='9'>";
	echo "<table  class='subTbl' style='white-space:nowrap;'>";
	echo "<tr><th colspan='3'>VARIANCE EXPLANATION</th></tr>";
	echo "<tr><th style='width:70px;'>Account</th><th style='width:70px;'>% Variance</th><th>Explanation</th></tr>";
	foreach($data['varExplain'] as $key=>$value){
		if($data['state']===0){
			echo "<tr><td>E".$key."</td><td>".number_format($value['varPer'])."%</td><td><textarea class='varExplain' cols='90' rows='3' style='overflow:auto;' id='explain[".$key."]' name='explain[".$key."]'></textarea></td></tr>";
		}else{
			echo "<tr><td>E".$key."</td><td>".number_format($value['varPer'])."%</td><td>".$value['notes']."</td></tr>";
		}	

	}
	echo "</table>";
echo "</td></tr>";


//Financial Ratios

echo "<tr><td colspan='9'>";
echo "<table class='subTbl' style='white-space:nowrap;'>";
echo "<tr><th colspan='6'>ICP CDC FINANCIAL PERFORMANCE PARAMETERS ANALYSIS FOR MONTH</th></tr>";
echo "<tr><th>Accum. Fund Ratio</th><th>Budget variance</th><th>Survival Ratio</th><th>Cash Balance</th><th>Operating Ratio</th><th>Reports</th></th></tr>";
echo "<tr><th>AFC<2</th><th>OBV<=10%</th><th>SR>6</th><th>PCB<Kes. 20,000</th><th>OR<30%</th><th>R=1</th></th></tr>";
echo "<tr><th>".number_format($data['param']['afc'],2)."</th><th>".number_format($data['param']['obv'])."%</th><th>".number_format($data['param']['sr'])."%</th><th>".number_format($data['param']['pcb'],2)."</th><th>".number_format($data['param']['or'])."%</th><th id='recon'>".number_format($data['param']['r'])."</th><input type='hidden' id='reconTxt' name='reconTxt' value='".$data['param']['r']."'/></tr>";
echo "</table>";
echo "</tr>";

//Bank Statement Upload
if($data['state']===0){
	echo "<tr><td colspan='9' style='text-align:left;font-weight:bold;'>Upload Bank Statement: <input type='file' id='fileBs' name='fileBs'/></td></tr>";
}else{
	echo "<tr><td colspan='9' style='text-align:left;font-weight:bold;'>Uploaded Bank Statements</td></tr>";	
	echo "<tr><td colspan='9' style='text-align:left;'>".Resources::a_href("",$data['getBs'][0]->bsKeys)."</td></tr>";	
}

//echo "<tr><td colspan='9'>&nbsp;</td></tr>";
echo "</table>";
echo "</form>";

if($data['state']===0){
	echo "<button onclick='submitMfr(\"frmMfr\");'>Submit</button>";
}elseif($data['state']===1&&Resources::session()->userlevel_backup==='2'){
	echo "<button onclick='validateMFR(\"".$data['stateID']."\");'>Validate</button>";
}

echo "</div>";
