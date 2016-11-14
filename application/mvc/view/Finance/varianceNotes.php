<form id='frmVarExp'>
	<textarea cols="90" name="Details" rows="20" placeholder="Type Variance Explanation Here"><?php echo $data['var'];?></textarea>
	<input type="hidden" name="reportMonth"  value="<?php echo $data['rptMonth']?>"/>
	<input type="hidden" name="AccNo"  value="<?php echo $data['AccNo']?>"/>
</form>
<button onclick='window.opener.updateNotes("frmVarExp");window.close()'>Post</button>