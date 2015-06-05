<?php
//print_r($data);
echo a_tag("Finance/ppbf","<button>View Plans</button>")." <button id='btnPostPlan' onclick='postNewPlan(\"frmNewPlan\");'>Post Plan</button><br><br><br>";
echo "Search Plan to Edit or Create:<br><br>";
echo "<label class='selLbl' for='planTypeSel'>Plan Type: </label><select id='planTypeSel' onchange='updatePlanFormFlds();'><option value=''>Select Type ... </option><option value='1'>Annual Plan</option><option value='2'>Supplementary Plan</option></select> <label class='selLbl' for='fySel'>Financial Year: </label><select onchange='updatePlanFormFlds();' id='fySel'><option value=''>Select Financial Year ... </option><option value='15'>FY15</option><option value='16'>FY16</option><option value='17'>FY17</option><option value='18'>FY18</option><option value='19'>FY19</option><option value='20'>FY20</option></select> ".img_tag("search.png",array("id"=>"searchglass","title"=>"Search Plan","onclick"=>'searchPlan();'))."<br><br>";

echo "<form id='frmNewPlan'>";
echo "<table id='tblNewPlan'>";
echo "<tr><th rowspan='2'>Account Name</th><th rowspan='2'>Account Code</th><th>Month 1</th><th>Month 2</th><th>Month 3</th><th>Month 4</th><th>Month 5</th><th>Month 6</th><th>Month 7</th><th>Month 8</th><th>Month 9</th><th>Month 10</th><th>Month 11</th><th>Month 12</th><th rowspan='2'>Account Total</th></tr>";
echo "<tr><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th></tr>";
$months_db_flds= array("JulAmt","AugAmt","SepAmt","OctAmt","NovAmt","DecAmt","JanAmt","FebAmt","MarAmt","AprAmt","MayAmt","JunAmt");
foreach($data as $acc):
echo "<tr>";
            if($acc->prg==='1'){$style="style='background-color:green;'";}else{$style="";}
                echo "<td $style>$acc->AccName</td><td $style>$acc->AccText</td>";   
                    echo "<input type='hidden' name='planType[]' class='planType' id='planType_".$acc->AccNo."'/>";
                    echo "<input type='hidden' name='fy[]' class='fy' id='fy_".$acc->AccNo."'/>";
                    echo "<input type='hidden' name='icpNo[]' class='icpNo' id='icpNo_".$acc->AccNo."' value='".$_SESSION['username']."'/>";
                    echo "<input type='hidden' class='AccNo' name='AccNo[]' id='AccNo_".$acc->AccNo."' value='".$acc->AccNo."'/>";
            for($i=0;$i<12;$i++){
                echo "<td $style><input onkeyup='calcPlanTotalPerAccount(this);'; title='".$acc->AccText."'; type='text' name='".$months_db_flds[$i]."[]' id='".$months_db_flds[$i]."_".$acc->AccNo."'/></td>";
            }
echo "<td $style><input type='text' name='AccTotals[]' id='AccTotals_".$acc->AccNo."' readonly/></td></tr>";    
endforeach;
echo "</table>";
echo "</form>";