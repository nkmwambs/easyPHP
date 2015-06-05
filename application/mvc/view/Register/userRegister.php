<div style="float:left;border-right:2px black solid;padding-right: 10px;min-width: 390px;">
    <form id="newuser">
<table id="newuser">
    <caption><?php echo img_tag("submituser.png");?> New User Registration</caption>
    <tr><td>Username:</td><td><input type="text" id="username" name="username" placeholder="User Name" onblur="validate(this);"/></td></tr>
    <tr><td>First Name:</td><td><input type="text" id="fname" name="fname" placeholder="First Name"/></td></tr>
    <tr><td>Last Name:</td><td><input type="text" id="lname" name="lname" placeholder="Last Name"/></td></tr>
    <tr><td>Email:</td><td><input type="text" id="email" name="email" placeholder="Personal Email" onblur="validate(this);"/></td></tr>
    <tr><td>Role:</td><td><select name="usrlvl"><option>Select Role</option><option value='6'>Secretary</option><option value="5">Accountant</option><option value="4">Teacher</option><option value="3">Senior Teacher</option><option value="2">Head-Teacher</option><option value="1">Manager</option></select></td></tr>
    <tr><td>Password:</td><td><input type="password" id="password" name="password" placeholder="Password" onkeyup="check_pswd_len(this);"/></td></tr>
    <tr><td>Repeat Password:</td><td><input type="password" id="rptPassword" name='rptPassword' placeholder="Repeat Password" onkeyup="check_pswd_rpt();"/></td></tr>
    <tr><td align='center' colspan="2" style="color:red;font-size: 8pt;" id="register_error"></td></tr>
    <tr><td align='center' colspan="2"><?php echo img_tag("disksave.png",array("title"=>"Submit","style"=>"cursor:pointer","onclick"=>"submitUser(\"newuser\");"))."  ".img_tag("clear.png",array("title"=>"Clear Form","style"=>"cursor:pointer"));?></td></tr>
</table>
    </form>
</div>
<div style="float:left;margin-left: 40px;max-width:450px;">
    <b>Instructions:</b>
    <p>
        This is a secured system and you be required to be registered in order to use it. Once you register yourself you will not be able to access the restricted areas until an administrator accepts your registration request.
    </p>
    <p>
        <b>Note:</b>
        <ul style="list-style-type:square">
            <li>Username should not exceed 10 but bot less than 6 characters long</li>
            <li>The password should be atleast 8 characters long with atleast 1 alphanumeric, 1 Uppercase, 1 lowercase and 1 numeric characters</li>
        </ul>
    </p>
</div>