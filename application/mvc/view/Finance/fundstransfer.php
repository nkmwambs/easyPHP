<?php

echo Resources::a_href("Finance/voucher","[Back]");
echo Resources::a_href("Finance/fundstransferapproval","[View Transfer Requests]");

echo "<br><hr><br><br>"; 

echo "<table>";
echo "<caption style='font-weight:bold;'>Funds Balance Transfer Request</caption>";
echo "<form id='frmbaltranferreq'>";
echo "<tr><td style='font-weight:bold;'>Month From (End Month Date):</td><td><INPUT TYPE='text' id='monthfrom' name='monthfrom' readonly/></td></tr>";


//if(Resources::session()->admin===1){
	
	$lst = "";
	
	foreach ($data['all'] as $val) {
		$lst .="<OPTION VALUE='".$val->AccNo."'>".$val->AccText."</OPTION>";
	}
	
	//echo "<tr><td class='hide'>From Account:</td><td class='hide'><INPUT TYPE='text' VALUE='300' name='acfrom' id='acfrom' readonly/></td></tr>";
echo "<tr><td>From Account:</td><td><SELECT name='acfrom' id='acfrom'>".$lst."</SELECT>".Resources::img("go.png",array("Title"=>"Go","onclick"=>'getfundsamount()'))."</td></tr>";
//}

//echo "<tr><td class='hide'>From Account:</td><td class='hide'><INPUT TYPE='text' VALUE='300' name='acfrom' id='acfrom' readonly/></td></tr>";

echo "<tr><td class='hide'>KE No</td><td class='hide'><INPUT TYPE='text' name='icpNo' id='icpNo' VALUE='".Resources::session()->fname."' readonly/></td></tr>";

echo "<tr><td class='hide'>To Account:</td><td class='hide'><SELECT onchange='getcivcode(this)' name='acto' id='acto'><OPTION VALUE=''>Select Account ...</OPTION>";
	foreach ($data['ac'] as $value) {
		                if($value->AccTextCIVA!==""&&$value->open==="1"){
                            echo "<OPTION VALUE='".$value->AccNo."'>".$value->AccNoCIVA." (".$value->AccName.")</OPTION>";
                        }else{  
                            echo "<OPTION VALUE='".$value->AccNo."'>".$value->AccText." - ".$value->AccName."</OPTION>";                     
                        }  
	}
	
echo "</SELECT> <b>CIV Code</b><INPUT TYPE='text' name='civaID' id='civaID' style='max-width:50px;' value='0' readonly/></td></tr>";
echo "<tr><td class='hide'>Total Amount Available:</td><td class='hide'><INPUT  name='amtavailable' id='amtavailable' TYPE='text' readonly/></td></tr>";
echo "<tr><td class='hide'>Amount to Transfer:</td><td class='hide'><INPUT name='amttotransfer' id='amttotransfer' TYPE='text'/></td></tr>";
echo "<tr><td class='hide'>Description</td><td class='hide'><TEXTAREA id='description' name='description' cols='80' rows='10'></TEXTAREA></td></tr>";
echo "</form>";
echo "<tr><td  class='hide' colspan='2'><button onclick='fundstransferrequest()'>Submit Request</button></td></tr>";

echo "</table>";
?>