<?php
echo Resources::a_href("Finance/fundsOpBal","<button>Closing Funds Balances</button>")." ".Resources::a_href("Finance/oustChqBf","<button>Closing O/C</button>")." ".Resources::a_href("Finance/cashBalBf","<button>Closing Cash Balance</button>")." ".Resources::a_href("Finance/opRecon","<button>Closing Bank Reconciliation</button>");
?>
<br><br><hr>
<div style="margin-left:250px;margin-bottom: 50px;"><button  onclick='addChqOSRow("tblOSBf");'>Add Row</button><button id='btnOSRowDel' style="display: none;">Delete Row</button><button onclick='addOS("frmOSBf");'>Post</button><?php echo Resources::a_href("Finance/oustChqBf","<button>Refresh</button>");?><button>View</button></div>
<form id="frmOSBf">
<table id="tblOSBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="4">Oustanding Date: <input type="text" id="osDate" name="" readonly/></th></tr>
    <tr><th><input type="checkbox" id="" onclick="chkAll(this);showDel();"/></th><th>Cheque Number</th><th>Date</th><th>Amount</th></tr>
</table>
</form>
<div id="balView"></div>