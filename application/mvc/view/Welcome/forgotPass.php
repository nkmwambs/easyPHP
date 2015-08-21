<?php
if(is_array($data['test'])){
	print_r($data['test']);
}else{
	print($data['test']);
}

echo "To reset your password, Enter either your email address or your security question and answer or any former password. If you get this correct, a new system generated password will be mailed to you. Use this passowrd to log in. You may consider reseting your password once you log in.<br>";
echo "<div id='msg'></div>";
echo "<form id='frmforgotPass'>";
echo "<br>Email: <input type='text' id='email' name='email'/><br>";
echo "<b>OR</b><br>";
echo "Security Question:";
echo "<SELECT id='securityQstnID' name='securityQstnID'>";
		echo "<option value=''>Select security question ... </option>";
	foreach ($data['qstns'] as $value) {
		echo "<option value='".$value->qID."'>".$value->qstn."</option>";
	}
echo "</SELECT>";
echo "Answer:<input type='text' id='qAns' name='qAns'/><br>";
//echo "<button>Reset Password</button><br><br>";
echo "<b>OR</b><br>";
echo "Any Former Password: <input type='text' id='password' name='password'/><br>";
echo "</form>";
echo "<button onclick='forgotPassReset(\"frmforgotPass\");'>Reset Password</button>";
?>