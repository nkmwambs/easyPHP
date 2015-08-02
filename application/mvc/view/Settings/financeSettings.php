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
?>
Date Control <input type='checkbox' name='dateControl' onclick='dateControl(this);'  id='dateControl' <?php echo $chkd;?>/>

