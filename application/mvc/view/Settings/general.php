<?php
$chkd = "";
if($data['siteOff']==='1'){
	$chkd = "checked";
}
?>
<fieldset style="border:1px solid blue;">
	<legend><b>Site Settings</b></legend>
	Site Offline: <input type="checkbox" id="siteOff" name="siteOff" onclick="siteOff(this);" <?php echo $chkd;?>/><br>
	Offline Message: <textarea id="offlineMsg" name="offlineMsg" rows="4" cols="90" style="overflow:none" placeholder='Type Offline Message here'><?php echo $data['msg'];?></textarea><br>
	<button onclick="getOfflineMsg();">Post</button>
</fieldset>

<fieldset style="border:1px solid blue;">
	<legend><b>Children Database Update</b></legend>
    <?php
	echo "<form id='frmChildren'>";
	echo "File: <INPUT TYPE='file' name='childdetails' id='childdetails'/>";
	echo "</form>";
	echo "<BUTTON onclick='childrenDbUpdate(\"frmChildren\");'>Upload</BUTTON><BUTTON>Reset</BUTTON>";
	?> 
</fieldset>