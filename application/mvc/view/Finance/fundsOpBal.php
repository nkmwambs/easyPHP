<?php
echo Resources::a_href("Finance/fundsOpBal","<button>Closing Funds Balances</button>")." ".Resources::a_href("Finance/oustChqBf","<button>Closing O/C</button>")." ".Resources::a_href("Finance/cashBalBf","<button>Closing Cash Balance</button>")." ".Resources::a_href("Finance/clearedeffects","<button>Cleared Effects</button>");
?>
<br><br><hr>
<div>
<div style="margin-left:250px;margin-bottom: 50px;"><button  onclick='addFundBalRow("tblFundsBalBf");'>Add Row</button><button id='btnFundRowDel' style="display: none;">Delete Row</button><button onclick='addFundBaldraft("frmFundsBalBf");'>Post</button><?php echo Resources::a_href("Finance/fundsOpBal","<button>Refresh</button>");?><button onclick="viewBal()">View</button></div><br><br>
<form id='frmFundsBalBf'>
ICP Number:<input type="text" id="fname" name="icpNo" VALUE='<?php echo Resources::session()->fname;?>' readonly/>
<table id="tblFundsBalBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="3">Last FY Closure Date:<input type="text" name="closureDate" id="closeDate" readonly value=""/> Total:<input type="text" name="totalBal" id="totalFunds" readonly/></th></tr>
    <tr><th><input type="checkbox" id="" onclick="chkAll(this);showDel();"/></th><th>Funds</th><th>Balance B/F Amount</th></tr>
</table>
</form>
</div>

<div id="balView"></div>

<!--
<fieldset>
	<b>ICP Fund Balances Upload</b>
	<div style="margin-left:250px;margin-bottom: 50px;"><button  onclick='addFundBalRow("tblFundsBalBf");'>Add Row</button><button id='btnFundRowDel' style="display: none;">Delete Row</button><button onclick='addFundBaldraft("frmFundsBalBf");'>Post</button><?php echo Resources::a_href("Settings/financeSettings","<button>Refresh</button>");?><button onclick="viewBal()">View</button></button></div>
	
	<form id='frmFundsBalBf'>
	ICP Number:<input type="text" id="fname" name="icpNo" VALUE='<?php echo Resources::session()->fname;?>' readonly/>
	<table id="tblFundsBalBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="3">Last FY Closure Date:<input type="text" name="closureDate" id="closeDate" readonly value=""/> Total:<input type="text" name="totalBal" id="totalFunds" readonly/></th></tr>
    <tr><th><input type="checkbox" id="" onclick="chkAll(this);showDel();"/></th><th>Funds</th><th>Balance B/F Amount</th></tr>
	</table>
	</form>
	<div id="balView"></div>
</fieldset>
-->