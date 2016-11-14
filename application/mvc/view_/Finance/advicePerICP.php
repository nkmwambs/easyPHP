<?php
//print_r($data);
echo img_tag("previous.png")." ".img_tag("next.png");
echo "<table>";
foreach ($data as $key=>$val):
    echo "<tr><th colspan='2' style='background-color:lightgrey;'>".$key."</th></tr>";
    echo "<tr><th><u>Description</u></th><th><u>Amount</u></th></tr>";
    $sum=0;
    foreach($val as $k=>$v):
        echo "<tr><td>".$k."</td><td>".number_format($v[1],2)."</td></tr>";
    $sum+=$v[1];
    endforeach;
    echo "<tr><td><b>Total Funds Received:</b></td><td><b>".number_format($sum,2)."</b></td></tr>";
endforeach;
echo "</table>";
?>