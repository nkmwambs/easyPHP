<?php 
    $curSelect=date('F-Y');
    echo "<button onclick='selectCJ(\"".strtotime('-1 month')."\");'>".date('F-Y',  strtotime('-1 month'))."</button><button style='background-color:lightgreen;'  onclick='selectCJ(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectCJ(\"".strtotime('+1 month')."\");'>".  date('F-Y',  strtotime('+1 month'))."</button>";
    //print_r($data[0]);
    
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

<table id="ecj" border='1'>
    <caption><b>COMPASSION ASSISTED PROJECT - PROGRAM IMPLEMENTING CHURCH PARTNER <br> CASH JOURNAL FOR CHILD DEVELOPMENT CENTRE</b></caption>
    <?php
        for($i=0;$i<sizeof($data[0])+12;$i++){
            echo "<col>";
        }
    ?>
    <thead>
        <tr><th style="text-align:right;" colspan="3">ICP: </th><th  style="text-align:left;background-color: honeydew;" colspan="5"><?php echo $_SESSION['username_backup'] ?></th><th>Month:</th><th style="background-color: honeydew;"><?php echo date('F'); ?></th><th>Year: </th><th style="background-color: honeydew;"><?php echo date('Y'); ?></th>
            
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
        
        <tr><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;"><?php echo date('F'); ?></th><th style="background-color: honeydew;"><?php echo date('Y'); ?></th><th>Totals:</th><th>&nbsp;</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th><th style="background-color: honeydew;">0.00</th>
        <?php 
            foreach($data[0] as $hdr):
                $class_four = "Ac".$hdr->AccNo;
                if(array_key_exists($class_four, $dis_arr)){echo "<th class='".$class_four."' style='background-color: honeydew;'></th>";}
            endforeach;
            ?>            
        
        </tr><!-- End Row 6 -->
        
        <tr><th>&nbsp;</th><th>&nbsp;</th><th>Bank & Cash</th><th colspan="2">Balance Brought Forward</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;">348120</th><th>&nbsp;</th><th>&nbsp;</th><th style="background-color: honeydew;">2310</th>
           
            <?php 
                if(!empty($dis_arr)){echo "<th colspan='".count($data[0])."'>&nbsp;</th>";}
            ?>
        
        </tr><!-- End Row 7 -->
  
    </thead>
    <tbody>
        <?php
            foreach($data[1] as $arr):
				$rwChq=explode("-",$arr->ChqNo);
                echo "<tr><td>{$arr->VType}</td><td>{$arr->TDate}</td><td title='".$arr->Payee."'>".substr($arr->Payee,0,20)."</td><td>".Resources::a_href("Finance/showVoucher/VNumber/".$arr->VNumber."/public/0",$arr->VNumber)."</td><td title='".$arr->TDescription."'>". substr($arr->TDescription,0,20)."</td><td>".$rwChq[0]."</td>";
                //Bank Deposit
                if($arr->VType==="CR"){echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";}
                if($arr->VType==="CHQ"){echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";}
                echo "<td>&nbsp;</td>";
                if($arr->VType==="CHQ"&&(isset($arr->Ac2000)||isset($arr->Ac2001))){echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";}
                if($arr->VType==="PC"){echo "<td>".$arr->totals."</td>";}else{echo "<td>&nbsp;</td>";}
                echo "<td>&nbsp;</td>";//1st 12 cells
                
                foreach($data[0] as $vals):
                    $acc = "Ac".$vals->AccNo;
                   if(isset($arr->$acc)){echo "<td class='".$acc."'>{$arr->$acc}</td>";}elseif(array_key_exists($acc, $dis_arr)) {echo "<td class='".$acc."'>&nbsp;</td>";} 
                endforeach;                
                echo "</tr>";
            endforeach;
            
        ?>
    </tbody>
</table>