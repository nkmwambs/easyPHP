<?php
?>
<form id='frmPwdChange'>
<table id='newuser'>
    <caption><?php echo img_tag("change_password.png"); ?> Password Change</caption>
    <tr><td colspan="2">Please consider changing your password:</td></tr>
    <tr><td>Current Password </td><td><input type="password" id="oldPassword" placeholder="Current Password" name="oldPassword"/></td></tr>
    <tr><td>New Password </td><td><input type="password" id="password" name="password" placeholder="Password" onkeyup="check_pswd_len(this);"/></td></tr>
    <tr><td>Repeat Password </td><td><input type="password" id="rptPassword" name="rptPassword" placeholder="Repeat Password" onkeyup="check_pswd_rpt();"/></td></tr>
    <tr><td align='center' colspan="2" style="color:red;font-size: 8pt;" id="register_error"></td></tr>
    <tr><td colspan="2" align='center'><?php echo img_tag("disksave.png",array("title"=>"Save","onclick"=>"changePwd(\"frmPwdChange\");"))." ".img_tag("clear.png",array("title"=>"Reset"));?></td></tr>
</table>
</form>
