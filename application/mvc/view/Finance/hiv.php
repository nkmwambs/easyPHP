<?php
$curSelect="";
$cur = strtotime("now");
if(isset($data['curDate'])){
	$curSelect=date('F-Y',strtotime($data['curDate']));
	$cur = strtotime($data['curDate']);
}else{
	$curSelect=date('F-Y',strtotime("now"));
}


echo Resources::a_href("Finance/hiv","[HIV Balances]")." ".Resources::a_href("","[HIV Disbursement]");

echo "<hr><br><br><br>";

echo "Select Month:<SELECT id='monthselect'>";
echo "<OPTION VALUE=''>Select Month...</OPTION>";
echo "<OPTION VALUE='".strtotime('-5 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('-5 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-4 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('-4 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-3 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('-3 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-2 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('-2 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('-1 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('-1 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".$cur."'>".date("F-Y",strtotime("-5 days",strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+1 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+1 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+2 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+2 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+3 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+3 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+4 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+4 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+5 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+5 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "<OPTION VALUE='".strtotime('+6 month',strtotime("-5 days",$cur))."'>".date('F-Y',  strtotime('+6 month',strtotime("-5 days",$cur)))."</OPTION>";
echo "</SELECT>".Resources::img('go.png',array("onclick"=>'hvc400fundbalance()'))."<br><br>";

echo "<br><button  id='' onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table style='max-width:80%;margin-left:auto;margin-right:auto;'>";
echo "<caption style='font-weight:bold;'>HIV Fund Balance for ".$data['curDate']."</caption>";
$sum = 0;
foreach ($data['r400_bal'] as $key => $value) {
	echo "<tr><th colspan='2' style='background-color:gray;'>".$key." (".count($value).")</th></tr>";
	$csum=0;
	foreach ($value as $ky => $val) {
		echo "<tr><th colspan='2' style='background-color:cyan;'>".$ky."</th></tr>";
		echo "<tr><th style='border:1px solid black;'>ICP</th><th style='border:1px solid black;'>Amount</th></tr>";
		$icpsum=0;
		foreach ($val as $k => $v) {
			echo "<tr><td style='border:1px solid black;'>".$k."</td><td style='border:1px solid black;text-align:right;'>".number_format($v,2)."</td></tr>";
			$sum+=$v;
			$icpsum+=$v;
			$csum+=$v;
		}
		echo "<tr><th style='text-align:left;border:1px solid black;'>ICP Totals:</th><th style='text-align:right;border:1px solid black;'>".number_format($icpsum,2)."</th></tr>";
	}
	echo "<tr><th style='text-align:left;border:1px solid black;'>Cluster Totals:</th><th style='text-align:right;border:1px solid black;'>".number_format($csum,2)."</th></tr>";
}
echo "<tr><th style='text-align:left;border:1px solid black;'>Country Totals:</th><th style='text-align:right;border:1px solid black;'>".number_format($sum,2)."</th></tr>";
echo "</table>";

echo "</div>";

?>