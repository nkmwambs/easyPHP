<?php
//print_r($data['rec']);
echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("Finance/fundssummary","[View Uploaded Funds]").Resources::a_href("Finance/editschedule","[Edit Funds Schedule]")." ".Resources::a_href("Finance/civ","[CIV]");
echo "<br>";
echo "<hr>";
echo "<br>";

$curSelect="";
$cur="";

if(isset($data['month'])){
	$curSelect=date('F-Y',$data['month']);
	$cur = $data['month'];
}else{
	echo "<div id='error_div'>Invalid Period</div>".Resources::a_href("Finance/fundssummary","<button>Reset</button>");
	
	exit;
}

echo "<div id='rst'>";
echo "Select Month:<SELECT id='monthselect'>";
echo "<OPTION VALUE=''>Select Month...</OPTION>";
echo "<OPTION VALUE='".strtotime('-5 month',$cur)."'>".date('F-Y',  strtotime('-5 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-4 month',$cur)."'>".date('F-Y',  strtotime('-4 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-3 month',$cur)."'>".date('F-Y',  strtotime('-3 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-2 month',$cur)."'>".date('F-Y',  strtotime('-2 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-1 month',$cur)."'>".date('F-Y',  strtotime('-1 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime($curSelect)."'>".$curSelect."</OPTION>";
echo "<OPTION VALUE='".strtotime('+1 month',$cur)."'>".date('F-Y',  strtotime('+1 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+2 month',$cur)."'>".date('F-Y',  strtotime('+2 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+3 month',$cur)."'>".date('F-Y',  strtotime('+3 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+4 month',$cur)."'>".date('F-Y',  strtotime('+4 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+5 month',$cur)."'>".date('F-Y',  strtotime('+5 month',$cur))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+6 month',$cur)."'>".date('F-Y',  strtotime('+6 month',$cur))."</OPTION>";
echo "</SELECT>".Resources::img('go.png',array("onclick"=>'selectSummaryFromDropDown()'))."<br><br>";

echo "<br><br><button onclick='deleteDisbursement(\"".$data['month']."\")'>Delete Disbursement</button><br>";

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption>Funds Summary for ".date("F-Y",$data['month'])."</caption>";
	echo "<tr><th>Account Description</th><th>Amount</th></tr>";
foreach ($data['rec'] as $value) {
	echo "<tr><td onclick='viewfundpericp(this,\"".date('Y-m-01',$data['month'])."\")' style='color:blue;'>".$value->AccountDescription."</td><td style='text-align:right;'>".number_format($value->Amount,2)."</td></tr>";
}
	echo "<tr><td>Totals:</td><td style='text-align:right;'>".number_format($data['tot'],2)."</td></tr>";
echo "</table>";

echo "</div>";
//print_r($data['test']);
?>