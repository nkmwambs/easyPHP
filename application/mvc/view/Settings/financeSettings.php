<?php
if(is_array($data)){
	print_r($data['test']);
}else{
	print($data['test']);
}
$chkd = "checked";
if($data['date_flag']==='1'){
	$chkd = "";
}
if(Resources::session()->userlevel==='9'){
?>
<fieldset style="border-color: blue;">
	<legend><b>Voucher Settings</b></legend>
Date Control <input type='checkbox' name='dateControl' onclick='dateControl(this);'  id='dateControl' <?php echo $chkd;?>/><br>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>PPBF Settings</b></legend>
Dollar Rate:<input type="text" id='dollar_rate' name="dollar_rate" value='<?php echo $data['rates']['dollar_rate'];?>'/> FY:<input type='text' id='dollar_rate_fy' name='dollar_rate_val' value='<?php echo $data['rates']['fy'];?>'/><div style="color:blue;cursor: pointer;width:50px;" onclick="changeDollarRate();">Change</div><br>
Exchange Rate:<input type="text" id='exchange_rate' name="exchange_rate" value='<?php echo $data['rates']['exchange_rate'];?>'/> FY:<input type='text' id='exchange_rate_fy' name='dollar_rate_val' value='<?php echo $data['rates']['fy'];?>'/> <div style="color:blue;cursor: pointer;width:50px;" onclick="changeExchangeRate();">Change</div>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Balances Upload</b></legend>
<?php
echo "<b>Mass Balances Upload</b><br>";
echo "<form id='frmFundsUpload'>";
echo "Closure Date: <INPUT TYPE='text' id='closureDate' name='closureDate' readonly='readonly'/>";
echo "File: <INPUT TYPE='file' name='fundsCsv' id='fundsCsv'/>";
echo "</form>";
echo "<BUTTON onclick='massFundsUpload(\"frmFundsUpload\");'>Upload</BUTTON><BUTTON>Reset</BUTTON>";
?>
<br><br><hr><br>
<b>Single ICP Balances Upload</b>
	<div style="margin-left:250px;margin-bottom: 50px;"><button  onclick='addFundBalRow("tblFundsBalBf");'>Add Row</button><button id='btnFundRowDel' style="display: none;">Delete Row</button><button onclick='addFundBal("frmFundsBalBf");'>Post</button><?php echo Resources::a_href("Settings/financeSettings","<button>Refresh</button>");?><button onclick="viewBal()">View</button></button></div>
	<form id='frmFundsBalBf'>
	ICP Number:<!--<input type="text" id="fname" name="icpNo"/>-->
	<SELECT id="fname" name="icpNo">
		<option value=''>Select ICP</option>
		<?php 
			foreach ($data['geticps'] as $value) {
				echo "<option value='".$value->fname."'>".$value->fname."</option>";
			}
		?>
	</SELECT>
	<table id="tblFundsBalBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="3">Closure Date:<input type="text" name="closureDate" id="closeDate" readonly value=""/> Total:<input type="text" name="totalBal" id="totalFunds" readonly/></th></tr>
    <tr><th><input type="checkbox" id="" onclick="chkAll(this);showDel();"/></th><th>Funds</th><th>Balance B/F Amount</th></tr>
	</table>
	</form>
	<div id="balView"></div>
</fieldset>


<!-- PPBF Uploads-->

<?php
echo "<fieldset style='border-color: blue;'>";
echo "<legend>Budget Headers</legend>";
echo "<form  enctype='multipart/form-data' method='POST' name='frmPlansHeader' id='frmPlansHeader'>";
echo "<select name='fy' id='fy'><option value=''>Select FY ...</option><option value='15'>FY15</option><option value='16'>FY16</option><option value='17'>FY17</option><option value='18'>FY18</option></select>";
echo "<input type='file' name='plansheader' id='plansheader'/><br>";

echo "</form>";
echo "<button onclick='uploadPlans(\"frmPlansHeader\");'>Upload</button><button onclick='planHeaderView();'>View</button>";
echo "<br><br><hr>";


echo "<legend>Budget Schedules</legend>";
echo "<form  enctype='multipart/form-data' method='POST' name='frmPlansSchedules' id='frmPlansSchedules'>";
echo "<select name='fy2' id='fy2'><option value=''>Select FY ...</option><option value='15'>FY15</option><option value='16'>FY16</option><option value='17'>FY17</option><option value='18'>FY18</option></select>";
echo "<SELECT id='icpNo' name='icpNo'><option value=''>Select KE No</option>";
	foreach ($data['geticps'] as $value) {
		echo "<option value='".$value->fname."'>".$value->fname."</option>";
	}
echo "</SELECT>";
echo "<SELECT id='planType' name='planType'><option value=''>Select Plan Type</option><option value='1'>Annual</option><option value='2'>Supplementary</option></SELECT>";
echo "<input type='file' name='plansschedules' id='plansschedules'/><br>";
echo "</form>";
echo "<button onclick='uploadSchedules(\"frmPlansSchedules\");'>Upload</button>";
echo "</fieldset>";
//echo "<div id='planView' style='position:relative;top:70px;left:-2z0px;'></div>";

?>

<fieldset style="border-color: blue;">
	<legend><b>Balances B/F Upload</b></legend>
</fieldset>
<!-- Cash Balances-->

<fieldset style="border:2px blue solid;">
    <legend><b>Closing Cash Balance as Per the Cash Journal</b></legend>
<?php
echo "<b>Mass Cash Balance Upload</b><br>";
echo "<form id='frmCashBalUpload'>";
echo "Closure Date: <INPUT TYPE='text' id='closureDateCash' name='closureDate' readonly='readonly'/>";
echo "File: <INPUT TYPE='file' name='fundsCsv' id='fundsCsv'/>";
echo "</form>";
echo "<BUTTON onclick='massCashBalUpload(\"frmCashBalUpload\");'>Upload</BUTTON><BUTTON>Reset</BUTTON>";
?>    
<br><br><b>Single Cash Balances Upload</b>    
<div style="margin-left:250px;margin-bottom: 50px;"><button id='btnCashBalDel' style="display: none;">Delete Row</button><button onclick='addCash("frmCashBf");'>Post</button><?php echo Resources::a_href("Settings/financeSettings","<button>Refresh</button>");?><button onclick="viewCashBal();">View</button></div>
<form id="frmCashBf">
	ICP Number:<!--<input type="text" id="fname" name="icpNo"/>-->
	<SELECT id="fname" name="icpNo">
		<option value=''>Select ICP</option>
		<?php 
			foreach ($data['geticps'] as $value) {
				echo "<option value='".$value->fname."'>".$value->fname."</option>";
			}
		?>
	</SELECT>
<table id="tblCashBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <tr><th colspan="2">Date: <input type="text" id="cjCashOpBal" name="cjCashOpBal" readonly/></th></tr>
    <tr><th>Details</th><th>Amount</th></tr>
    <tr><th>Cash at Bank</th><th><input type="text" id="bcBal" name="cashBal[]"/></th></tr>
    <tr><th>Cash at Hand</th><th><input type="text" id='pcBal' name="cashBal[]"/></th></tr>
</table>
</form>
<div id='viewCashBal'></div>
</fieldset>

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


<!-- OC BF-->
<fieldset style="border:2px blue solid;">
    <legend><b>Oustanding Cheques B/F</b></legend>
    <?php
echo "<b>Mass Closing Oustanding Cheque Upload</b><br>";
echo "<form id='frmOcUpload'>";
echo "File: <INPUT TYPE='file' name='fundsCsv' id='fundsCsv'/>";
echo "</form>";
echo "<BUTTON onclick='massOcBalUpload(\"frmOcUpload\");'>Upload</BUTTON><BUTTON>Reset</BUTTON>";
?>  
<br><br><hr>
<div style="margin-left:250px;margin-bottom: 50px;"><button  onclick='addChqOSRow("tblOSBf");'>Add Row</button><button id='btnOSRowDel' style="display: none;">Delete Row</button><button onclick='addOS("frmOSBf");'>Post</button><?php echo Resources::a_href("Finance/oustChqBf","<button>Refresh</button>");?><button onclick="ocView();">View</button></div>
<form id="frmOSBf">
ICP Number:<input type="text" id="icpNo" name="icpNo"/>
<table id="tblOSBf" style="max-width: 60%;border:1px wheat solid;margin-left: auto;margin-right: auto;">
    <!--<tr><th colspan="4">Oustanding Date: <input type="text" id="osDate" name="" readonly/></th></tr>-->
    <tr><th><input type="checkbox" id="" onclick="chkAll(this);showDel();"/></th><th>Cheque Number</th><th>Date</th><th>Amount</th></tr>
</table>
</form>
<div id="balView"></div>
</fieldset>

<fieldset>
<legend>Transfer Funds Balances Between Revenue Accounts</legend>
<form id='fundsTransfer'>
<table>
<tr><td><b>KE Number</b></td><td><INPUT TYPE='text' id='icpNo' name='icpNo'/></td></tr>
</table>
</form>
</fieldset>


<?php
}elseif(Resources::session()->userlevel==='1'){
?>
<fieldset style="border-color: blue;">
	<legend><b>PPBF Settings</b></legend>
	Beneficiaries Population:<input type="text" id="icpNoPop" name="icpNoPop"  value='<?php echo $data['icpPopulation']['noOfBen'];?>'/> # Of Months: <input type="text" id="noOfMonths" name="noOfMonths"  value='<?php echo $data['icpPopulation']['noOfMonths'];?>'/> FY: <input type="text" id="icpFy" name="icpFy"   value='<?php echo $data['icpPopulation']['fy'];?>'/><div style="color:blue;cursor: pointer;width:50px;" onclick="changeIcpPopulation();">Change</div>
</fieldset>

<?php	
}
?>
