<?php
if(isset($data[1])){
	$curSelect=date('F-Y',$data[1]);
	$cur = $data[1];
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}

echo Resources::a_href("Finance/viewHvcDisbursement/month/".$data[1],"[View HVC Disbursement]");
echo "<br><hr><br>";
echo "<br>";

    
	echo "<button onclick='selectSlip(\"".strtotime('-1 month',$cur)."\",\"".$data['2']."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectSlip(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectSlip(\"".strtotime('+1 month',$cur)."\",\"".$data['2']."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";
    
if(empty($data[0])){
	if(isset($data[1])){
		print("<br><br><div id='error_div'>Disbursement Slip for ".date('F-Y',$data[1])." is unavailable!</div><br>");
	}else{
		print("<br><br><div id='error_div'>Disbursement Slip for ".date('F-Y')." is unavailable!</div><br>");
	}
}else{
		//echo Resources::img("print.png",array("onclick"=>' printData("divSlipPrint")'))." ".Resources::img("previous.png")."".Resources::img("next.png");
		echo Resources::img("print.png",array("onclick"=>' printData("divSlipPrint")'));
		$sum = 0;
		echo "<div id='divSlipPrint' style='margin-bottom:20px;'>";
		echo "<table border='0' width='100%' align='center' id='slipPrint' style='border-style: hidden;margin-bottom:10px;'>";
		            echo "<tr><td class='removeBorder' colspan='3'></td></tr>";
		            echo "<tr><td class='removeBorder' colspan='3' align='center'><b>COMPASSION INTERNATIONAL<br>FUNDS DISBURSEMENT ADVICE</b></td></tr>";
		            echo "<tr><td class='removeBorder' colspan='3' align='center'>".Resources::img("logo.png")."</td></tr>";
		            echo "<tr><td class='removeBorder' colspan='3' align='center'><b>".$data[0][0]->KENumber."";
					
		            echo "<div style='position:relative; top:2%; left:30%;'>Month: ".date('M-Y',strtotime($data[0][0]->Month))."</div></b></td></tr>";
		          
				  echo "<tr><td style='font-weight:bold;' colspan='3'><hr></td></tr>";
				  
				    echo "<tr><td class='removeBorder' colspan='2'><b><i><u>Fund Description</u></i></b></td><td class='removeBorder'><b><i><u>Amount</u></i></b></td></tr>";
		            foreach($data[0] as $val):
		                echo "<tr><td colspan='2'>".$val->AccountDescription."</td><td>".number_format($val->Amount,2)."</td></tr>";  
		                $sum+=$val->Amount;
		            endforeach;
		            echo "<tr><td class='doubleLine' colspan='2'><b><i>Summary for ".$data[0][0]->KENumber."</i></b></td><td class='doubleLine'><b><i>".number_format($sum,2)."</i></b></td></tr>";
		            echo "<tr><td colspan='2'>Bank Charges-(charge to A/C 70)</td><td>";
		            if(($sum<1000000) AND ($sum!=0)){
		                $charge = -75;
		                $ex = 0.1*$charge; 
		                $tc = $charge+$ex;
		                $ta = $sum+$tc;
		                echo $charge;
		            }elseif($sum>1000000){
		                $charge = -225;
		                $ex = 0.1*$charge; 
		                $tc = $charge+$ex;
		                $ta = $sum+$tc;
		                echo $charge;
		            }else{
		                $charge = 0;
		                $ex = 0.1*$charge; 
		                $tc = $charge+$ex;
		                $ta = $sum+$tc;
		                echo $charge;    
		            }
		
		        echo"</td></tr>";
		        echo "<tr><td colspan='2'>Excise Duty-(charge to A/C 70)</td><td>".$ex."</td></tr>";
		        echo "<tr><td colspan='2'><b>Net Amount-(Confirm with Bank Statement)</b></td><td><b>".number_format($ta,2)."</b></td></tr>";
		        
		        echo "<tr><td style='font-weight:bold;' colspan='3'><hr></td></tr>";
				
		        echo "<tr><td style='font-weight:bold;' colspan='3'>Special Gifts</td></tr>";
		         echo "<tr><td style='font-weight:bold;'>Instruction</td><td style='font-weight:bold;'>Beneficiary Number</td><td style='font-weight:bold;'>Amount</td></tr>";
				
				$sum_gifts = 0;

		        foreach($data[3] as $gifts):
					$childNo = "-";
					
					if($gifts->ChildNumber!=='0'){
						$childNo = $gifts->ChildNumber; 
					}
					echo "<tr><td>".$gifts->Instructions."</td><td>".$childNo."</td><td>".number_format($gifts->Amount,2)."</td></tr>";
					$sum_gifts+=$gifts->Amount;
				endforeach;
				 echo "<tr><td style='font-weight:bold;' colspan='2'>Sum Special Gifts</td><td style='font-weight:bold;'>".number_format($sum_gifts,2)."</td></tr>";
		
		echo "<tr><td style='font-weight:bold;' colspan='3'><hr></td></tr>";
		
		echo "</table><br><br>";
		echo "<div><b><i>But you, keep your head in all situations,.....do the work,.....discharge all the duties of your ministry-II Tim 4:5</i></b></div>";
		echo "</div>";
}
//print_r($data[3]);
?>