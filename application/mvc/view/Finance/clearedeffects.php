<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}


echo Resources::a_href("Finance/fundsOpBal","<button>Closing Funds Balances</button>")." ".Resources::a_href("Finance/oustChqBf","<button>Closing O/C</button>")." ".Resources::a_href("Finance/cashBalBf","<button>Closing Cash Balance</button>")." ".Resources::a_href("Finance/clearedeffects","<button>Cleared Effects</button>");
echo "<br><br><hr>";

if($data['norec']===0){
	echo "<div id='error_div'>No Records for Cleared Effects Available</div>";
	exit;
}

echo "<table id='info_tbl' style='margin-top:25px;'>";
echo "<caption>Cleared Cheque Effects for ".$data['month']."</caption>";

echo "<tr><th>Action</th><th>Transaction Date</th><th>Voucher Number</th><th>Amount</th><th>Cheque State</th><th>Cheque #</th><th>Cleared End Month Date</th></tr>";
foreach ($data['rec'] as $value) {
	$state="Oustanding";	
	if($value->ChqState==='1'){
		$state="Cleared";
	}
	echo "<tr><td><button onclick='unclearchq(\"".$value->hID."\",this)'>Unclear</button></td><td>".$value->TDate."</td><td>".$value->VNumber."</td><td>".$value->totals."</td><td>".$state."</td><td>".$value->ChqNo."</td><td>".$value->clrMonth."</td></tr>";
}
echo "</table>";
?>