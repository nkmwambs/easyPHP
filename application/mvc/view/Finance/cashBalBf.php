<?php
echo a_tag("Finance/fundsOpBal","<button>Closing Funds Balances</button>")." ".a_tag("Finance/oustChqBf","<button>Closing O/C</button>")." ".a_tag("Finance/cashBalBf","<button>Closing Cash Balance</button>")." ".a_tag("Finance/opRecon","<button>Closing Bank Reconciliation</button>");
?>
<br><br><hr>
<fieldset style="border:2px blue solid;">
    <legend><b>Closing Cash Balance as Per the Cash Journal</b></legend>
<div style="margin-left:250px;margin-bottom: 50px;"><button id='btnCashBalDel' style="display: none;">Delete Row</button><button onclick='addCash("frmCashBf");'>Post</button><?php echo a_tag("Finance/cashBalBf","<button>Refresh</button>");?><button>View</button></div>
<form id="frmCashBf">
<table id="tblCashBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="2">Date: <input type="text" id="cjCashOpBal" name="" readonly/></th></tr>
    <tr><th>Details</th><th>Amount</th></tr>
    <tr><th>Cash at Bank</th><th><input type="text" id='' name=''/></th></tr>
    <tr><th>Cash at Hand</th><th><input type="text" id='' name=''/></th></tr>
</table>
</form>
</fieldset>

<fieldset style="border:2px blue solid;">
    <legend><b>Closing Cash Balance as Per the Bank Statement</b></legend>
<div style="margin-left:250px;margin-bottom: 50px;"><button id='btnCashBalDel' style="display: none;">Delete Row</button><button onclick='addCash("frmCashBf");'>Post</button><?php echo a_tag("Finance/cashBalBf","<button>Refresh</button>");?><button>View</button></div>
<form id="frmCashBf">
<table id="tblCashBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="2">Date: <input type="text" id="bsCashOpBal" name="" readonly/></th></tr>
    <tr><th>Details</th><th>Amount</th></tr>
    <tr><th>Cash at Bank</th><th><input type="text" id='' name=''/></th></tr>
    <tr><th>Cash at Hand</th><th><input type="text" id='' name=''/></th></tr>
</table>
</form>
</fieldset>

<div id="balView"></div>