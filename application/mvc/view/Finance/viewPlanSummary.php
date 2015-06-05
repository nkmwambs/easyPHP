<?php
echo "<br>";

echo "<table id='tblBudgetSummary' style='white-space:nowrap;text-align:right;'>";
echo "<caption><b>".$_SESSION['fname']."-".$_SESSION['lname']." FY".$data[4]." Approved Budget Summary</b></caption>";
echo "<tr><th>Account</th><th>Total</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th></tr>";
foreach ($data[0] as $accRec):
    echo "<tr><td style='text-align:left;'>$accRec->AccText - $accRec->AccName</td><td>$accRec->totalCost</td><td>".number_format($accRec->JulTot,2)."</td><td>".number_format($accRec->AugTot,2)."</td><td>".number_format($accRec->SepTot,2)."</td><td>".number_format($accRec->OctTot,2)."</td><td>".number_format($accRec->NovTot,2)."</td><td>".number_format($accRec->DecTot,2)."</td><td>".number_format($accRec->JanTot,2)."</td><td>".number_format($accRec->FebTot,2)."</td><td>".number_format($accRec->MarTot,2)."</td><td>".number_format ($accRec->AprTot,2)."</td><td>".number_format ($accRec->MayTot,2)."</td><td>".number_format ($accRec->JunTot,2)."</td></tr>";
endforeach;
echo "<tr><th>Totals:</th><th>".number_format($data[1]->totalCost,2)."</th><th>".number_format($data[1]->JulTot,2)."</th><th>".number_format($data[1]->AugTot,2)."</th><th>".number_format($data[1]->SepTot,2)."</th><th>".number_format($data[1]->OctTot,2)."</th><th>".number_format($data[1]->NovTot,2)."</th><th>".number_format($data[1]->DecTot,2)."</th><th>".number_format($data[1]->JanTot,2)."</th><th>".number_format($data[1]->FebTot,2)."</th><th>".number_format($data[1]->MarTot,2)."</th><th>".number_format($data[1]->AprTot,2)."</th><th>".number_format($data[1]->MayTot,2)."</th><th>".number_format($data[1]->JunTot,2)."</th></tr>";
echo "</table>";

echo "<br>";

echo "<table id='tblBudgetSummary' style='white-space:nowrap;text-align:right;'>";
echo "<caption><b>".$_SESSION['fname']."-".$_SESSION['lname']." FY".$data[4]." Budget Summary</b></caption>";
echo "<tr><th>Account</th><th>Total</th><th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th><th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th></tr>";
foreach ($data[2] as $accRec):
    echo "<tr><td style='text-align:left;'>$accRec->AccText - $accRec->AccName</td><td>$accRec->totalCost</td><td>".number_format($accRec->JulTot,2)."</td><td>".number_format($accRec->AugTot,2)."</td><td>".number_format($accRec->SepTot,2)."</td><td>".number_format($accRec->OctTot,2)."</td><td>".number_format($accRec->NovTot,2)."</td><td>".number_format($accRec->DecTot,2)."</td><td>".number_format($accRec->JanTot,2)."</td><td>".number_format($accRec->FebTot,2)."</td><td>".number_format($accRec->MarTot,2)."</td><td>".number_format ($accRec->AprTot,2)."</td><td>".number_format ($accRec->MayTot,2)."</td><td>".number_format ($accRec->JunTot,2)."</td></tr>";
endforeach;
echo "<tr><th>Totals:</th><th>".number_format($data[3]->totalCost,2)."</th><th>".number_format($data[3]->JulTot,2)."</th><th>".number_format($data[3]->AugTot,2)."</th><th>".number_format($data[3]->SepTot,2)."</th><th>".number_format($data[3]->OctTot,2)."</th><th>".number_format($data[3]->NovTot,2)."</th><th>".number_format($data[3]->DecTot,2)."</th><th>".number_format($data[3]->JanTot,2)."</th><th>".number_format($data[3]->FebTot,2)."</th><th>".number_format($data[3]->MarTot,2)."</th><th>".number_format($data[3]->AprTot,2)."</th><th>".number_format($data[3]->MayTot,2)."</th><th>".number_format($data[3]->JunTot,2)."</th></tr>";
echo "</table>";
?>