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