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
<?php
}elseif(Resources::session()->userlevel==='1'){
?>
<fieldset style="border-color: blue;">
	<legend><b>PPBF Settings</b></legend>
	Child Population:<input type="text" id="icpNoPop" name="icpNoPop"  value='<?php echo $data['icpPopulation']['noOfBen'];?>'/> FY: <input type="text" id="icpFy" name="icpFy"   value='<?php echo $data['icpPopulation']['fy'];?>'/><div style="color:blue;cursor: pointer;width:50px;" onclick="changeIcpPopulation();">Change</div>
</fieldset>
<?php	
}
?>