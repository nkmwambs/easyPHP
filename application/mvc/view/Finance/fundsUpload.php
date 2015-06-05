<?php
//set_time_limit(3600); 
?>
<form enctype="multipart/form-data" name="frmFunds" id="frmFunds">
    <table style="width:40%;border: 1px wheat solid;margin-left: auto;margin-right: auto;">
        
        <tr><td align='center'><b>Select Lists Type To Upload:</b><select name="lists" size="1">
	<option value="fundsSchedules">Funds Schedule</option>
	<option value="projectsDetails">Project Details</option>
        <option value="specialgifts">Special Gifts</option>
         </select></td></tr>

        <tr><td align='center'><b> Upload Lists: </b><input name="csv" type="file" id="csv"/></td></tr>

        
        <tr><td align='center'></b><button onclick='submitFunds("frmFunds");'>Upload</button></td></tr>
    </table>
</form> 