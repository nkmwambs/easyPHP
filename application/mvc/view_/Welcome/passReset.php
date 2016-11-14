<div id="coverUp">
<div id='error_div'>Note: For Security reasons, You will be required to reset you password when you log in for the first time. Log in again with the new password after reset.
<form id="newPassReset">
<table id='tblnewPassReset'>
    <caption>Password Reset</caption>
    <tr><td>Password:</td><td><input type="password" id="password" name="password" placeholder="Password" onkeyup="check_pswd_len(this);"/></td></tr>
    <tr><td>Repeat Password:</td><td><input type="password" id="rptPassword" name='rptPassword' placeholder="Repeat Password" onkeyup="check_pswd_rpt();"/></td></tr>
        <tr><td align='center' colspan="2" style="color:red;font-size: 8pt;" id="register_error"></td></tr>
    <tr><td colspan="2" align='center'><button onclick='newPassReset("newPassReset");'>Reset</button></td></tr>
</table>
</form>
</div>
</div>