<form id="newPassReset">
<table style="border:1px orange solid;">
    <caption>Password Reset</caption>
    <tr><td>Password:</td><td><input type="password" id="password" name="password" placeholder="Password" onkeyup="check_pswd_len(this);"/></td></tr>
    <tr><td>Repeat Password:</td><td><input type="password" id="rptPassword" name='rptPassword' placeholder="Repeat Password" onkeyup="check_pswd_rpt();"/></td></tr>
        <tr><td align='center' colspan="2" style="color:red;font-size: 8pt;" id="register_error"></td></tr>
    <tr><td colspan="2" align='center'><?php echo Resources::img("disksave.png",array("onclick"=>'newPassReset("newPassReset")')); ?></td></tr>
</table>
</form>