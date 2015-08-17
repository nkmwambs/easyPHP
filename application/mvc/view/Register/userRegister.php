<div style="float:left;border-right:2px black solid;padding-right: 10px;min-width: 300px;">
    <form id="newuser">
<table id="newuser">
    <caption><?php echo Resources::img("submituser.png");?> New User Registration</caption>
    <tr><td>Username:</td><td><input type="text" id="username" name="username" placeholder="User Name" onblur="validate(this);"/></td></tr>
    <tr><td>First Name:</td><td><input type="text" id="fname" name="userfirstname" placeholder="First Name"/></td></tr>
    <tr><td>Last Name:</td><td><input type="text" id="lname" name="userlastname" placeholder="Last Name"/></td></tr>
    <tr><td>Cluster:</td><td>
    	<select id='cname' name="cname"  onchange='listIcps(this);'>
    		<?php
    			echo "<option value=''>Select Cluster</option>";
    		foreach($data['clst'] as $value):
				echo "<option value='".$value->cname."'>".$value->cname."</option>";
			endforeach;
    		?>
    	</select>
    </td></tr>
    <tr><td>ICP Number</td><td>
    	<select id='icp' name='fname'>
    		<option value=''>Select ICP</option>
			
    	</select>
    </td></tr>
    <tr><td>Email:</td><td><input type="text" id="email" name="email" placeholder="Personal Email" onblur="validate(this);"/></td></tr>
    <tr><td>Security Question:</td><td><SELECT id="securityQstnID" name="securityQstnID"><option value=''>Select your preferred Security Question ... </option>
    			<?php
                    foreach ($data['secQtn'] as $value) {
                        echo "<option value='{$value->qID}'>{$value->qstn}</option>";
                    }
                ?>
    </SELECT></td></tr>
    <tr><td>Answer:</td><td><input type="text" name="qAns" id="qAns"/></td></tr>
    <tr><td>Role:</td><td><select name="department"><option value=''>Select Role</option><option value="15">Project Director</option><option value="16">Project Accountant</option><option value="17">Project Social Worker</option><option value="18">Project Health Worker</option><option value="19">CSP Implementer</option><option value="20">CPC Member</option><option value="21">Patron</option></select></td></tr>
    <tr><td>Password:</td><td><input type="password" id="password" name="password" placeholder="Password" onkeyup="check_pswd_len(this);"/></td></tr>
    <tr><td>Repeat Password:</td><td><input type="password" id="rptPassword"  placeholder="Repeat Password" onkeyup="check_pswd_rpt();"/></td></tr>
    <tr><td align='center' colspan="2" style="color:red;font-size: 8pt;" id="register_error"></td></tr>
    <input type="hidden" name="userlevel" value="1"/>
    <input type="hidden" name="auth" value="1"/>
    <!--<input type="hidden" name="reffererID" value="<?php echo Resources::session()->ID;?>"/>-->
    </form>
    <tr><td align='center' colspan="2"><?php echo Resources::img("disksave.png",array("title"=>"Submit","style"=>"cursor:pointer","onclick"=>"submitUsers(\"newuser\");"))."  ".Resources::img("clear.png",array("title"=>"Clear Form","style"=>"cursor:pointer"));?></td></tr>
</table>

<div>Forgot Password? Click <?php echo Resources::a_href("Register/forgotPass","Here");?></div>
    
</div>
<div style="float:left;margin-left: 40px;max-width:300px;">
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