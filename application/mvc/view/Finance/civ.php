<?php
if(Resources::session()->userlevel==='3'){
	echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("Finance/fundssummary","[View Uploaded Funds]")." ".Resources::a_href("Finance/civ","[CIV]");	
}else{
	echo Resources::a_href("Finance/civ","[CIV]");
}

echo "<br>";
echo "<hr>";
echo "<br>";
if($_SESSION['userlevel']==="3"){
echo Resources::a_href("Finance/AddCIVA",Resources::img("diskadd.png",array("title"=>'Add Account')))."&nbsp;&nbsp;".Resources::a_href("Finance/civedit",Resources::img("diskedit.png",array("title"=>"Edit Account")));
}
//print_r($data['icps']);

echo "<br>Filter Accounts By Status:";
echo "<SELECT id='statusfilter' onchange='civstatusfilter(this);'>";
	echo "<OPTION VALUE=''>Select Status</OPTION>";
	echo "<OPTION VALUE='1' SELECTED>Open Accounts</OPTION>";
	echo "<OPTION VALUE='0'>Closed Accounts</OPTION>";
echo "</SELECT>";

echo "<br><button onclick='excelexport()'>Export</button><br>";

echo "<div id='rst'>";

echo "<table id='info_tbl' style='margin-top:20px;'>";
$msg="";
if(Resources::session()->userlevel==='3'||Resources::session()->userlevel==='18'){$msg="(<span style='font-weight:normal;color:red;'>".Resources::img("information.png")." Double click date to review</span>)";}
echo "<tr><th>Group Description</th><th>Group Code</th><th>CIV ID</th><th>CIV Category Code</th><th>CIV Description</th><th style='min-width:800px;'>ICP(s) Allocated</th><th>Status</th><th>Closure Date ".$msg."</th><th>Amount Disbursed</th><th>Expense To Date</th><th>Balance To Date</th><th>View</th></tr>";
foreach($data['rec'] as $value):
	
	//ICP Array
	$icp_arr = explode(",",$value->allocate);
	
	//Check matches between icps allocated and cluster icps and set display to none of result array is empty and current user is a PF
	$result=array_intersect($icp_arr,$data['icps']);
	$rmEmptyRow="";
	if(empty($result)&&Resources::session()->userlevel==='2'){
		$rmEmptyRow="display:none";
	}
	//Change $icp_arr to array intersect result
	if(Resources::session()->userlevel==='2'){
		$icp_arr = $result;
	}
	
	$btnVal = "Close";
	if($value->open==='0'){
		$btnVal="Open";
	}
	
	$Com = "Open";
	if($value->open==='0'){
		$Com="Closed";
	}
	
	$bgColor = "style='{$rmEmptyRow}'";
	if($value->closureDate<date("Y-m-d")&&$value->closureDate!=='0000-00-00'){
		$bgColor = "style='background-color:red;{$rmEmptyRow}'";
	}elseif(strtotime("+2 month",strtotime(date("Y-m-01")))>=strtotime($value->closureDate)&&$value->closureDate!=='0000-00-00'){
		$bgColor = "style='background-color:yellow;{$rmEmptyRow}'";
	}
	
	
    echo "<tr {$bgColor}>";
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
		echo Resources::img("search2.png",array("title"=>"Search for ICP","onclick"=>"searchicpinciv(this)"));		
		echo Resources::img("diskedit.png",array("title"=>"Edit","onclick"=>"addicptociv(this)"));
	}			
	echo "</td>";
	if(Resources::session()->userlevel==='3'||Resources::session()->userlevel==='18'){
		echo "<td><div class='icpDivs' onclick='manageCivDate(\"".$value->open."\",\"".$value->AccNoCIVA."\");'>".$btnVal."</div></td>";
	}else{
		echo "<td>{$Com}</td>";
	}
	if(Resources::session()->userlevel==='3'||Resources::session()->userlevel==='18'){
		echo "<td ondblclick='reviewcivclosuredate(this);'>".$value->closureDate."</td>";
	}else{
		echo "<td>".$value->closureDate."</td>";
	}
	echo "<td>".$value->AmountDisbursed."</td>";
	echo "<td>".$value->AmountSpent."</td>";
	echo "<td>".$value->BalanceToDate."</td>";
    echo "<td>".Resources::img("view.png",array("title"=>'View',"onclick"=>"viewicpcivacounts(\"".$value->civaID."\",\"".$value->AccTextCIVA."\");","style"=>"cursor:pointer;"))."</td></tr>";
endforeach;
echo "</table>";

echo "</div>";
