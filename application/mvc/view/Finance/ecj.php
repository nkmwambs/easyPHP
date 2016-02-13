<?php 
//print_r($data[0]);
//print($data[6]);
echo "<br>";
if(isset($data[4])){
	$curSelect=date('F-Y',$data[4]);
	$cur = $data[4];
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}
    
	echo "<button onclick='selectCJ(\"".strtotime('-1 month',$cur)."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectCJ(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectCJ(\"".strtotime('+1 month',$cur)."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";
    echo "<input type='hidden' id='icpNo' name='icpNo' value='".$data[5]."'/>";
     //An array of the used accounts  
    $count=0;
    $dis_arr=array();
      foreach($data[1] as $cnt){
            foreach($data[0] as $ins){
                $prop = "Ac".$ins->AccNo;
                if(isset($cnt->$prop)){
                    $count=1;
                    $dis_arr[$prop]=$count;
                }
                
        }
    }
    //print_r($dis_arr);
    //Setting colspan for the Expense and Income Header
    $income=0;
    $expense=0;
    foreach($data[0] as $span){
        if($span->AccGrp==='1'&& array_key_exists("Ac".$span->AccNo, $dis_arr)){
            $income++;
        }elseif($span->AccGrp==='0'&& array_key_exists("Ac".$span->AccNo, $dis_arr)){
            $expense++;
        }
    }
    
    foreach($data[1] as $int):
        $new_arr[]=(array)$int;
    endforeach;
    if(!empty($new_arr)){
    foreach($new_arr as $inner):
        $get_num[]=  array_filter($inner,"is_numeric");
    endforeach;
    }
    
    //print_r($get_num);

    echo Resources::img("print.png",array("onclick"=>'printData("ecj");',"title"=>"Print","id"=>"printecj"));
?>
<button id='' onclick="excelexport()">Export</button>

<div id='rst'>

<table id="ecj" border='1'>
    <caption><b>COMPASSION ASSISTED PROJECT - PROGRAM IMPLEMENTING CHURCH PARTNER <br> CASH JOURNAL FOR CHILD DEVELOPMENT CENTRE</b></caption>
    <?php
        for($i=0;$i<sizeof($data[0])+12;$i++){
            echo "<col>";
        }
    ?>
    <thead>
        <tr><th style="text-align:right;" colspan="3">ICP: </th><th  style="text-align:left;background-color: honeydew;" colspan="5"><?php echo $data[5]; ?></th><th>Month:</th><th style="background-color: honeydew;"><?php echo date('F',strtotime($curSelect)); ?></th><th>Year: </th><th style="background-color: honeydew;"><?php echo date('Y',strtotime($curSelect)); ?></th>
            
            <?php
                if(!empty($dis_arr)){echo "<th style='text-align:left;' colspan='".$income."'>INCOME</th></th><th style='text-align:left;' colspan='".$expense."'>EXPENSES</th>";}
            ?>
            </tr> <!-- End Row 1 -->
        
        <tr><th rowspan="2">CHQ/DEP</th><th rowspan="2">DATE</th><th rowspan="2">SOURCE/ PAYE</th><th rowspan="2">VOUCHER No</th><th rowspan="2">DESCRIPTION/ DETAILS</th><th colspan="4">BANK</th><th colspan="3">PETTY CASH</th>
         <?php 
        foreach($data[0] as $hdr):      
            $class_one = "Ac".$hdr->AccNo;
            if(array_key_exists($class_one, $dis_arr)){echo "<th class='".$class_one."' title='".$hdr->AccName."'>".substr($hdr->AccName,0,10)."</th>";}
        endforeach;
            
        ?>        
        </tr><!-- End Row 2 -->
        
        <tr><th rowspan="2">CHQ No</th><th>DEPOSITS</th><th>PAYMENTS</th><th>BALANCE</th><th>DEPOSITS</th><th>PAYMENTS</th><th>BALANCE</th>
        <?php 
        foreach($data[0] as $hdr):
            $class_two = "Ac".$hdr->AccNo;
            if(array_key_exists($class_two, $dis_arr)){echo "<th class='".$class_two."'>{$hdr->AccText}</th>";}
        endforeach;
            
        ?>
        </tr><!-- End Row 3 -->
        
        <tr><th colspan="5">&nbsp;</th><th>Kshs.</th><th>Kshs.</th><th>Kshs.</th><th>Kshs.</th><th>Kshs.</th><th>Kshs.</th>
            <?php 
            foreach($data[0] as $hdr):
                $class_three = "Ac".$hdr->AccNo;
                if(array_key_exists($class_three, $dis_arr)){echo "<th class='".$class_three."'>Kshs.</th>";}
            endforeach;
            ?>
        </tr><!-- End Row 5 -->
        
        <tr><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;"><?php echo date('F',strtotime($curSelect)); ?></th><th style="background-color: honeydew;"><?php echo date('Y',strtotime($curSelect)); ?></th><th>Totals:</th><th>&nbsp;</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th>
        <?php 
            foreach($data[0] as $hdr):
                $class_four = "Ac".$hdr->AccNo;
                if(array_key_exists($class_four, $dis_arr)){echo "<th class='".$class_four."' style='background-color: honeydew;'></th>";}
            endforeach;
            ?>            
        
        </tr><!-- End Row 6 -->
        
        <tr><th>&nbsp;</th><th>&nbsp;</th><th>Bank & Cash</th><th colspan="2">Balance Brought Forward</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;" id='balBcBf'><?php echo $data[2];?></th><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;" id='balPcBf'><?php echo $data[3];?></th>
           
            <?php 
                if(!empty($dis_arr)){echo "<th colspan='".count($data[0])."'>&nbsp;</th>";}
            ?>
        
        </tr><!-- End Row 7 -->
  
    </thead>
    <tbody>
        <?php
            foreach($data[1] as $arr):
				$rwChq=explode("-",$arr->ChqNo);
                if(Resources::session()->userlevel==='1'&&$arr->editable==='1'){
                	echo "<tr><td>{$arr->VType} ".Resources::img('editplain.png',array("title"=>"Edit Voucher","onclick"=>"voucheredit(\"".Resources::session()->userlevel."\",\"".Resources::session()->fname."\",\"".$arr->VNumber."\",\"".$arr->TDate."\",\"".$arr->Payee."\",\"".$arr->Address."\",\"".$arr->VType."\",\"".$arr->TDescription."\",\"".$arr->ChqNo."\")"))."</td><td>{$arr->TDate}</td><td title='".$arr->Payee."'>".substr($arr->Payee,0,20)."</td><td onmouseover='winpopon()'  onmouseout='winpopoff()'>".Resources::a_href("Finance/showVoucher/VNumber/".$arr->VNumber."/public/0",$arr->VNumber)."</td><td title='".$arr->TDescription."'>". substr($arr->TDescription,0,20)."</td><td>".$rwChq[0]."</td>";
                }elseif(Resources::session()->userlevel==='2'&&$arr->editable==='0'){
                	echo "<tr><td>{$arr->VType} ".Resources::img('editplain.png',array("title"=>"Allow Edit Voucher","onclick"=>"allowvoucheredit(this,\"".$data[5]."\",\"".$arr->VNumber."\")"))."</td><td>{$arr->TDate}</td><td title='".$arr->Payee."'>".substr($arr->Payee,0,20)."</td><td onmouseover='winpopon()'  onmouseout='winpopoff()'>".Resources::a_href("Finance/showVoucher/VNumber/".$arr->VNumber."/public/0",$arr->VNumber)."</td><td title='".$arr->TDescription."'>". substr($arr->TDescription,0,20)."</td><td>".$rwChq[0]."</td>";
                }else{
                	echo "<tr><td>{$arr->VType}</td><td>{$arr->TDate}</td><td title='".$arr->Payee."'>".substr($arr->Payee,0,20)."</td><td onmouseover='winpopon()'  onmouseout='winpopoff()'>".Resources::a_href("Finance/showVoucher/VNumber/".$arr->VNumber."/public/0",$arr->VNumber)."</td><td title='".$arr->TDescription."'>". substr($arr->TDescription,0,20)."</td><td>".$rwChq[0]."</td>";
                }	
                
                //Bank Income
                if($arr->VType==="CR"||$arr->VType==="PCR")
                	{
                		echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";
					}
				//Bank Expense
                if($arr->VType==="CHQ")
                	{
                		echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";
					}
				//Bank Balances		
                echo "<td>&nbsp;</td>";
				
				//PC Income
                if($arr->VType==="CHQ"&&(isset($arr->Ac2000)||isset($arr->Ac2001)))
                	{
                		echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";
					}
				
				//PC Expense
                if($arr->VType==="PC"||$arr->VType==="PCR")
                	{
                		echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";
                	}
				
				//PC Balance
                echo "<td>&nbsp;</td>";//1st 12 columns
                
                
                //Spread                
                foreach($data[0] as $vals):
                    $acc = "Ac".$vals->AccNo;
                   if(isset($arr->$acc))
                   	{
                   		echo "<td class='".$acc."'>{$arr->$acc}</td>";
                   	}
                   	elseif(array_key_exists($acc, $dis_arr)) 
                   	{
                   		echo "<td class='".$acc."'>&nbsp;</td>";
					} 
                endforeach;                
                echo "</tr>";
            endforeach;
            
        ?>
    </tbody>
</table>

</div>

<br><br>
<b>Current Month's Footnotes</b>
<?php
if(!empty($data[7])){
	foreach($data[7] as $val):
		echo "<br><b>{$val}</b><br>";
		foreach($data[6] as $value):
			if($value->VNumber===$val){
				echo "<div class='footnotes_header'>{$value->msg_from}  post for Voucher Number {$value->VNumber}: <i>Posted on {$value->stmp}</i></div><br>";
				echo "<div class='footnotes_body'>{$value->msg}</div>";
			}
		endforeach;
	endforeach;	
}else{
	echo "<br><br><div id='error_div'>No Footnotes for this month Available</div><br><br>";
}
