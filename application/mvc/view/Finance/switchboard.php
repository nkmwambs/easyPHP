<?php
echo "<table id='tblFinanceView'>";

echo "<tr><td colspan='2'>"; 
    echo "<fieldset style='margin:5px 5px 5px 5px;'>";
        echo "<legend>Content</legend>";
        echo "<input type='radio' name='chkContent' value='1' id='rdecj' class='rds' checked/> Cash Journal";
        echo "<input type='radio' name='chkContent' value='2'  id='rdppbf' class='rds'/> PPBF";
        echo "<input type='radio' name='chkContent' value='3'  id='rdmfr' class='rds'/> Monthly Financial Report";
        echo "<input type='radio' name='chkContent' value='4'  id='rdmfr' class='rds'/> CIVs";
        echo "<input type='radio' name='chkContent' value='5'  id='rdfunds' class='rds'/> Funds Disbursement";
    echo "</fieldset>";
echo "</td></tr>";
echo "<tr><th>Cluster</th><th>Implementing Church Partners</th></tr>";
foreach($data as $key=>$value):
    echo "<tr><td>".$key." (".count($data[$key]).")</td><td>";
    foreach ($data[$key] as $icp):
        echo "<div class='icpDivs' onclick='showContent(this);'>".$icp."</div>";
    endforeach;
    echo "</td></tr>";
endforeach;
echo "</table>";
?>