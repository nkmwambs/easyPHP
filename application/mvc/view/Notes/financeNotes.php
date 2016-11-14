<?php
echo Resources::a_href("Finance/financeNotes","[Voucher/ Journal Notes]")." ".Resources::a_href("","[MFR Notes]");
echo "<hr><br><br><br>";
//print_r($data['vouchernotes']); 

$curSelect="";
$cur="";
if(isset($data['curdate'])){
	$curSelect=date('F-Y',strtotime($data['curdate']));
	$cur = strtotime($data['curdate']);
}


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
echo "</SELECT>".Resources::img('go.png',array("onclick"=>'selectVoucherNotesFromDropDown()'))."<br><br>";


echo "<table style='font-size:medium;max-width:100%;'>";
echo "<caption>Voucher Notes for ".date('F-Y',strtotime($data['curdate']))."</caption>";
foreach ($data['vouchernotes'] as $key => $value) {
	echo "<tr><th colspan='4' style='background-color:teal;'>".$key."</th></tr>";
	foreach ($value as $ky => $val) {
		echo "<tr><th colspan='4' style='background-color:gray;border:1px white solid;'>".$ky." (".count($val).")<div onclick='viewicpnotes(\"".$ky."\")' style='color:blue;cursor:pointer;'> [View]</div></th></tr>";
		echo "<tr style='display:none;' class='".$ky."-icps'><th>Voucher #</th><th>Message</th><th>Sent By</th><th>Time Stamp</th></tr>";
			foreach ($val as $k => $v) {
				echo "<tr style='display:none;' class='".$ky."_icps icps'><td>".$v['VNumber']."</td><td style='white-space: pre-wrap;'>";
				
				echo $v['msg'];
				if(Resources::session()->fname!==$v['msg_from']){
				 	echo '<span class="glyphicons glyphicons-check"></span>';
				}
				echo "</td><td>";
				echo $v['msg_from'];
				echo "</td><td>".$v['stmp']."</td></tr>";
			}
	}
}
echo "</table>";

?>
