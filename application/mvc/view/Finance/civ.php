<?php
echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("Finance/civ","[View Uploaded Funds]")." ".Resources::a_href("Finance/civ","[CIV]");
echo "<br>";
echo "<hr>";
echo "<br>";
if($_SESSION['userlevel']==="3"){
echo Resources::a_href("Finance/AddCIVA",Resources::img("diskadd.png",array("title"=>'Add Account')))."&nbsp;&nbsp;".Resources::a_href("Finance/civedit",Resources::img("diskedit.png",array("title"=>"Edit Account")));
}
//print_r($data['rec']);

echo "<br>Filter Accounts By Status:";
echo "<SELECT id='statusfilter' onchange='civstatusfilter(this);'>";
	echo "<OPTION VALUE=''>Select Status</OPTION>";
	echo "<OPTION VALUE='1' SELECTED>Open Accounts</OPTION>";
	echo "<OPTION VALUE='0'>Closed Accounts</OPTION>";
echo "</SELECT>";

echo "<table id='info_tbl' style='margin-top:20px;'>";
echo "<tr><th>Group Description</th><th>Group Code</th><th>CIV ID</th><th>CIV Category Code</th><th>CIV Description</th><th>ICP(s) Allocated</th><th>Status</th><th>Closure Date</th><th>Amount Disbursed</th><th>Expense To Date</th><th>Balance To Date</th><th>View</th></tr>";
foreach($data['rec'] as $value):
	$btnVal = "Close";
	if($value->open==='0'){
		$btnVal="Open";
	}
	
	//ICP Array
	$icp_arr = explode(",",$value->allocate);
	
    echo "<tr>";
	echo "<td>".$value->AccName."</td>";
	echo "<td>".$value->AccText."</td>";
	echo "<td>".$value->civaID."</td>";
	echo "<td>".$value->AccNoCIVA."</td>";
	echo "<td>".$value->AccTextCIVA."</td>";
	echo "<td>";
			foreach ($icp_arr as $val) {
				echo "<div class='icpDivs' onclick='showcivimpbreakdown(this,\"".$value->civaID."\",\"".$value->AccTextCIVA."\");'>".$val."</div>";
			}	
	if(Resources::session()->userlevel==='3'){		
		echo Resources::img("diskedit.png",array("onclick"=>"addicptociv(this)"));
	}
	echo "</td>";
	echo "<td><div class='icpDivs' onclick='manageCivDate(\"".$value->open."\",\"".$value->AccNoCIVA."\");'>".$btnVal."</div></td>";
	echo "<td>".$value->closureDate."</td>";
	echo "<td>".$value->AmountDisbursed."</td>";
	echo "<td>".$value->AmountSpent."</td>";
	echo "<td>".$value->BalanceToDate."</td>";
    echo "<td>".Resources::img("view.png",array("title"=>'View',"onclick"=>"viewicpcivacounts(\"".$value->civaID."\",\"".$value->AccTextCIVA."\");","style"=>"cursor:pointer;"))."</td></tr>";
endforeach;
echo "</table>";