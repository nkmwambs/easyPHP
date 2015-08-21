<?php
//print_r($data['allLimits']);
?>
<fieldset style="border-color: blue;">
	<legend><b>Indexing Limits</b></legend>
	CSP :<input type="text" id="cspLimit" value="<?php echo $data['csp'];?>"/><br>
	CDSP:<input type="text" id="cdspLimit" value="<?php echo $data['cdsp'];?>"/><br>
	<div style="color: blue;cursor: pointer;" onclick='changeLimits();'>Change</div>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Indexing Closure Date</b></legend>
	Closure date: <input type="text" id='closeIndexing' readonly="readonly"/><br>
	<span style="color: blue;">Change</span>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Vulnerabilities</b></legend>
	<button>Post</button><button>Manage</button><br><br>
	Vulnerabilities:<input type="text" id='vul'/>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Required HVC Support</b></legend>
	<button>Post</button><button>Manage</button><br><br>
	Required HVC Support:<input type="text" id='hvcSup'/>
</fieldset>

<fieldset style="border-color: blue;">
	<legend><b>Required Non-HVC Support</b></legend>
	<button>Post</button><button>Manage</button><br><br>
	Required Non-HVC Support:<input type="text" id='otherHvcSup'/>
</fieldset>