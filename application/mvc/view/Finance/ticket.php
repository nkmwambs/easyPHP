<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}
//print_r($data['cur_month_vouchers']);
?>
<table style="max-width: 50%;">
	<caption style="font-weight: bold;">New Ticket</caption>
	<tr><th style="text-align: left;">Ticket Type</th><td><select>
		<option>Select Type ...</option>
		<option value="1">Cheque Clearance Reversal</option>
	</select></td></tr>
	
	<tr><th style="text-align: left;">Voucher Number</th><td><select>
		<option>Select Voucher Number</option>
	</select></td></tr>
	
	<tr><td colspan="2"><button>Post</button></td></tr>
</table>