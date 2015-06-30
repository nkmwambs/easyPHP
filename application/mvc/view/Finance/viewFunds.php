<?php
//print_r($data);
if(isset($data[1])){
	$curSelect=date('F-Y',$data[1]);
	$cur = $data[1];
}else{
	$curSelect=date('F-Y',strtotime("now"));
	$cur = strtotime("now");
}

echo "<button id='btnFundsDel' style='display:none;'>Delete</button><button onclick='fundsCategories();'>View Per Category</button>";
//echo Resources::img("previous.png")." ".Resources::img("next.png");
echo "<br><br><hr><button onclick='selectDisburse(\"".strtotime('-1 month',$cur)."\");'>".date('F-Y',  strtotime('-1 month',$cur))."</button><button style='background-color:lightgreen;'  onclick='selectDisburse(\"".strtotime($curSelect)."\");'>".$curSelect."</button><button onclick='selectDisburse(\"".strtotime('+1 month',$cur)."\");'>".  date('F-Y',  strtotime('+1 month',$cur))."</button>";
echo "<table id='info_tbl' style='min-width:750px;'>";
echo "<tr><th><input type='checkbox' id='del' onclick='delRec();'/></th><th>ID</th><th>KE No</th><th>Account Code</th><th>Funds Description</th><th>Amount</th><th>Month</th><th>Upload Time Stamp</th></tr>";
foreach ($data[0] as $flds):
    echo "<tr><td><input type='checkbox' name='delRec[]' class='dels'/></td>";
    foreach ($flds as $val):
        echo "<td>".$val."</td>";
    endforeach;
    echo "</tr>";
endforeach;
echo "</table>";
?>