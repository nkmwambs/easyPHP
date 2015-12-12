<?php
//set_time_limit(3600); 
echo Resources::a_href("Finance/fundsUpload","[Funds Upload]")." ".Resources::a_href("","[View Uploaded Funds]")." ".Resources::a_href("","[CIV]");
echo "<br>";
echo "<hr>";
echo "<br>";
?>

    <table style="width:40%;border: 1px wheat solid;margin-left: auto;margin-right: auto;">
 <form enctype="multipart/form-data" name="frmFunds" id="frmFunds">      
        <tr><td align='center'><b>Select Lists Type To Upload:</b>
        	<select name="lists" size="1">
        		<option value="">Select Option ...</option>
				<option value="fundsSchedules">Funds Schedule</option>
        		<option value="specialgifts">Special Gifts</option>
         </select></td></tr>

        <tr><td align='center'><b> Upload Lists: </b><input name="csv" type="file" id="csv"/></td></tr>

</form>         
        <tr><td align='center'></b><button onclick='submitFunds("frmFunds");'>Upload</button></td></tr>
    </table>
