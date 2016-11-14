<?php
if(Resources::session()->userlevel==='9'){
	//Revenue Balance
	echo "<div style='max-width:60%;float:left;'>";
	echo "<table id='info_tbl' style='margin-top:25px;width:100%;'>";
	echo "<caption>Opening Fund Balance Change Requests</caption>";
	echo "<tr><th>Action</th><th>ID</th><th>KE No</th><th>Total</th><th>Request Date</th></tr>";
	foreach ($data['rec'] as $value) {
		echo "<tr><td><button onclick='viewreqbal(\"".$value->balHdID."\")'>View</button><button onclick='acceptopfundbalreq(\"".$value->icpNo."\",\"".$value->totalBal."\",this,\"".$value->balHdID."\")'>Accept</button></td><td>".$value->balHdID."</td><td>".$value->icpNo."</td><td>".$value->totalBal."</td><td>".date("Y-m-d",strtotime($value->stmp))."</td></tr>";
	}
	echo "</table>";
	
	echo "<hr><br>";
	
	//Oustanding Cheques

	echo "<table id='info_tbl' style='margin-top:25px;width:100%;'>";
	echo "<caption>Opening Uncleared Effects Requests</caption>";
	echo "<tr><th>Action</th><th>KE No</th><th>Cheque Count</th><th>Request Date</th></tr>";
	
	foreach ($data['oschq'] as $value) {
		echo "<tr><td><button onclick='viewoschqreq(\"".$value->icpNo."\")'>View</button><button onclick='openunclrdchqreq(\"".$value->icpNo."\",this)'>Accept</button></td><td>".$value->icpNo."</td><td>".$value->cnt."</td><td>".date("Y-m-d",strtotime($value->stmp))."</td></tr>";
	}
	
	echo "</table>";
	
	echo "<hr><br>";
	
	//Cash Balance
	
	echo "<table id='info_tbl' style='margin-top:25px;width:100%;'>";
	echo "<caption>Opening Cash Balances Requests</caption>";
	echo "<tr><th>Action</th><th>KE No</th><th>Amount</th><th>Request Date</th></tr>";
	
	foreach ($data['cashbal'] as $value) {
		echo "<tr><td><button onclick='viewcashbalreq(\"".$value->icpNo."\")'>View</button><button onclick='opencashbalreq(\"".$value->icpNo."\",this)'>Accept</button></td><td>".$value->icpNo."</td><td>".$value->Amount."</td><td>".date("Y-m-d",strtotime($value->stmp))."</td></tr>";
	}
	
	echo "</table>";
	
	echo "</div>";
	
	echo "<div id='balView' style='max-width:35%;float:left;margin-left:10px;'></div>";
}
?>
