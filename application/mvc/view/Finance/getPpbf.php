<?php
//print_r($data[1]);
$planType=array("Annual Budget","Supplementary Budget");
echo a_tag("Finance/ppbf","<button>View Plans</button>")."<br>";
echo "<table id='tblPlan'>";
echo "<caption><b>".$data[1][0]->icpNo." FY".$data[1][0]->fy." ".$planType[$data[1][0]->planType-1]."</b></caption>";
echo "<tr><th rowspan='2'>Account Name</th><th rowspan='2'>Account Code</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th rowspan='2'>Account Total</th></tr>";
echo "<tr><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th></tr>";
$months_db_flds= array("JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt");
$cnt=0;
if(is_array($data[1])&&!empty($data[1])){
    foreach($data[0] as $acc):
        $cnt++;
    echo "<tr>";
                if($acc->prg==='1'){$style="style='background-color:green;'";}else{$style="";}
                    echo "<td $style>$acc->AccName</td><td $style>$acc->AccText</td>";   
                        //echo "<input type='hidden' name='planType[]' class='planType' id='planType_".$acc->AccNo."'/>";
                        //echo "<input type='hidden' name='fy[]' class='fy' id='fy_".$acc->AccNo."'/>";
                        //echo "<input type='hidden' name='icpNo[]' class='icpNo' id='icpNo_".$acc->AccNo."' value='".$_SESSION['username']."'/>";
                        //echo "<input type='hidden' class='AccNo' name='AccNo[]' id='AccNo_".$acc->AccNo."' value='".$acc->AccNo."'/>";
                for($i=0;$i<12;$i++){
                        echo "<td title='".$acc->AccText."' id='".$months_db_flds[$i]."_".$acc->AccNo."' $style>".$data[1][$cnt-1]->$months_db_flds[$i]."</td>";
                }
    echo "<td $style>".$data[1][$cnt-1]->AccTotals."</td></tr>";    
    endforeach;
}  else {
echo "<tr><td colspan='15'>Data not Available!</td></tr>";    
}

echo "</table>";
