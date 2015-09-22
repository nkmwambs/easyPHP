<?php
//print_r($data['current_closure_date']);
?>
<fieldset style="border-color: blue;">
	<legend><b>Indexing Limits</b></legend>
	CSP :<input type="text" id="cspLimit" value="<?php echo $data['csp'];?>"/><br>
	CDSP:<input type="text" id="cdspLimit" value="<?php echo $data['cdsp'];?>"/><br>
	<span style="color: blue;cursor: pointer;" onclick='changeLimits();'>Change</span>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Indexing Closure Date</b></legend>
	<form id="frmcloseIndexing">
		Closure date: <input type="text" value="<?php echo $data['current_closure_date']->closureDate;?>" id='closeIndexing' name='closeIndexing' readonly="readonly"/><br>
		Financial Year: <input type="text" value="<?php echo $data['current_closure_date']->fy;?>" id='indexingFy' name='indexingFy'/><br>
	</form>
	<span style="color: blue;cursor: pointer;" onclick="hvcClosureDate();">Change</span>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Vulnerabilities</b></legend>
	
	<form id="frmVul">
	<span style="float: left;"> Vulnerability:</span><input type="text" id='vul' name="vul" style="float:left;min-width: 500px;"/><button style="float: left;" onclick="addNewHvcVul();">Add New</button>
	</form>
	
	<table id="info_tbl"  style="margin-top: 25px;">
		<caption style="font-weight: bold;">Vulnerabilities</caption>
		<tr><td colspan="2"><button id="delBtn" style="display: none;" onclick="delVul();">Delete</button></td></tr>
		<tr><th>Check</th><th>Vulnerability</th></tr>
		<?php
			foreach ($data['vul'] as $value) {
				echo "<tr><td><input type='checkbox' class='chk' onclick='chkDel();'  id='vul_".$value->vulID."'/></td><td>{$value->vul}</td></tr>";
			}
		?>
	</table>
	<form id="frmDelStr">
		<input type="text" id="delStr" name="delStr" style="display: none;"/>
	</form>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Required HVC Support</b></legend>
	<form id="frmIntvn">
	<span style="float: left;">Required HVC Support:</span><input type="text" id='hvcSup' name="hvcSup" style="float: left;min-width: 500px;"/><button onclick="addNewHvcIntvn();" style="float: left;">Add New</button>
	</form>
	
		<table id="info_tbl"  style="margin-top: 25px;">
		<caption style="font-weight: bold;">Required HVC Support</caption>
		<tr><td colspan="2"><button id="delIntvnBtn" style="display: none;" onclick="delIntvn();">Delete</button></td></tr>
		<tr><th>Check</th><th>Intervention</th></tr>
		<?php
			foreach ($data['intvn'] as $value) {
				echo "<tr><td><input type='checkbox' class='chkIntv' onclick='chkDelIntvn();'  id='intvn_".$value->intID."'/></td><td>{$value->intervene}</td></tr>";
			}
		?>
	</table>
	<form id="frmDelStrIntvn">
		<input type="text" id="delStrIntvn" name="delStrIntvn" style="display: none;"/>
	</form>
	
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Required Non-HVC Support</b></legend>
	<form id="frmOtherIntvn">
	<span style="float: left;">Required Non-HVC Support:</span><input type="text" style="float: left;min-width: 480px;" id='otherHvcSup' name="otherHvcSup"/><button style="float: left;" onclick="addNewOtherIntvn();">Add New</button>
	</form>
	
	<table id="info_tbl"  style="margin-top: 25px;">
		<caption style="font-weight: bold;">Required Non-HVC Support</caption>
		<tr><td colspan="2"><button id="delOtherIntvnBtn" style="display: none;" onclick="delOtherIntvn();">Delete</button></td></tr>
		<tr><th>Check</th><th>Intervention</th></tr>
		<?php
			foreach ($data['otherIntvn'] as $value) {
				echo "<tr><td><input type='checkbox' class='chkOtherIntv' onclick='chkDelOtherIntvn();'  id='otherIntvn_".$value->nonID."'/></td><td>{$value->nonHvc}</td></tr>";
			}
		?>
	</table>
	<form id="frmDelStrOtherIntvn">
		<input type="text" id="delStrOtherIntvn" name="delStrOtherIntvn" style="display: none;"/>
	</form>
		
</fieldset>