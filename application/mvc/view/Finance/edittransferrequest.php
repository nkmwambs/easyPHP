<?php

echo Resources::a_href("Finance/voucher","[Back]");
echo Resources::a_href("Finance/fundstransferapproval","[View Transfer Requests]");

echo "<br><hr><br><br>"; 

echo "<table>";
echo "<caption style='font-weight:bold;'>Funds Balance Transfer Request: Edit</caption>";
echo "<form id='frmbaltranferreq'>";
echo "<tr><td style='font-weight:bold;'>Request ID</td><td><INPUT TYPE='text' id='reqID' name='reqID' VALUE='".$data['req']->reqID."' readonly/></td></tr>";
echo "<tr><td style='font-weight:bold;'>Month From (End Month Date):</td><td><INPUT TYPE='text'  VALUE='".$data['req']->monthfrom."'  id='monthfrom' name='monthfrom'/>".Resources::img("go.png",array("Title"=>"Go","onclick"=>'getfundsamount()'))."</td></tr>";
echo "<tr><td style='font-weight:bold;'>KE No</td><td><INPUT TYPE='text' name='icpNo' id='icpNo'  VALUE='".$data['req']->icpNo."'  readonly/></td></tr>";

echo "<tr><td style='font-weight:bold;'>From Account:</td><td><INPUT TYPE='text'  VALUE='".$data['req']->acfrom."'  name='acfrom' id='acfrom' readonly/></td></tr>";
echo "<tr><td style='font-weight:bold;'>To Account:</td><td><SELECT onchange='updateacto(this)' name='actoraw' id='actoraw'><OPTION VALUE=''>Select Account ...</OPTION>";
	foreach ($data['ac'] as $value) {
		                if($value->AccTextCIVA!==""&&$value->open==="1"){
                            echo "<OPTION VALUE='".$value->AccNo."'>".$value->AccNoCIVA." (".$value->AccName.")</OPTION>";
                        }else{  
                            echo "<OPTION VALUE='".$value->AccNo."'>".$value->AccText." - ".$value->AccName."</OPTION>";                     
                        }  
	}
echo "</SELECT><b>Account </b> <INPUT TYPE='text' id='acto' VALUE='".$data['req']->acto."' name='acto' readonly/> <b>CIV Code</b><INPUT TYPE='text' name='civaID' id='civaID' VALUE='".$data['req']->civaID."' style='max-width:50px;' value='0' readonly/></td></tr>";	
//echo "<tr><td style='font-weight:bold;'>Total Amount Available:</td><td class='hide'><INPUT  name='amtavailable' VALUE='' id='amtavailable' TYPE='text' readonly/></td></tr>";
echo "<tr><td style='font-weight:bold;'>Amount to Transfer:</td><td><INPUT name='amttotransfer' VALUE='".$data['req']->amttotransfer."' id='amttotransfer' TYPE='text'/></td></tr>";
echo "<tr><td style='font-weight:bold;'>Description</td><td><TEXTAREA id='description' name='description'  cols='80' rows='10'>".$data['req']->description."</TEXTAREA></td></tr>";
echo "</form>";
echo "<tr><td colspan='2'><button onclick='fundstransferrequestedit()'>Edit Request</button></td></tr>";

echo "</table>";
?>