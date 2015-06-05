<?php
 echo '<div>'.a_tag("Business/helpdesk",img_tag("doc.png")).' View |</div>';
?>
<table>
    <tr><td colspan="2" align='center' style="background-color:lightskyblue;border:2px white solid;border-radius: 8px;color:white;font-size:14pt;">Requestor's Details</td><td colspan="2" align='center' style="background-color:lightskyblue;border:2px white solid;border-radius: 8px;color:white;font-size:14pt;">Request's Details</td></tr>
        <tr><td colspan="4" align='center'>&nbsp;</td></tr>
    <tr><td>Name</td><td><input type='text' value="<?php echo $_SESSION['username'];?>" name='fname' readonly="readonly"/></td><td>Priority</td><td><select><option>Choose Priority ... </option><option>Low</option><option>Medium</option><option>High</option></select></td></tr>
        <tr><td colspan="2" align='center'>&nbsp;</td></tr>
    <tr><td>Email</td><td><input type='text' value="<?php echo $_SESSION['email'];?>" name='email' readonly="readonly"/></td><td>Attention Date</td><td><input type="text" id='attenddate' name='attenddate' readonly/></td></tr>
    <tr><td>Department</td><td><input type='text' value="" name='department'/></td><td>&nbsp;</td><td>&nbsp;</td></tr>
    <tr><td colspan="4" align='center'>&nbsp;</td></tr>
    <tr><td colspan="4" align='center' style="background-color:lightskyblue;border:2px white solid;border-radius: 8px;color:white;font-size:14pt;">Request Description</td></tr>
    <tr><td colspan="4" align='center'>&nbsp;</td></tr>
    <tr><td colspan="4"><textarea class='msg'></textarea></td></tr>
    <tr><td colspan="4" align='center'><button>Post</button></td></tr>
</table>