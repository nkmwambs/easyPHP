<?php
echo Resources::a_href("Finance/fundsOpBal","<button>Closing Funds Balances</button>")." ".Resources::a_href("Finance/oustChqBf","<button>Closing O/C</button>")." ".Resources::a_href("Finance/cashBalBf","<button>Closing Cash Balance</button>")." ".Resources::a_href("Finance/clearedeffects","<button>Cleared Effects</button>");
?>
<br><br><hr>
<fieldset style="border:2px blue solid;">
    <legend><b>Closing Cash Balance as Per the Cash Journal</b></legend>
<div style="margin-left:250px;margin-bottom: 50px;"><button id='btnCashBalDel' style="display: none;">Delete Row</button><button onclick='addCashdraft("frmCashBf");'>Post</button><?php echo Resources::a_href("Finance/cashBalBf","<button>Refresh</button>");?><button onclick="viewCashBal();">View</button></div><br><br>
<form id="frmCashBf">
ICP Number:<input type="text" id="fname" name="icpNo" VALUE='<?php echo Resources::session()->fname;?>' readonly/>
<table id="tblCashBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="2">Date: <input type="text" id="cjCashOpBal" name="cjCashOpBal" readonly/></th></tr>
    <tr><th>Details</th><th>Amount</th></tr>
    <tr><th>Cash at Bank</th><th><input type="text" id="bcBal" name="cashBal[]"/></th></tr>
    <tr><th>Cash at Hand</th><th><input type="text" id='pcBal' name="cashBal[]"/></th></tr>
</table>
</form>
<div id='viewCashBal'></div>
</fieldset>

<!--
<fieldset style="border:2px blue solid;">
    <legend><b>Closing Cash Balance as Per the Bank Statement</b></legend>
<div style="margin-left:250px;margin-bottom: 50px;"><button id='btnCashBalDel' style="display: none;">Delete Row</button><button onclick='addCash("frmCashStmtBf");'>Post</button><?php echo Resources::a_href("Finance/cashBalBf","<button>Refresh</button>");?><button onclick="viewCashStmtBal();">View</button></div>
<form id="frmCashStmtBf">
<table id="tblCashBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th>Date</th><th>Amount</th></tr>
    <tr><th><input type="text" id="bsCashOpBalDate" name="bsCashOpBalDate" readonly/></th></th><th><input type="text" id='bsCashOpBal' name='bsCashOpBal'/></th></tr>

</table>
</form>
<div id='viewCashStmtBal'></div>
</fieldset>
-->
<div id="balView"></div>